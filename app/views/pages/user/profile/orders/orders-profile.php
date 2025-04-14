<div class="container ctn-noti mt-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="pill" href="#all">Tất Cả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="YetConfirm-tab" data-bs-toggle="pill" href="#YetConfirm">Chưa xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="Confirmed-tab" data-bs-toggle="pill" href="#Confirmed">Đã xác nhận</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="delivering-tab" data-bs-toggle="pill" href="#delivering">Đang giao</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="delivered-tab" data-bs-toggle="pill" href="#delivered">Đã giao</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="returns-tab" data-bs-toggle="pill" href="#returns">Đã trả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="cancelations-tab" data-bs-toggle="pill" href="#cancelations">Đã hủy</a>
        </li>
    </ul>
    <div class="line"></div>

    <div class="tab-content mt-3">
        <?php 
        function showOrders($orders) {
            if (empty($orders)) {
                ?>
        <p>Không có đơn hàng.</p>
        <?php
                return;
            }

            foreach ($orders as $order) {
                ?>
        <div class="card mb-3 p-3 border">
            <h6>Đơn hàng #<?= $order['order_id'] ?> - Trạng thái: <?= $order['status'] ?> - Ngày:
                <?= $order['order_date'] ?></h6>
            <?php foreach ($order['products'] as $product) { ?>
            <div class="d-flex align-items-center mb-2">
                <img src="<?= $product['thumbnail'] ?>" alt="<?= $product['product_name'] ?>"
                    style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                <div>
                    <p class="mb-1"><strong><?= $product['product_name'] ?></strong></p>
                    <p class="text-danger mb-0">Giá: <?= number_format($product['price'], 0, ',', '.') ?>₫</p>
                    <p class="text-muted mb-0">Số lượng: <?= $product['quantity'] ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php
            }
        }
        ?>

        <div class="tab-pane fade show active" id="all">
            <div class="notification">
                <h5>Thông Báo Tổng Quan</h5>
                <?php
                    $all_orders = array_merge(...array_values($orders_by_status));
                    showOrders($all_orders);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="YetConfirm">
            <div class="notification">
                <h5>Chưa Xác Nhận</h5>
                <?php showOrders($orders_by_status['Chưa xác nhận'] ?? []); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="Confirmed">
            <div class="notification">
                <h5>Đã Xác Nhận</h5>
                <?php showOrders($orders_by_status['Đã xác nhận'] ?? []); ?>
            </div>
        </div>
        <div class="tab-pane fade" id="delivering">
            <div class="notification">
                <h5>Đang Giao</h5>
                <?php showOrders($orders_by_status['Đang giao'] ?? []); ?>
            </div>
        </div>
        <div class="tab-pane fade" id="delivered">
            <div class="notification">
                <h5>Đã Giao</h5>
                <?php
                    $all_orders = array_merge(...array_values($orders_by_status));
                    showOrders($all_orders);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="returns">
            <div class="notification">
                <h5>Đã Trả</h5>
                <?php
                    $all_orders = array_merge(...array_values($orders_by_status));
                    showOrders($all_orders);
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="cancelations">
            <div class="notification">
                <h5>Đã Hủy</h5>
                <?php
                    $all_orders = array_merge(...array_values($orders_by_status));
                    showOrders($all_orders);
                ?>
            </div>
        </div>
    </div>
</div>