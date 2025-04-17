<?php
function renderOrderDetail($order) {
    echo "<div class='order-card mb-4'>";
    
    // Header thông tin chung
    echo "<div class='order-header mb-3'>
            <div class='d-flex justify-content-between align-items-center'>
                <h4 class='mb-0'>Đơn hàng #{$order['order_id']}</h4>
                <span class='badge bg-".getStatusColor($order['status'])."'>".$order['status']."</span>
            </div>
            <div class='text-muted mt-2'>Ngày đặt: ".$order['order_date']."</div>
          </div>";

    // Thông tin khách hàng
    echo "<div class='customer-info mb-4'>
            <h5 class='fw-bold mb-3'><i class='fas fa-user me-2'></i>Thông tin khách hàng</h5>
            <div class='row'>
                <div class='col-md-6'>
                    <p><strong>Họ tên:</strong> ".$order['fullname']."</p>
                    <p><strong>Email:</strong> ".$order['email']."</p>
                </div>
                <div class='col-md-6'>
                    <p><strong>SĐT:</strong> ".$order['phone']."</p>
                    <p><strong>Địa chỉ:</strong> ".$order['address']."</p>
                </div>
            </div>
          </div>";

    // Danh sách sản phẩm
    echo "<h5 class='fw-bold mb-3'><i class='fas fa-boxes me-2'></i>Sản phẩm</h5>";
    foreach ($order['products'] as $product) {
        echo "<div class='product-item mb-3'>
                <div class='row align-items-center'>
                    <div class='col-2'>
                        <img src='{$product['thumbnail']}' class='product-img img-thumbnail'>
                    </div>
                    <div class='col-5'>
                        <p class='mb-1 fw-bold'>".$product['product_name']."</p>
                        <p class='mb-1 text-muted'>Màu: ".$product['color']."</p>
                        <p class='mb-1 text-muted'>Size: ".$product['size']."</p>
                    </div>
                    <div class='col-2 text-end'>
                        <p class='price'>".number_format($product['price'], 0, ',', '.')."₫</p>
                    </div>
                    <div class='col-1 text-center'>
                        <p class='qty'>x".$product['quantity']."</p>
                    </div>
                    <div class='col-2 text-end'>
                        <p class='fw-bold'>".number_format($product['price'] * $product['quantity'], 0, ',', '.')."₫</p>
                    </div>
                </div>
              </div>";
    }

    // Tổng thanh toán
    echo "<div class='total-section border-top pt-3'>
            <div class='row justify-content-end'>
                <div class='col-4'>
                    <table class='table table-borderless'>
                        <tr class='fw-bold'>
                            <td>Tổng cộng:</td>
                            <td class='text-end text-danger h5'>".number_format($order['total'], 0, ',', '.')."₫</td>
                        </tr>
                    </table>
                </div>
            </div>
          </div>";

    echo "<div class='mt-4 d-flex justify-content-between'>
            <a href='?controller=home&action=profile' class='btn btn-outline-secondary'>
                <i class='fas fa-arrow-left me-2'></i>Quay lại
            </a>
            <div class='action-buttons'>
                <button class='btn btn-danger' onclick='cancelOrder({$order['order_id']})'>
                    <i class='fas fa-times me-2'></i>Hủy đơn
                </button>
                <button class='btn btn-primary'>
                    <i class='fas fa-print me-2'></i>Xác nhận đơn
                </button>
            </div>
          </div>";

    echo "</div>"; // Đóng order-card
}

// Hàm hỗ trợ hiển thị màu trạng thái
function getStatusColor($status) {
    $colors = [
        'Chưa xác nhận' => 'warning',
        'Đã xác nhận' => 'primary',
        'Đang giao' => 'info',
        'Đã giao' => 'success',
        'Đã hủy' => 'danger'
    ];
    return $colors[$status] ?? 'secondary';
}
?>

<div class="container py-5 mt-4">
    <?php if (!empty($order)): ?>
    <?php renderOrderDetail($order) ?>
    <?php else: ?>
    <div class="alert alert-danger">
        <i class="fas fa-exclamation-triangle me-2"></i>
        Không tìm thấy đơn hàng
    </div>
    <?php endif; ?>
</div>
<script>
function cancelOrder(orderId) {
    if (confirm('Bạn chắc chắn muốn hủy đơn hàng này?')) {
        // Xử lý hủy đơn hàng bằng AJAX
        $.post('cancel_order.php', {
                order_id: orderId
            })
            .done(function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert('Hủy đơn thất bại: ' + response.message);
                }
            });
    }
}
</script>

<style>
.order-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 25px;
}

.product-img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.price {
    color: #e74c3c;
    font-weight: bold;
    font-size: 16px;
}

.qty {
    color: #888;
    font-size: 14px;
}

.total-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
}

.action-buttons .btn {
    margin-left: 10px;
    min-width: 150px;
}
</style>