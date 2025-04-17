<div class="container mt-5">
    <h5>Quản Lý Voucher</h5>

    <div class="mb-3">
        <button class="btn btn-primary" id="btnAddVoucher">Thêm Voucher Mới</button>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Trạng thái</th>
                <th>Mã Voucher</th>
                <th>Loại Giảm Giá</th>
                <th>Giá Trị</th>
                <th>Số Lượng</th>
                <th>Ngày Hết Hạn</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody id="voucherList">
            <!-- Dữ liệu voucher sẽ được load vào đây -->
        </tbody>
    </table>

    <!-- Modal Thêm Voucher -->
    <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="voucherModalLabel">Thêm Voucher Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    <form id="voucherForm">
                        <input type="hidden" id="voucherId">
                        <div class="mb-3">
                            <label for="code" class="form-label">Mã Voucher</label>
                            <input type="text" class="form-control" id="code" required>
                        </div>
                        <div class="mb-3">
                            <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                            <select class="form-select" id="discount_type" required>
                                <option value="percentage">Phần trăm (%)</option>
                                <option value="fixed">Số tiền cố định</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="discount_value" class="form-label">Giá Trị Giảm Giá</label>
                            <input type="number" class="form-control" id="discount_value" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Số Lượng</label>
                            <input type="number" class="form-control" id="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label for="expired" class="form-label">Ngày Hết Hạn</label>
                            <input type="date" class="form-control" id="expired" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select class="form-select" id="status" required>
                                <option value="active">Kích hoạt</option>
                                <option value="inactive">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="btnSaveVoucher">Lưu Voucher</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal Xóa Voucher -->
    <div class="modal fade" id="deleteVoucherModal" tabindex="-1" aria-labelledby="deleteVoucherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteVoucherModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa voucher này?
                    <input type="hidden" id="deleteVoucherId">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="btnDeleteConfirm">Xóa</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cập nhật Voucher -->
    <div class="modal fade" id="updateVoucherModal" tabindex="-1" aria-labelledby="updateVoucherModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">>
                <div class="modal-header">
                    <h5 class="modal-title" id="updateVoucherModalLabel">Cập nhật Voucher</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateVoucherForm">
                        <input type="hidden" id="updateVoucherId">
                        <div class="mb-3">
                            <label>Mã voucher:</label>
                            <input type="text" id="updateCode" class="form-control" placeholder="Nhập Mã voucher">
                        </div>
                        <div class="mb-3">
                            <label>Kiểu giảm giá:</label>
                            <select class="form-select" id="updateDiscountType">
                                <option value="percentage">Phần trăm</option>
                                <option value="fixed">Cố định</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Giá trị giảm giá:</label>
                            <input type="number" id="updateDiscountValue" class="form-control"
                                placeholder="Nhập giá trị giảm giá">
                        </div>
                        <div class="mb-3">
                            <label>Số lượng:</label>
                            <input type="number" id="updateQuantity" class="form-control" placeholder="Nhập số lượng">
                        </div>
                        <div class="mb-3">
                            <label>Ngày hết hạn:</label>
                            <input type="date" id="updateExpired" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Trạng thái:</label>
                            <select class="form-select" id="updateStatus">
                                <option value="active">Kích hoạt</option>
                                <option value="inactive">Không kích hoạt</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary" id="btnUpdateVoucher">Cập nhật</button>
                        </div>
                    </form>
                </div>

            </div>


        </div>
    </div>
</div>
</div>

<script>
$(document).ready(function() {
    // Định dạng ngày tháng
    function formatDate(dateString) {
        if (!dateString) return "N/A";
        const date = new Date(dateString);
        return date.toLocaleDateString("vi-VN", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit"
        });
    }

    // Load danh sách voucher
    function loadVouchers() {
        $.ajax({
            url: "?controller=voucher&action=getVouchers",
            method: "GET",
            dataType: "json",
            success: function(vouchers) {
                let html = '';

                if (vouchers && vouchers.length > 0) {
                    $.each(vouchers, function(index, voucher) {
                        html += `
                            <tr>
                                <td>${voucher.voucher_id}</td>
                                <td>${voucher.status == 1 ? 'Kích hoạt' : 'Không kích hoạt'}</td>
                                <td>${voucher.code}</td>
                                <td>${voucher.discount_type === 'percentage' ? 'Phần trăm' : 'Cố định'}</td>
                                <td>${voucher.discount_value}${voucher.discount_type === 'percentage' ? '%' : 'đ'}</td>
                                <td>${voucher.quantity}</td>
                                <td>${formatDate(voucher.expired)}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning btnEdit" 
                                        data-id="${voucher.voucher_id}"
                                        data-code="${voucher.code}"
                                        data-discount-type="${voucher.discount_type}"
                                        data-discount-value="${voucher.discount_value}"
                                        data-quantity="${voucher.quantity}"
                                        data-expired="${voucher.expired.split(' ')[0]}"
                                        data-status="${voucher.status}">
                                        Sửa
                                    </button>
                                    <button class="btn btn-sm btn-danger btnDelete" data-id="${voucher.voucher_id}">Xóa</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="8" class="text-center">Không có voucher nào</td></tr>';
                }

                $('#voucherList').html(html);
            },
            error: function(xhr) {
                console.error("Lỗi khi tải voucher:", xhr.responseText);
                $('#voucherList').html(
                    '<tr><td colspan="8" class="text-center text-danger">Lỗi khi tải dữ liệu</td></tr>'
                );
            }
        });
    }

    // Mở modal thêm voucher
    $('#btnAddVoucher').on('click', function() {
        $('#voucherForm')[0].reset();
        $('#voucherId').val(''); // Reset ID nếu có
        $('#voucherModalLabel').text('Thêm Voucher Mới');
        $('#voucherModal').modal('show');
    });

    // Thêm voucher
    $('#voucherForm').submit(function(e) {
        e.preventDefault();

        const formData = {
            code: $('#code').val(),
            discount_type: $('#discount_type').val(),
            discount_value: $('#discount_value').val(),
            quantity: $('#quantity').val(),
            expired: $('#expired').val(),
            status: $('#status').val()
        };

        console.log('Dữ liệu gửi đi:', formData);

        $.ajax({
            url: "?controller=voucher&action=addVoucher",
            method: "POST",
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Phản hồi từ server:', response);
                if (response.success) {
                    $('#voucherModal').modal('hide');
                    loadVouchers();
                    alert(response.message || 'Thêm voucher thành công');
                } else {
                    alert(response.message || 'Có lỗi xảy ra khi thêm voucher');
                }
            },
            error: function(xhr) {
                console.error('Lỗi AJAX:', xhr.responseText);
                alert("Lỗi: " + xhr.responseText);
            }
        });
    });

    // Mở modal sửa voucher
    $(document).on('click', '.btnEdit', function() {
        const voucher = {
            id: $(this).data('id'),
            code: $(this).data('code'),
            discount_type: $(this).data('discount-type'),
            discount_value: $(this).data('discount-value'),
            quantity: $(this).data('quantity'),
            expired: $(this).data('expired'),
            status: $(this).data('status')
        };

        $('#updateVoucherId').val(voucher.id);
        $('#updateCode').val(voucher.code);
        $('#updateDiscountType').val(voucher.discount_type);
        $('#updateDiscountValue').val(voucher.discount_value);
        $('#updateQuantity').val(voucher.quantity);
        $('#updateExpired').val(voucher.expired);
        $('#updateStatus').val(voucher.status == 1 ? 'active' : 'inactive');

        $('#updateVoucherModal').modal('show');
    });

    // Cập nhật voucher
    $('#updateVoucherForm').submit(function(e) {
        e.preventDefault();

        const formData = {
            voucher_id: $('#updateVoucherId').val(),
            code: $('#updateCode').val(),
            discount_type: $('#updateDiscountType').val(),
            discount_value: $('#updateDiscountValue').val(),
            quantity: $('#updateQuantity').val(),
            expired: $('#updateExpired').val(),
            status: $('#updateStatus').val() === 'active' ? 1 : 0
        };

        console.log('Dữ liệu cập nhật gửi đi:', formData); // Kiểm tra dữ liệu

        $.ajax({
            url: "?controller=voucher&action=updateVoucher",
            method: "POST",
            data: formData,
            dataType: 'json',
            success: function(response) {
                console.log('Phản hồi cập nhật:', response);
                if (response.success) {
                    $('#updateVoucherModal').modal('hide');
                    loadVouchers();
                    alert(response.message || 'Cập nhật voucher thành công');
                } else {
                    alert(response.message || 'Có lỗi xảy ra khi cập nhật voucher');
                }
            },
            error: function(xhr) {
                console.error('Lỗi AJAX cập nhật:', xhr.responseText);
                alert("Lỗi: " + xhr.responseText);
            }
        });
    });

    // Xóa voucher
    $(document).on('click', '.btnDelete', function() {
        if (confirm('Bạn có chắc chắn muốn xóa voucher này?')) {
            const voucherId = $(this).data('id');

            $.ajax({
                url: "?controller=voucher&action=deleteVoucher&id=" + voucherId,
                method: "GET",
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        loadVouchers();
                        alert(response.message || 'Xóa voucher thành công');
                    } else {
                        alert(response.message || 'Có lỗi xảy ra khi xóa voucher');
                    }
                },
                error: function(xhr) {
                    alert("Lỗi: " + xhr.responseText);
                }
            });
        }
    });

    // Load dữ liệu ban đầu
    loadVouchers();
});
</script>