 <?php 
    $orderItems = $_SESSION['orderItems'] ?? [];
    $user = $_SESSION['user'] ?? [];
    $address = $_SESSION['address'] ?? []; 
    $total_price = 0;
?>
 <div class="container" style="padding: 76px;">
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
                     <li><?= $add['street'] ?>, Quận <?= $add['district'] ?>, <?= $add['city'] ?></li>
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