<?php
function renderOrders($orders) {
    if (empty($orders)) {
        echo "<p class='text-muted fst-italic'>Không có đơn hàng.</p>";
        return;
    }

    foreach ($orders as $order) {
        echo "<div class='order-card'>";
        echo "<div class='order-header'>";
        echo "<span>Đơn hàng <strong>#{$order['order_id']}</strong></span>";
        echo "<span>{$order['status']} | Ngày: <strong>{$order['order_date']}</strong></span>";
        echo "</div>";

        foreach ($order['products'] as $product) {
            echo "<div class='product-item'>
                    <img src='{$product['thumbnail']}' class='product-img'>
                    <div class='product-info'>
                        <p><strong>{$product['product_name']}</strong></p>
                        <p>Màu: {$product['color']} | Size: {$product['size']}</p>
                        <p class='price'>Giá: " . number_format($product['price'], 0, ',', '.') . "₫</p>
                        <p class='qty'>Số lượng: {$product['quantity']}</p>
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
    <ul class="nav nav-pills justify-content-center flex-wrap" id="orderTab" role="tablist">
        <?php foreach ($tabs as $key => $val): 
            $tabId = md5($key);
        ?>
        <li class="nav-item" role="presentation">
            <button class="nav-link <?= $key == 'Tất Cả' ? 'active' : '' ?>" id="tab-<?= $tabId ?>"
                data-bs-toggle="pill" data-bs-target="#pane-<?= $tabId ?>" type="button" role="tab"
                aria-controls="pane-<?= $tabId ?>" aria-selected="<?= $key == 'Tất Cả' ? 'true' : 'false' ?>">
                <?= $key ?>
            </button>
        </li>
        <?php endforeach; ?>
    </ul>

    <div class="line"></div>

    <div class="tab-content mt-3" id="orderTabContent">
        <?php foreach ($tabs as $status => $orders): 
            $paneId = md5($status);
        ?>
        <div class="tab-pane fade <?= $status == 'Tất Cả' ? 'show active' : '' ?>" id="pane-<?= $paneId ?>"
            role="tabpanel" aria-labelledby="tab-<?= $paneId ?>">
            <h5 class="mb-3 fw-bold"><?= $status ?></h5>
            <?php renderOrders($orders); ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.ctn-noti .nav-pills .nav-link {
    border-radius: 20px;
    padding: 8px 20px;
    margin: 5px;
    background-color: #f1f1f1;
    color: #333;
    font-weight: 500;
}

.ctn-noti .nav-pills .nav-link.active {
    background-color: #007bff;
    color: #fff;
}

.ctn-noti .line {
    height: 2px;
    background-color: #dee2e6;
    margin-top: 5px;
    margin-bottom: 15px;
}

.order-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 20px;
    margin-bottom: 20px;
    transition: transform 0.2s ease;
}

.order-card:hover {
    transform: translateY(-2px);
}

.order-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 15px;
    font-weight: 500;
    color: #555;
}

.product-item {
    display: flex;
    align-items: center;
    border-top: 1px solid #eee;
    padding: 15px 0;
}

.product-item:first-child {
    border-top: none;
}

.product-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 15px;
}

.product-info p {
    margin: 0;
    line-height: 1.4;
}

.product-info .price {
    color: #e74c3c;
    font-weight: bold;
}

.product-info .qty {
    color: #888;
}
</style>