<?php
function renderOrders($orders) {
    if (empty($orders)) {
        echo "<p>Không có đơn hàng.</p>";
        return;
    }

    foreach ($orders as $order) {
        echo "<div class='card mb-3 p-3 border'>";
        echo "<h6>Đơn hàng #{$order['order_id']} - {$order['status']} - Ngày: {$order['order_date']}</h6>";

        foreach ($order['products'] as $product) {
            echo "<div class='d-flex align-items-center mb-2'>
                    <img src='{$product['thumbnail']}' style='width:80px;height:80px;object-fit:cover;margin-right:15px;'>
                    <div>
                        <p><strong>{$product['product_name']}</strong></p>
                        <p class='text-danger mb-0'>Giá: " . number_format($product['price'], 0, ',', '.') . "₫</p>
                        <p class='text-muted mb-0'>Số lượng: {$product['quantity']}</p>
                    </div>
                  </div>";
        }

        echo "</div>";
    }
}

$tabs = [
    'Tất Cả' => [],
    'Chưa xác nhận' => [],
    'Đã xác nhận' => [],
    'Đang giao' => [],
    'Đã giao' => [],
    'Đã trả' => [],
    'Đã hủy' => [],
];

foreach ($orders_by_status as $status => $orders) {
    $tabs[$status] = $orders;
    foreach ($orders as $o) {
        $tabs['Tất Cả'][] = $o;
    }
}
?>

<div class="container ctn-noti mt-4">
    <ul class="nav nav-pills">
        <?php foreach ($tabs as $key => $val): ?>
        <li class="nav-item">
            <a class="nav-link <?= $key == 'Tất Cả' ? 'active' : '' ?>" data-bs-toggle="pill" href="#<?= md5($key) ?>">
                <?= $key ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <div class="line"></div>

    <div class="tab-content mt-3">
        <?php foreach ($tabs as $status => $orders): ?>
        <div class="tab-pane fade <?= $status == 'Tất Cả' ? 'show active' : '' ?>" id="<?= md5($status) ?>">
            <h5><?= $status ?></h5>
            <?php renderOrders($orders); ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>