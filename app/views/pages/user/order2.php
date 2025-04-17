<?php
$total_price = 0;
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
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Họ và tên</label>
                                <input type="text" class="form-control"
                                    value="<?php echo $_SESSION['user']['fullname'] ?>" id="name"
                                    placeholder="Nguyễn Văn A">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" value="<?php echo $_SESSION['user']['phone'] ?>"
                                    id="name" id="phone">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control"
                                    value="<?php echo $_SESSION['user']['email'] ?>" id="email"
                                    placeholder="abc@example.com">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header fw-bold">Địa Chỉ Giao Hàng</div>
                    <div class="card-body">
                        <form>
                            <!-- Dropdown địa chỉ có sẵn -->
                            <div class="mb-3">
                                <label for="saved-address" class="form-label">Chọn địa chỉ</label>
                                <select class="form-select" id="saved-address">
                                    <option value="">-- Chọn địa chỉ --</option>
                                    <?php 
                                        foreach ($address as $add) {
                                            echo '<option value="'.$add['address_id'].'">'.
                                                    $add['street'].', Quận '.$add['district'].', '.$add['city'].
                                                '</option>';
                                        }
                                    ?>
                                    <option value="other">Địa chỉ khác</option>
                                </select>
                            </div>

                            <!-- Nhập địa chỉ mới -->
                            <div id="custom-address" style="display: none;">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address"
                                        placeholder="Số nhà, đường, phường...">
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">Tỉnh/Thành phố</label>
                                        <input type="text" class="form-control" id="city">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="district" class="form-label">Quận/Huyện</label>
                                        <input type="text" class="form-control" id="district">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="note" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="note" rows="2"
                                        placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
                                </div>
                                <div class="text-end">
                                    <button class="btn btn-primary">Lưu địa chỉ</button>
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
                        <ul class="list-group mb-3">
                            <?php 
                                $subtotal = 0;
                                foreach ($orders as $index => $product): 
                                    $total_price = $product['price'] * $product['quantity'];
                                    $subtotal += $total_price;
                            ?>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="d-flex gap-3">
                                    <img src="<?php echo $product['thumbnail']; ?>"
                                        alt="<?php echo $product['product_name']; ?>" width="60" height="60"
                                        style="object-fit: contain; border-radius: 6px;">
                                    <div>
                                        <h6 class="mb-1"><?php echo $product['product_name']; ?></h6>
                                        <small class="text-muted">Số lượng:
                                            <?php echo $product['quantity']; ?></small><br>
                                        <small class="text-muted">Size: <?php echo $product['size_name']; ?></small><br>
                                        <small class="text-muted">Màu sắc: <?php echo $product['color_name']; ?></small>
                                    </div>
                                </div>
                                <small
                                    class="text-muted"><?php echo number_format($total_price, 0, ',', '.') . 'đ'; ?></small>
                            </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Subtotal -->
                        <div class="d-flex justify-content-between">
                            <span>Tạm tính:</span>
                            <strong><?php echo number_format($total_price, 0, ',', '.') . 'đ'; ?></strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fs-5">
                            <span>Tổng cộng:</span>
                            <strong>
                                <strong
                                    id="total_amount"><?php echo number_format($total_price, 0, ',', '.'); ?></strong><strong>đ</strong>
                            </strong>
                        </div>

                        <button class="btn btn-primary w-100 mt-4" id="add-btn">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript để điều khiển hiển thị -->
<script>
document.getElementById('saved-address').addEventListener('change', function() {
    const selectedValue = this.value;
    const customAddress = document.getElementById('custom-address');

    if (selectedValue === 'other') {
        customAddress.style.display = 'block';
    } else {
        customAddress.style.display = 'none';
    }
});

$('#add-btn').click(() => {
    const total_amount = Number($('#total_amount').text().replace(/\./g, ''));
    const address_id = $('#saved-address').val();
    if (address_id !== '' && address_id !== 'other') {
        $.ajax({
            url: '?controller=order&action=add_order',
            method: 'POST',
            dataType: 'json',
            data: {
                address_id: address_id,
                total_amount: total_amount
            },
            success: (res) => {
                const order_id = res.data.order_id
                showToast('Đặt hàng thành công');
                window.location.href = `?controller=home&action=checkout&order_id=${order_id}`
            },
            error: (err) => {
                console.log(err);
            }
        })
    }
})
</script>