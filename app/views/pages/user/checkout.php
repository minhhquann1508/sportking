<<<<<<< HEAD
<!-- <?php
$total_price = 0;
?>
 <?php print_r($_SESSION['order_list'])?>  -->

 <?php
session_start();
$orderItems = $_SESSION['orderItems'] ?? [];
$user = $_SESSION['user'] ?? [];
$address = $_SESSION['address'] ?? []; 
$total_price = 0;
print_r($_SESSION['orderItems']);
?>
=======
<?php
  $orderItems = $_SESSION['orderItems'] ?? [];
  $user = $_SESSION['user'] ?? [];
  $address = $_SESSION['address'] ?? []; 
  $total_price = 0;
?>
>>>>>>> 7838b6e97fb0d083608065f15a48c970e9eddb8f
<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Thanh Toán</h1>
        <p class="text-muted">Vui lòng xác nhận lại đơn hàng</p>
    </div>

    <div class="row gx-5">
        <!-- Thông tin người nhận -->
        <div class="col-md-6">
            <h5 class="mb-3 text-uppercase">Thông tin nhận hàng</h5>
            <div class="p-3 bg-light rounded">
                <p class="mb-1 fw-bold">Họ tên: <?= $user['fullname'] ?? 'Chưa có' ?></p>
                <p class="mb-1">SĐT: <?= $user['phone'] ?? 'Chưa có' ?></p>
                <p class="mb-1">Email: <?= $user['email'] ?? 'Chưa có' ?></p>
                <hr>
                <p class="fw-bold mb-1">Địa chỉ nhận hàng:</p>
                <ul class="mb-0 ps-3">
                    <?php foreach ($address as $add): ?>
<<<<<<< HEAD
                        <li><?= $add['street'] ?>, Quận <?= $add['district'] ?>, <?= $add['city'] ?></li>
=======
                    <li><?= $add['street'] ?>, Quận <?= $add['district'] ?>, <?= $add['city'] ?></li>
>>>>>>> 7838b6e97fb0d083608065f15a48c970e9eddb8f
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="mt-4">
                <h5 class="text-uppercase">Phương thức thanh toán</h5>
                <p>Thanh toán khi nhận hàng (COD)</p>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header fw-bold">Đơn hàng của bạn</div>
                <div class="card-body">
                    <ul class="list-group mb-3" id="order-cart">
                        <?php if (!empty($orderItems)): ?>
<<<<<<< HEAD
                            <?php foreach ($orderItems as $item): 
                                $productTotal = $item['price'] * $item['quantity'];
                                $total_price += $productTotal;
                            ?>
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="d-flex gap-3">
                                        <img src="<?= $item['thumbnail'] ?>" alt="<?= $item['product_name'] ?>"
                                             width="60" height="60" style="object-fit: contain; border-radius: 6px;">
                                        <div>
                                            <h6 class="mb-1"><?= $item['product_name'] ?></h6>
                                            <small class="text-muted">Số lượng: <?= $item['quantity'] ?></small><br>
                                            <small class="text-muted">Size: <?= $item['size_name'] ?></small><br>
                                            <small class="text-muted">Màu: <?= $item['color_name'] ?></small>
                                        </div>
                                    </div>
                                    <small class="text-muted"><?= number_format($productTotal, 0, ',', '.') ?>đ</small>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">Không có sản phẩm nào trong đơn hàng.</li>
=======
                        <?php foreach ($orderItems as $item): 
                                $productTotal = $item['price'] * $item['quantity'];
                                $total_price += $productTotal;
                            ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="d-flex gap-3">
                                <img src="<?= $item['thumbnail'] ?>" alt="<?= $item['product_name'] ?>" width="60"
                                    height="60" style="object-fit: contain; border-radius: 6px;">
                                <div>
                                    <h6 class="mb-1"><?= $item['product_name'] ?></h6>
                                    <small class="text-muted">Số lượng: <?= $item['quantity'] ?></small><br>
                                    <small class="text-muted">Size: <?= $item['size_name'] ?></small><br>
                                    <small class="text-muted">Màu: <?= $item['color_name'] ?></small>
                                </div>
                            </div>
                            <small class="text-muted"><?= number_format($productTotal, 0, ',', '.') ?>đ</small>
                        </li>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <li class="list-group-item">Không có sản phẩm nào trong đơn hàng.</li>
>>>>>>> 7838b6e97fb0d083608065f15a48c970e9eddb8f
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="text-uppercase text-center mb-3">Tóm tắt đơn hàng</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Tổng tiền hàng</span>
                            <strong><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Phí vận chuyển</span>
                            <strong>0đ</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between text-danger fw-bold">
                            <span>Tổng thanh toán</span>
                            <strong><?= number_format($total_price, 0, ',', '.') ?>đ</strong>
                        </li>
                    </ul>
                    <div class="d-grid mt-3">
                        <button class="btn btn-primary">Xác nhận đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- <div class="container py-4">
  <div class="text-center mb-4">
    <h1 class="display-5 fw-bold">Check Out</h1>
    <p class="text-muted">Vui lòng thực hiện thao tác</p>
  </div>

  <div class="row gx-5">
  
    <div class="col-md-6">
      <h5 class="mb-3 text-uppercase">Thông tin nhận hàng</h5>
      <div class="p-3 bg-light rounded">
        <p class="mb-1 fw-bold">Địa chỉ nhận hàng</p>
        <p class="mb-0"><?php echo $_SESSION['user']['fullname'] ?> </p>
        <p class="mb-0"> <?php echo $_SESSION['user']['phone'] ?> </p>
        <p class="mb-0">
                          <?php 
                            foreach ($address as $add) {
                                echo '<option value="'.$add['address_id'].'">'.
                                        $add['street'].', Quận '.$add['district'].', '.$add['city'].
                                    '</option>';
                            }?>        
                          </p>
      </div>

      <div class="mt-4">
        <h5 class="text-uppercase">Phương thức thanh toán</h5>
        <p>Thanh toán khi nhận hàng</p>
      </div>
    </div>

   
    <div class="col-md-6">
      <div class="card">
            <div class="card-header fw-bold">Đơn hàng của bạn</div>
            <div class="card-body">
                <ul class="list-group mb-3" id="order-cart">

                </ul>
            </div>
      </div>
     

    ]
      <ul class="list-group mb-3">
        
        <h5 class="text-uppercase text-center mt-1">tóm tắt đơn hàng</h5>
        <div class="mt-4" id="cart-total">
                            
        </div>
      </ul>
    </div>
  </div>
</div> -->
<!-- <script>
  const cart = <?php echo json_encode($_SESSION['order_list'] ?? []); ?>;

    const renderOrder = (cart) => {
      let html = '';

      if (Object.keys(cart).length === 0) {
          html = `<li class="list-group-item">Không có sản phẩm nào trong giỏ hàng.</li>`;
      } else {
          // TODO: FIX It
          $totalPrice = 0;
          $subtotal = 0;
          Object.keys(cart).forEach(product => {
              // $total_price = product['price'] * product['quantity'];
              // $subtotal += $total_price;
              
              html += `
                      <li class="list-group-item d-flex justify-content-between align-items-start">
                          <div class="d-flex gap-3">
                              <img src="${product.thumbnail}" alt="${product.product_name}" width="60" height="60"
                                  style="object-fit: contain; border-radius: 6px;">
                              <div>
                                  <h6 class="mb-1">${product.product_name}</h6>
                                  <small class="text-muted">Số lượng: ${product.quantity}</small><br>
                                  <small class="text-muted">Size: ${product.size_name}</small><br>
                                  <small class="text-muted">Màu sắc: ${product.color_name}</small>
                              </div>
                          </div>
                          <small class="text-muted">${$totalPrice.toLocaleString('vi-VN')}đ</small>
                      </li>
                  `;
              });
      }

      document.getElementById('order-cart').innerHTML = html;
    };

    const renderTotal = () => {
      let totalQuantity = 0;
      let totalPrice = 0;

      if (checkedItems.length > 0) {
          checkedItems.forEach(item => {
              const {
                  quantity,
                  price,
              } = item;
              const oldPrice = price;

              totalQuantity += quantity;
              totalPrice += price * quantity;
          });
      }

      const shipping = 0;
      const grandTotal = totalPrice + shipping;

      const html = `
          <ul>
              <li class="d-flex justify-content-between mb-2">
                  <span>${totalQuantity} sản phẩm</span>
                  <span>${formatCurrency(totalPrice)}</span>
              </li>
              <li class="d-flex justify-content-between mb-2">
                  <span>Giao hàng</span>
                  <span>Miễn phí</span>
              </li>
              <hr>
              <li class="d-flex justify-content-between mt-2">
                  <strong>Tổng</strong>
                  <strong>${formatCurrency(grandTotal)}</strong>
              </li>
          </ul>
      `;
      if (checkedItems.length <= 0) {
          $('#submit-btn').prop('disabled', true);
      } else {
          $('#submit-btn').prop('disabled', false);
      }
      document.getElementById('cart-total').innerHTML = html;
    };


  $(document).ready(() => {
  renderOrder(cart);
  });
<<<<<<< HEAD
</script> -->
=======
</script> -->
>>>>>>> 7838b6e97fb0d083608065f15a48c970e9eddb8f
