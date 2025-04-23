<?php
    if(!isset($_SESSION['user'])) {
        header('Location: ?controller=auth');
        die();
    } else if (!isset($_SESSION['order_list']) || empty($_SESSION['order_list'])) {
        header('Location: ?controller=home');
        die('Không tìm thấy sản phẩm');
    }
    $total_price = 0;
    if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])) {
        foreach($_SESSION['order_list'] as $product) {
            $total_price += $product['price'] * $product['quantity'];
        }
    }
    $cities = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng', 'Huế', 'Nha Trang', 'Vũng Tàu'];
?>


<div style="padding-top: 76px;">
    <div class="container pb-5">
        <h4 class="mb-3 text-center">Thông tin đơn hàng</h4>
        <div class="row">
            <!-- Left Side: User Info + Address -->
            <div class="col-md-7">
                <div class="card mb-4">
                    <div class="card-header fw-bold">Thông Tin Người Đặt</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Họ và tên</label>
                            <input class="form-control bg-light"
                                value="<?= $_SESSION['user']['fullname'] ?? '' ?> "></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input class="form-control bg-light"
                                value="<?= $_SESSION['user']['phone'] ?? '' ?> "></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control bg-light"
                                value="<?= $_SESSION['user']['email'] ?? '' ?>"></input>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header fw-bold">Địa Chỉ Giao Hàng</div>
                    <div class="card-body">
                        <form id="addressForm">
                            <!-- Dropdown địa chỉ có sẵn -->
                            <div class="mb-3">
                                <label for="saved-address" class="form-label">Chọn địa chỉ</label>
                                <select class="form-select" id="address_id" name="address_id" required>
                                    <option value="">-- Chọn địa chỉ --</option>
                                    <?php 
                                  
                                        foreach ($address as $add) {
                                            echo '<option value="'.$add['address_id'].'" data-street="'.$add['street'].'" 
                                                  data-district="'.$add['district'].'" data-city="'.$add['city'].'">'.
                                                    $add['street'].', Quận '.$add['district'].', '.$add['city'].
                                                '</option>';
                                        }
                                    ?>
                                    <option value="new">Địa chỉ mới</option>
                                </select>
                                <div class="text-danger" id="address-error"></div>
                            </div>

                            <!-- Nhập địa chỉ mới -->
                            <div id="custom-address" style="display: none;">
                                <div class="mb-3">
                                    <label for="street" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="street" id="street"
                                        placeholder="Số nhà, đường, phường...">
                                    <div class="text-danger" id="street-error"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">Tỉnh/Thành phố</label>
                                        <select class="form-control" id="city" name="city">
                                            <option value="">-- Chọn tỉnh/thành --</option>
                                            <?php foreach ($cities as $city): ?>
                                            <option value="<?= $city ?>"><?php echo $city ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="text-danger" id="city-error"></div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="district" class="form-label">Quận/Huyện</label>
                                        <input placeholder="Quận / Huyện" id="district" type="text" class="form-control"
                                            name="district">
                                        <div class="text-danger" id="district-error"></div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="district" class="form-label">Phường / Xã</label>
                                        <input placeholder="Phường / Xã" id="ward" type="text" class="form-control"
                                            name="district">
                                        <div class="text-danger" id="ward-error"></div>
                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="add_address">Thêm địa chỉ mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Order Summary -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header fw-bold">Đơn Hàng Của Bạn</div>
                    <div class="card-body">
                        <!-- List of Products -->
                        <ul class="list-group mb-3" id="order-cart">
                            <?php 
                                if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])) {
                                    foreach($_SESSION['order_list'] as $product) {
                                        $product_total = $product['price'] * $product['quantity'];
                                        echo '
                                        <li class="list-group-item d-flex justify-content-between align-items-start">
                                            <div class="d-flex gap-3">
                                                <img src="'.$product['thumbnail'].'" 
                                                    alt="'.$product['product_name'].'" width="60" height="60"
                                                    style="object-fit: contain; border-radius: 6px;">
                                                <div>
                                                    <h6 class="mb-1">'.$product['product_name'].'</h6>
                                                    <small class="text-muted">Số lượng: '.$product['quantity'].'</small><br>
                                                    <small class="text-muted">Size: '.$product['size_name'].'</small><br>
                                                    <small class="text-muted">Màu sắc: '.$product['color_name'].'</small>
                                                </div>
                                            </div>
                                            <small class="text-muted">'.number_format($product_total, 0, ',', '.').'đ</small>
                                        </li>';
                                    }
                                } else {
                                    echo '<li class="list-group-item">Giỏ hàng trống</li>';
                                }
                            ?>
                        </ul>

                        <div class="mb-3">
                            <label for="voucher" class="form-label">Mã giảm giá</label>
                            <select class="form-select" id="voucher" name="voucher_code">
                                <option value="">-- Chọn mã giảm giá --</option>
                                <?php foreach ($voucher as $v): ?>
                                <option value="<?= $v['voucher_id'] ?>" data-value="<?= $v['discount_value'] ?>">
                                    <?= $v['voucher_id'] ?> - Giảm
                                    <?= number_format($v['discount_value'], 0, ',', '.') ?>đ
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Tạm tính:</span>
                            <strong id="subtotal"><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </div>
                        <div class="d-flex justify-content-between text-danger" id="discount-row" style="display:none;">
                            <span>Giảm giá:</span>
                            <strong id="discount"></strong>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Phí vận chuyển:</span>
                            <strong id="shipping-fee">0đ</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5 mb-2">
                            <span>Tổng cộng:</span>
                            <strong id="total-amount"><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </div>
                        <!-- <h6>Chọn phương thức thanh toán</h6>
                        <select id="payment-method" name="payment_method">
                            <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                            <option value="zalo">Thanh toán qua Zalo Pay</option>
                        </select> -->
                        <!--    <input type="hidden" name="method" id="selected-method" value="zalo">
                        <button type="submit" class="btn btn-primary w-100 mt-4" id="order-zalopay">Thanh toán Zalo
                            Pay</button> -->
                        <!-- Nút Đặt hàng (hiện mặc định) -->
                        <button class="btn btn-primary w-100 mt-4" id="checkout-btn">Đặt hàng</button>
                    </div>
                    <input type="hidden" id="new_address_id" name="new_address_id" value="">
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<script>
$('#add_address').click((e) => {
    e.preventDefault();

    const ward = $('#ward').val().trim();
    const district = $('#district').val().trim();
    const city = $('#city').val().trim();
    const street = $('#street').val().trim();

    let isValid = true;

    // Xóa lỗi cũ
    $('.error-text').text('');

    if (!street) {
        $('#street-error').text('Vui lòng nhập tên đường');
        isValid = false;
    }
    if (!ward) {
        $('#ward-error').text('Vui lòng nhập phường/xã');
        isValid = false;
    }
    if (!district) {
        $('#district-error').text('Vui lòng nhập quận/huyện');
        isValid = false;
    }
    if (!city) {
        $('#city-error').text('Vui lòng nhập tỉnh/thành phố');
        isValid = false;
    }

    if (!isValid) return;

    $.ajax({
        url: '?controller=adress&action=add_address',
        method: 'POST',
        dataType: 'json',
        data: {
            ward,
            district,
            city,
            street,
            user_id: <?php echo $_SESSION['user']['user_id'] ?>
        },
        success: (res) => {
            if (res.success) {
                $('#new_address_id').val(res.data.id);
                $('#add_address').prop('disabled', true);
                showToast("Thêm địa chỉ thành công");
            } else {
                showToast("Không thể thêm địa chỉ");
            }
        },
        error: (err) => {
            showToast('Có lỗi xảy ra');
        }
    });
});


$(document).ready(function() {
    const select = document.getElementById("payment-method");
    const zaloForm = document.getElementById("payment-form");
    const codButton = document.getElementById("checkout-btn");
    const hiddenInput = document.getElementById("selected-method");
    // Toggle địa chỉ mới
    $('#address_id').change(function() {
        if ($(this).val() === 'new') {
            $('#custom-address').show();
            // Clear các trường địa chỉ
            $('#custom-address input').val('');
        } else {
            $('#custom-address').hide();
            // Điền thông tin địa chỉ đã chọn
            const selected = $(this).find(':selected');
            $('input[name="street"]').val(selected.data('street') || '');
            $('input[name="district"]').val(selected.data('district') || '');
            $('input[name="city"]').val(selected.data('city') || '');
        }
    });

    // Xử lý voucher
    let discount_value = '';

    $('#voucher').change(function() {
        const discount_value = parseInt($('#voucher option:selected').data('value')) || 0;

        if (discount_value > 0) {
            $('#discount-row').show();
            $('#discount').text('-' + discount_value.toLocaleString('vi-VN') + 'đ');

            const subtotal = parseInt($('#subtotal').text().replace(/[^\d]/g, ''));
            const newTotal = subtotal - discount_value;
            $('#total-amount').text(newTotal.toLocaleString('vi-VN') + 'đ');
        } else {
            $('#discount-row').hide();
            $('#discount').text('');
            const subtotal = parseInt($('#subtotal').text().replace(/[^\d]/g, ''));
            $('#total-amount').text(subtotal.toLocaleString('vi-VN') + 'đ');
        }
    });

    // Xử lý khi click nút đặt hàng
    $('#checkout-btn').click(function(e) {
        e.preventDefault();
        // Xoá lỗi cũ nếu có
        $('#address-error').text('');
        const userId = <?= $_SESSION['user']['user_id'] ?? 0 ?>;
        const addressSelectValue = $('#address_id').val();
        const addressId = (addressSelectValue === 'new') ?
            $('#new_address_id').val() :
            addressSelectValue;

        if (!addressId) {
            $('#address-error').text('Vui lòng chọn địa chỉ giao hàng');
            return; // Dừng lại nếu không có địa chỉ
        }

        const voucherCode = $('#voucher').val();
        const discountValue = $('#voucher option:selected').data('value') || 0;
        const totalAmount = parseInt($('#total-amount').text().replace(/[^\d]/g, ''));
        const subTotal = discountValue - totalAmount;

        const orderItems = [];
        <?php if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])): ?>
        <?php foreach($_SESSION['order_list'] as $product): ?>
        orderItems.push({
            variant_id: <?= $product['variant_id'] ?>,
            product_id: <?= $product['product_id'] ?>,
            price: <?= $product['price'] ?? 0 ?>,
            quantity: <?= $product['quantity'] ?? 0 ?>
        });
        <?php endforeach; ?>
        <?php endif; ?>

        $.ajax({
            url: '?controller=home&action=add_orders',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                user_id: userId,
                address_id: addressId,
                voucher_id: voucherCode,
                total_amount: totalAmount,
                items: orderItems
            }),
            success: function(response) {
                if (response.success) {
                    updateCartQuantitySpan();
                    showToast(response.message);
                    setTimeout(() => {
                        window.location.href =
                            '?controller=home&action=checkout&id=' + response.data
                            .order_id;
                    }, 2000)
                } else {
                    showToast(response.message);
                }
            },
            error: function(xhr) {
                showToast(xhr.message);
                console.error("Chi tiết lỗi:", xhr.responseText);
            }
        });
    });
    $('#order-zalopay').click(() => {
        const userId = <?= $_SESSION['user']['user_id'] ?? 0 ?>;
        const addressId = 1;
        const voucherCode = $('#voucher').val();
        const orderItems = [];
        <?php if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])): ?>
        <?php foreach($_SESSION['order_list'] as $product): ?>
        orderItems.push({
            variant_id: <?= $product['variant_id'] ?>,
            product_id: <?= $product['product_id'] ?>,
            price: <?= $product['price'] ?? 0 ?>,
            quantity: <?= $product['quantity'] ?? 0 ?>
        });
        <?php endforeach; ?>
        <?php endif; ?>
        $.ajax({
            url: '?controller=home&action=payment',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify({
                total_amount: parseInt($('#total-amount').text().replace(/[^\d]/g,
                    '')),
                user_id: userId,
                address_id: addressId,
                voucher_id: voucherCode,
                items: orderItems
            }),
            success: (res) => {
                console.log("Phản hồi từ server:", res);
                window.location.href = res.redirect_url;
            },
            error: (err) => {
                console.error("Lỗi:", err);
            }
        });
    });
})
</script>