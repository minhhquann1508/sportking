<div class="d-flex justify-content-between align-items-center">
    <h5>Danh sách đơn hàng</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm sản phẩm
    </button>
</div>

<form class="row g-3 align-items-end mt-2 mb-3">
    <!-- Danh mục -->
    <div class="col-md-3">
        <select id="search_category" class="form-select">
            <option value="">Tất cả danh mục</option>
            <?php
            foreach ($categories as $category) {
                echo '<option value="' . $category['category_id'] . '">' . $category['category_name'] . '</option>';
            }
            ?>
        </select>
    </div>

    <!-- Nút tìm kiếm -->
    <div class="col-md-2 d-grid">
        <button type="submit" id="search_btn" class="btn btn-primary">Tìm kiếm</button>
    </div>
</form>

<div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold">Id đơn hàng</th>
                <th scope="col" class="fw-bold text-center">Tổng tiền</th>
                <th scope="col" class="fw-bold text-center">Tình trạng</th>
                <th scope="col" class="fw-bold text-center">Người mua</th>
                <th scope="col" class="fw-bold text-center">Tuỳ chọn</th>
            </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <div id="pagination"></div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm mới</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="product_name">
                        <div class="text-danger error-message" id="error-name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input placeholder="Nhập mô tả ngắn" type="text" class="form-control" id="subdesc">
                        <div class="text-danger error-message" id="error-subdesc"></div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="thumbnail">
                        <div class="text-danger error-message" id="error-thumbnail"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Lượt bán</label>
                            <input type="number" value="0" class="form-control" id="solds">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Lượt xem</label>
                            <input type="number" value="0" class="form-control" id="views">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" id="category">
                                <?php
                                foreach ($categories as $key => $category) {
                                    echo '<option value="' . $category['category_id'] . '">' . $category['category_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="text-danger error-message" id="error-category"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" id="brand">
                                <?php
                                foreach ($brands as $key => $brand) {
                                    echo '<option value="' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</option>';
                                }
                                ?>
                            </select>
                            <div class="text-danger error-message" id="error-brand"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea id="editor"></textarea>
                        <div class="text-danger error-message" id="error-description"></div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_public" checked>
                        <label class="form-check-label" for="is_public">Hiện sản phẩm</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" id="add_btn" class="btn btn-primary">Thêm ngay</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal to update order -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateOrderModalLabel">Chỉnh Sửa Đơn Hàng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="updateOrderForm">
                    <!-- Hidden fields (ID, ngày đặt hàng) -->
                    <input type="hidden" id="order_id" name="order_id">
                    <input type="hidden" id="order_date" name="order_date">

                    <!-- Tổng tiền -->
                    <div class="mb-3">
                        <label for="total_amount" class="form-label">Tổng tiền</label>
                        <input type="text" class="form-control" id="total_amount" name="total_amount" readonly>
                        <div class="text-danger error-message d-none" id="error_total_amount">Tổng tiền không hợp lệ.</div>
                    </div>

                    <!-- Trạng thái đơn hàng -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="pending">Chờ xác nhận</option>
                            <option value="processing">Đang xử lý</option>
                            <option value="shipped">Đang giao hàng</option>
                            <option value="delivered">Đã giao</option>
                            <option value="cancelled">Đã hủy</option>
                        </select>
                        <div class="text-danger error-message d-none" id="error_status">Vui lòng chọn trạng thái.</div>
                    </div>

                    <!-- Người đặt -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">Người đặt</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" readonly>
                    </div>

                    <!-- Địa chỉ -->
                    <div class="mb-3">
                        <label for="address_id" class="form-label">Mã địa chỉ</label>
                        <input type="text" class="form-control" id="address_id" name="address_id" readonly>
                    </div>

                    <!-- Mã voucher -->
                    <div class="mb-3">
                        <label for="voucher_id" class="form-label">Mã giảm giá</label>
                        <input type="text" class="form-control" id="voucher_id" name="voucher_id" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button id="updateBtn" type="button" class="btn btn-primary">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        const updateBtn = $('#updateBtn');

        // Gán global function để gọi từ HTML onclick
        window.setUpdatedOrder = (id) => {
            $.ajax({
                url: `?controller=order&action=get_order_by_id&id=${id}`,
                method: 'GET',
                dataType: 'json',
                success: (response) => {
                    const order = Array.isArray(response.data) ? response.data[0] : response.data;
                    console.log(order); // Debug

                    $('#order_id').val(order.order_id);
                    $('#user_id').val(order.user_id);
                    $('#status').val(order.status ?? 'pending');
                    $('#total_amount').val(order.total_amount);
                    $('#order_date').val(order.order_date);
                    $('#address_id').val(order.address_id);
                    $('#voucher_id').val(order.voucher_id);

                    $('#updateModal').modal('show');
                },
                error: (error) => {
                    showToast(error.responseText);
                }
            });
        };

        const renderListOrder = (orders) => {
            let html = '';
            if (!orders || orders.length === 0) {
                html = `<tr><td colspan="5" class="text-center text-muted">Không có đơn hàng nào</td></tr>`;
            } else {
                html = orders.map(order => {
                    return `
                        <tr>
                            <td style="width: 350px">${order.order_id}</td>
                            <td class="text-center">${Number(order.total_amount).toLocaleString()}₫</td>
                            <td class="text-center">${order.status === null ? 'Chờ xác nhận' : order.status}</td>
                            <td class="text-center">${order.user_id}</td>
                            <td class="text-center">
                                <button type="button" class="btn-sm btn-primary" onclick="setUpdatedOrder('${order.order_id}')">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <button type="button" class="btn-sm btn-danger" onclick="setIdProduct('${order.order_id}')">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </td>
                        </tr>`;
                }).join('');
            }

            $('#table-body').html(html);
        };

        const fetchListOrders = () => {
            const page = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;

            $.ajax({
                url: `?controller=order&action=get_list_orders&page=${page}`,
                method: 'GET',
                dataType: 'json',
                success: (response) => {
                    renderListOrder(response.data);
                    if (response.pagination) {
                        renderPagination(page, response.pagination.total);
                    }
                },
                error: (error) => {
                    console.log(error.responseText);
                }
            });
        };

        fetchListOrders();

        updateBtn.on('click', function() {
            $('#error_status, #error_total_amount, #error_order_date').hide();

            const status = $('#status').val().trim();
            const totalAmount = $('#total_amount').val().trim();
            const orderDate = $('#order_date').val().trim();

            let hasError = false;

            if (!status) {
                $('#error_status').show();
                hasError = true;
            }

            if (!totalAmount) {
                $('#error_total_amount').show();
                hasError = true;
            }

            if (!orderDate) {
                $('#error_order_date').show();
                hasError = true;
            }

            if (hasError) return;

            const id = $('#order_id').val();

            $.ajax({
                url: '?controller=order&action=update_order_by_id',
                method: 'POST',
                dataType: 'json',
                data: {
                    order_id: id,
                    status: status,
                    total_amount: totalAmount,
                    order_date: orderDate,
                    user_id: $('#user_id').val(),
                    address_id: $('#address_id').val(),
                    voucher_id: $('#voucher_id').val()
                },
                success: (response) => {
                    $('#updateModal').modal('hide');
                    fetchListOrders();
                    showToast(response.message);
                },
                error: (error) => {
                    showToast(error.responseText);
                }
            });
        });
    });
</script>