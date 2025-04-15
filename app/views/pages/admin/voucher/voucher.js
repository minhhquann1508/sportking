$(document).ready(function() {
    const voucherList = $('#voucherList');
    const voucherModal = $('#voucherModal');
    const voucherModalLabel = $('#voucherModalLabel');
    const voucherForm = $('#voucherForm');
    const btnSaveVoucher = $('#btnSaveVoucher');
    const deleteVoucherModal = $('#deleteVoucherModal');
    const btnDeleteConfirm = $('#btnDeleteConfirm');
    const voucherIdInput = $('#voucherId');
    const btnAddVoucher = $('#btnAddVoucher');

    let currentVoucherId = null; // Lưu ID voucher khi chỉnh sửa hoặc xóa

    // Hàm tải danh sách voucher từ backend
    function loadVouchers() {
        $.ajax({
            url: '<?= BASE_URL ?>/admin/voucher/getVouchers', // Đường dẫn API lấy danh sách voucher
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                voucherList.empty();
                if (data.length > 0) {
                    $.each(data, function(index, voucher) {
                        voucherList.append(`
                            <tr>
                                <td>${voucher.voucher_id}</td>
                                <td>${voucher.status === 'active' ? 'Kích hoạt' : 'Không kích hoạt'}</td>
                                <td>${voucher.code}</td>
                                <td>${voucher.discount_type === 'percentage' ? 'Phần trăm' : 'Cố định'}</td>
                                <td>${voucher.discount_value}</td>
                                <td>${voucher.quantily}</td>
                                <td>${voucher.expired}</td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-edit" data-id="${voucher.voucher_id}">Sửa</button>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="${voucher.voucher_id}">Xóa</button>
                                </td>
                            </tr>
                        `);
                    });
                } else {
                    voucherList.append('<tr><td colspan="8" class="text-center">Không có voucher nào.</td></tr>');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tải danh sách voucher:', error);
                alert('Đã xảy ra lỗi khi tải danh sách voucher.');
            }
        });
    }

    // Gọi hàm tải danh sách voucher khi trang được tải
    loadVouchers();

    // Hiển thị modal thêm voucher
    btnAddVoucher.on('click', function() {
        voucherModalLabel.text('Thêm Voucher Mới');
        voucherForm[0].reset(); // Reset form
        voucherIdInput.val(''); // Reset ID
        voucherModal.modal('show');
    });

    // Xử lý sự kiện click nút "Sửa"
    voucherList.on('click', '.btn-edit', function() {
        const voucherId = $(this).data('id');
        $.ajax({
            url: '<?= BASE_URL ?>/admin/voucher/getVoucher/' + voucherId, // Đường dẫn API lấy thông tin voucher theo ID
            type: 'GET',
            dataType: 'json',
            success: function(voucher) {
                if (voucher) {
                    voucherModalLabel.text('Chỉnh Sửa Voucher');
                    voucherIdInput.val(voucher.voucher_id);
                    $('#code').val(voucher.code);
                    $('#discount_type').val(voucher.discount_type);
                    $('#discount_value').val(voucher.discount_value);
                    $('#quantity').val(voucher.quantily);
                    $('#expired').val(voucher.expired);
                    $('#status').val(voucher.status);
                    voucherModal.modal('show');
                } else {
                    alert('Không tìm thấy voucher.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lấy thông tin voucher:', error);
                alert('Đã xảy ra lỗi khi lấy thông tin voucher.');
            }
        });
    });

    // Xử lý sự kiện click nút "Lưu Voucher" (thêm hoặc sửa)
    btnSaveVoucher.on('click', function() {
        const voucherId = voucherIdInput.val();
        const code = $('#code').val();
        const discount_type = $('#discount_type').val();
        const discount_value = $('#discount_value').val();
        const quantity = $('#quantity').val();
        const expired = $('#expired').val();
        const status = $('#status').val();
        const data = {
            voucher_id: voucherId,
            code: code,
            discount_type: discount_type,
            discount_value: discount_value,
            quantity: quantity,
            expired: expired,
            status: status
        };
        const url = voucherId ? '<?= BASE_URL ?>/admin/voucher/updateVoucher' : '<?= BASE_URL ?>/admin/voucher/addVoucher';
        const type = voucherId ? 'POST' : 'POST'; // Sử dụng POST cho cả thêm và sửa để đơn giản, bạn có thể dùng PUT cho sửa

        $.ajax({
            url: url,
            type: type,
            dataType: 'json',
            data: data,
            success: function(response) {
                if (response.success) {
                    alert(response.message);
                    voucherModal.modal('hide');
                    loadVouchers(); // Tải lại danh sách voucher
                } else {
                    alert('Lỗi: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi lưu voucher:', error);
                alert('Đã xảy ra lỗi khi lưu voucher.');
            }
        });
    });

    // Xử lý sự kiện click nút "Xóa"
    voucherList.on('click', '.btn-delete', function() {
        currentVoucherId = $(this).data('id');
        deleteVoucherModal.modal('show');
    });

    // Xử lý sự kiện click nút "Xóa" trong modal xác nhận
    btnDeleteConfirm.on('click', function() {
        if (currentVoucherId) {
            $.ajax({
                url: '<?= BASE_URL ?>/admin/voucher/deleteVoucher/' + currentVoucherId, // Đường dẫn API xóa voucher
                type: 'POST', // Hoặc DELETE
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        deleteVoucherModal.modal('hide');
                        loadVouchers(); // Tải lại danh sách voucher
                    } else {
                        alert('Lỗi: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Lỗi khi xóa voucher:', error);
                    alert('Đã xảy ra lỗi khi xóa voucher.');
                }
            });
            currentVoucherId = null; // Reset ID sau khi xóa
        }
    });
});