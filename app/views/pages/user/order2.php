<?php
// Tính tổng giá trị đơn hàng từ session
$total_price = 0;
// var_dump($address);
// var_dump($voucher);

if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])) {
    foreach($_SESSION['order_list'] as $product) {
        $total_price += $product['price'] * $product['quantity'];
    }
}
print_r($_SESSION['order_list']);
print_r($address);

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
                            <input class="form-control bg-light"><?= $_SESSION['user']['fullname'] ?? '' ?></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input class="form-control bg-light"><?= $_SESSION['user']['phone'] ?? '' ?></input>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="form-control bg-light"><?= $_SESSION['user']['email'] ?? '' ?></div>
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
                                <select class="form-select" id="saved-address" name="address_id" required>
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
                            </div>

                            <!-- Nhập địa chỉ mới -->
                            <div id="custom-address" style="display: none;">
                                <div class="mb-3">
                                    <label for="street" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" name="street" placeholder="Số nhà, đường, phường...">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">Tỉnh/Thành phố</label>
                                        <input type="text" class="form-control" name="city">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">Quận/Huyện</label>
                                        <input type="text" class="form-control" name="district">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" name="note" rows="2" placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
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
                                    <option value="<?= $v['discount_value'] ?>" data-value="<?= $v['discount_value'] ?>">
                                        <?= $v['voucher_id'] ?> - Giảm <?= number_format($v['discount_value'], 0, ',', '.') ?>đ
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                                
                        <!-- Order Summary -->
                        <!-- <div class="d-flex justify-content-between">
                            <span>Tạm tính:</span>
                            <strong id="subtotal"><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </div> -->
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
                        <div class="d-flex justify-content-between fs-5">
                            <span>Tổng cộng:</span>
                            <strong id="total-amount"><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </div>

                        <button class="btn btn-primary w-100 mt-4" id="checkout-btn">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {


    // $('#voucher').change(function(){
    //    const voucher = $(this).val();
    //    console.log(voucher);
    // });

    
    // Toggle địa chỉ mới
    $('#saved-address').change(function() {
        if($(this).val() === 'new') {
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

    $('#voucher').change(function () {
    discount_value = parseInt($(this).val()); // Ép về số

    if (discount_value > 0) {
        // Hiện dòng giảm giá
        $('#discount-row').show();

        // Hiển thị giá trị giảm giá
        $('#discount').text('-' + discount_value.toLocaleString('vi-VN') + 'đ');

        // Lấy lại giá trị tạm tính
        const subtotal = parseInt($('#subtotal').text().replace(/[^\d]/g, ''));

        // Cập nhật tổng cộng mới
        const newTotal = subtotal - discount_value;
        $('#total-amount').text(newTotal.toLocaleString('vi-VN') + 'đ');
    } else {
        $('#discount-row').hide();
        $('#discount').text('');
        // Reset lại tổng tiền nếu chọn lại về default
        const subtotal = parseInt($('#subtotal').text().replace(/[^\d]/g, ''));
        $('#total-amount').text(subtotal.toLocaleString('vi-VN') + 'đ');
    }
});

    




       // Xử lý khi click nút đặt hàng
    $('#checkout-btn').click(function(e) {
    e.preventDefault();

    console.log(discount_value);

   
    // Lấy thông tin từ form
    const userId = <?= $_SESSION['user']['user_id'] ?? 0 ?>;
    // const addressId = $('#saved-address').val();
    const addressId = 1;
    const voucherCode = $('#voucher').val();
    // const discountValue = $('#voucher option:selected').data('value') || 0;
  
    const totalAmount = parseInt($('#total-amount').text().replace(/[^\d]/g, ''));
    const subTotal = discount_value - totalAmount;
    
    // Kiểm tra dữ liệu trước khi gửi
    console.log("Dữ liệu chuẩn bị gửi:", {
        user_id: userId,
        address_id: addressId,
        voucher_code: voucherCode,
        discount_value: discountValue,
        total_amount: totalAmount,
        subTotal: subTotal
    });
    
    // Chuẩn bị danh sách sản phẩm
    const orderItems = [];
    <?php if(isset($_SESSION['order_list']) && !empty($_SESSION['order_list'])): ?>
        <?php foreach($_SESSION['order_list'] as $product): ?>
            orderItems.push({
                variant_id: 32,
                product_id: 7,
                price: <?= $product['price'] ?? 0 ?>,
                quantity: <?= $product['quantity'] ?? 0 ?>
            });
        <?php endforeach; ?>
    <?php endif; ?>
    
    
    // Gửi dữ liệu dưới dạng JSON
    $.ajax({
        url: '?controller=home&action=add_orders',
        method: 'POST',
        contentType: 'application/json', // Thêm header này
        dataType: 'json',
        data: JSON.stringify({ // Chuyển thành chuỗi JSON
            user_id: userId,
            address_id: addressId,
            voucher_id: voucherCode,
            total_amount: totalAmount,
            items: orderItems
        }),
        success: function(response) {
            if(response.success) {
                alert('Đặt hàng thành công! Mã đơn hàng: ' + response.order_id);
                window.location.href = '?controller=order&action=detail&id=' + response.order_id;
            } else {
                alert('Lỗi: ' + response.message);
            }
        },
        error: function(xhr) {
            console.error("Chi tiết lỗi:", xhr.responseText);
        }
    });
});
        
});



// $('#voucher').change(function() {
//         const discount_value = $(this).val();
//         if(discount_value) {
//             // Gửi AJAX để kiểm tra voucher
//             $.ajax({
//                 url: '?controller=voucher&action=getVoucher',
//                 method: 'POST',
//                 data: { discount_value: discount_value },
//                 success: (res) => {
//                     const discount = response.discount_value;
//                     showToast('áp dụng voucher thành công');
//                 },
//                 error: (err) => {
//                     console.log(err);
//                 }
//             });
//         } else {
//             $('#discount-row').hide();
//         }
//     });


// const cart = <?php echo json_encode($_SESSION['order_list'] ?? []); ?>;

// const renderOrder = (cart) => {
//     let html = '';

//     if (Object.keys(cart).length === 0) {
//         html = `<li class="list-group-item">Không có sản phẩm nào trong giỏ hàng.</li>`;
//     } else {
//         // TODO: FIX It
//         $totalPrice = 0;
//         $subtotal = 0;
//         Object.keys(cart).forEach(product => {
//             // $total_price = product['price'] * product['quantity'];
//             // $subtotal += $total_price;
            
//             html += `
//                     <li class="list-group-item d-flex justify-content-between align-items-start">
//                         <div class="d-flex gap-3">
//                             <img src="${product.thumbnail}" alt="${product.product_name}" width="60" height="60"
//                                 style="object-fit: contain; border-radius: 6px;">
//                             <div>
//                                 <h6 class="mb-1">${product.product_name}</h6>
//                                 <small class="text-muted">Số lượng: ${product.quantity}</small><br>
//                                 <small class="text-muted">Size: ${product.size_name}</small><br>
//                                 <small class="text-muted">Màu sắc: ${product.color_name}</small>
//                             </div>
//                         </div>
//                         <small class="text-muted">${$totalPrice.toLocaleString('vi-VN')}đ</small>
//                     </li>
//                 `;
//             });
//     }

//     document.getElementById('order-cart').innerHTML = html;
// };


// $(document).ready(() => {
//     renderOrder(cart);
// });



</script>
