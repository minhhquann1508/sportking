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
            $price = number_format($product['price'], 0, ',', '.');
            echo "
            <a href='?controller=home&action=detailOrder&order_id={$order['order_id']}' class='product-item'>
                <img src='{$product['thumbnail']}' alt='Ảnh sản phẩm' class='product-img'>
                <div class='product-info'>
                    <p><strong>{$product['product_name']}</strong></p>
                    <p>Màu: {$product['color']} | Size: {$product['size']}</p>
                    <p class='price'>Giá: {$price}₫</p>
                    <p class='qty'>Số lượng: {$product['quantity']}</p>
                </div>
            </a>";
        }

        echo "</div>";
    }
}

$tabs = [
    'Tất Cả' => [],
    'Chờ xác nhận' => [],
    'Đã xác nhận' => [],
    'Đang giao' => [],
    'Đã giao' => [],
    'Đã trả' => [],
    'Đã hủy' => [],
];

if (isset($orders_by_status) && is_array($orders_by_status)) {
    foreach ($orders_by_status as $status => $orders) {
        if (isset($tabs[$status])) {
            $tabs[$status] = $orders;
        }
        $tabs['Tất Cả'] = array_merge($tabs['Tất Cả'], $orders);
    }
}
?>

<div class="container ctn-noti mt-4">
    <div class="d-none d-md-block">
        <ul class="nav nav-pills justify-content-center flex-nowrap overflow-auto" id="orderTab" role="tablist">
            <?php foreach ($tabs as $label => $orders): 
                $tabId = md5($label);
                switch ($label) {
                    case 'Tất Cả':  break;
                    case 'Chờ xác nhận':  break;
                    case 'Đã xác nhận': break;
                    case 'Đang giao': break;
                    case 'Đã giao':  break;
                    case 'Đã trả':  break;
                    case 'Đã hủy':  break;
                }
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $label == 'Tất Cả' ? 'active' : '' ?>" id="tab-<?= $tabId ?>"
                    data-bs-toggle="pill" data-bs-target="#pane-<?= $tabId ?>" type="button" role="tab"
                    aria-controls="pane-<?= $tabId ?>"
                    aria-selected="<?= $label == 'Tất Cả' ? 'true' : 'false' ?>"><?= $label ?>
                </button>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="d-block d-md-none">
        <ul class="nav nav-pills justify-content-center flex-nowrap overflow-auto" id="orderTabMobile" role="tablist">
            <?php foreach ($tabs as $label => $orders): 
                $tabId = md5($label);
                $icon = '';
                switch ($label) {
                    case 'Tất Cả': $icon = 'fa-solid fa-box-open'; break;
                    case 'Chờ xác nhận': $icon = 'fa-solid fa-clock'; break;
                    case 'Đã xác nhận': $icon = 'fa-solid fa-check'; break;
                    case 'Đang giao': $icon = 'fa-solid fa-truck'; break;
                    case 'Đã giao': $icon = 'fa-solid fa-box'; break;
                    case 'Đã trả': $icon = 'fa-solid fa-undo'; break;
                    case 'Đã hủy': $icon = 'fa-solid fa-ban'; break;
                }
            ?>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $label == 'Tất Cả' ? 'active' : '' ?>" id="tab-<?= $tabId ?>"
                    data-bs-toggle="pill" data-bs-target="#pane-<?= $tabId ?>" type="button" role="tab"
                    aria-controls="pane-<?= $tabId ?>" aria-selected="<?= $label == 'Tất Cả' ? 'true' : 'false' ?>">
                    <i class="<?= $icon ?>"></i>
                </button>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="line"></div>

    <div class="tab-content mt-3" id="orderTabContent">
        <?php foreach ($tabs as $status => $orders): 
            $paneId = md5($status); ?>
        <div class="tab-pane fade <?= $status == 'Tất Cả' ? 'show active' : '' ?>" id="pane-<?= $paneId ?>"
            role="tabpanel" aria-labelledby="tab-<?= $paneId ?>">
            <h5 class="mb-3 fw-bold"><?= $status ?></h5>
            <?php renderOrders($orders); ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabLinks = document.querySelectorAll('#orderTab .nav-link');
    const tabSelect = document.querySelector('#orderTabSelect');

    function scrollToStart() {
        const activeTab = document.querySelector('#orderTab .nav-link.active');
        if (activeTab) {
            activeTab.scrollIntoView({
                behavior: 'smooth',
                inline: 'start'
            });
        }
    }

    scrollToStart();

    tabLinks.forEach(link => {
        link.addEventListener('click', () => {
            setTimeout(scrollToStart, 100);
        });
    });

    if (tabSelect) {
        tabSelect.addEventListener('change', function() {
            const selectedTab = tabSelect.value;
            const tabPane = document.querySelector(`#pane-${selectedTab}`);

            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('show',
                'active'));

            if (tabPane) {
                tabPane.classList.add('show', 'active');
            }
        });
    }
});
</script>

<style>
.ctn-noti {
    padding: 0 15px;
}

#orderTab {
    display: flex;
    flex-wrap: nowrap;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    padding-bottom: 5px;
    margin-left: -15px;
    margin-right: -15px;
    padding-left: 15px;
    scroll-snap-type: x mandatory;
}

#orderTab .nav-item {
    flex-shrink: 0;
    white-space: nowrap;
    scroll-snap-align: start;
}

#orderTab .nav-link {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    padding: 10px;
    font-size: 1rem;
    color: #333;
    transition: background-color 0.3s, color 0.3s;
    border-radius: 12px;
    white-space: nowrap;
}

#orderTab .nav-link.active {
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
}

@media (max-width: 768px) {
    .d-none.d-md-block {
        display: none;
    }

    .d-block.d-md-none {
        display: block;
    }

    #orderTabMobile .nav-link {
        padding: 10px;
        font-size: 1.5rem;
        text-align: center;
        color: #333;
        white-space: nowrap;
    }

    #orderTabMobile .nav-link i {
        font-size: 1.5rem;
    }

    #orderTabMobile .nav-link.active {
        background-color: #007bff;
        color: white;
    }
}

.line {
    height: 2px;
    background-color: #dee2e6;
    margin: 5px 0 15px;
}

.order-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 20px;
    margin-bottom: 20px;
    transition: transform 0.2s ease;
    overflow: hidden;
}

.order-card:hover {
    transform: translateY(-5px);
}

.order-header {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    gap: 8px;
    font-size: 15px;
    font-weight: 500;
    color: #555;
    margin-bottom: 15px;
    flex-wrap: wrap;
}

.product-item {
    display: flex;
    align-items: center;
    border-top: 1px solid #eee;
    padding: 10px 0;
    flex-wrap: wrap;
}

.product-item:first-child {
    border-top: none;
}

.product-img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
    margin-right: 10px;
}

.product-info p {
    margin: 0;
    font-size: 0.9rem;
    line-height: 1.4;
    white-space: nowrap;
    /* Đảm bảo không bị bể nội dung */
}

.product-info .price {
    color: #e74c3c;
    font-weight: bold;
    font-size: 0.95rem;
}

.product-info .qty {
    color: #888;
    display: inline-block;
    margin-right: 10px;
}

@media (max-width: 768px) {
    .ctn-noti {
        margin: 0;
    }

    .order-header span {
        font-size: 0.9rem;
    }

    .product-img {
        width: 50px;
        height: 50px;
    }

    .product-info p {
        font-size: 0.85rem;
    }

    .order-card {
        padding: 15px;
    }

    .product-item {
        flex-direction: column;
        text-align: center;
    }

    .product-item .product-info {
        margin-top: 10px;
    }

    .product-item .product-img {
        margin-right: 0;
    }
}
</style>