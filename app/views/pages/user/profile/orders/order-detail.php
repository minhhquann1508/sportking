<div class="container py-5 mt-5">
    <a href="javascript:history.back()" class="btn btn-outline-secondary mb-4 rounded-0 print-hide">
        <i class="bi bi-arrow-left me-2"></i>Quay lại
    </a>
    <div class="invoice-container bg-white p-4">
        <div class="text-center mb-4">
            <h1 class="company-name fw-bold mb-1"><img src="../public/img/logo.png" alt=""> <br>
                <p class="fw-light">SPORTKING</p>
            </h1>
            <h2 class="invoice-title text-uppercase border-bottom border-dark pb-2 d-inline-block">HÓA ĐƠN</h2>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="mb-2">
                    <span class="fw-semibold">Mã đơn hàng:</span>
                    <span>#<?= $orderDetails['order_id'] ?></span>
                </div>
                <div class="mb-2">
                    <span class="fw-semibold">Ngày đặt:</span>
                    <span><?= $orderDetails['order_date'] ?></span>
                </div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="mb-2">
                    <span class="fw-semibold">Trạng thái:</span>
                    <span class="badge bg-dark rounded-0"><?= $orderDetails['status'] ?></span>
                </div>
            </div>
        </div>
        <div class="border-top border-bottom py-3 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-1"><strong>Khách hàng:</strong> <?= $orderDetails['customer_name'] ?></p>
                    <p class="mb-1"><strong>Điện thoại:</strong> <?= $orderDetails['customer_phone'] ?></p>
                </div>
                <div class="col-md-6">
                    <p class="mb-1"><strong>Địa chỉ:</strong> <?= $orderDetails['customer_address'] ?></p>
                </div>
            </div>
        </div>
        <table class="table table-bordered mb-4">
            <thead class="bg-light">
                <tr>
                    <th class="py-2">Sản phẩm</th>
                    <th class="py-2 text-center">Màu/Size</th>
                    <th class="py-2 text-center">Đơn giá</th>
                    <th class="py-2 text-center">Số lượng</th>
                    <th class="py-2 text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails['products'] as $product): ?>
                <tr>
                    <td class="py-2">
                        <a href="?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>&variant_id=<?= $product['variant_id'] ?>"
                            class="d-flex align-items-center">
                            <img src="<?= $product['thumbnail'] ?>" class="me-2"
                                style="width: 50px; height: 50px; object-fit: cover;">
                            <?= $product['product_name'] ?>
                        </a>
                    </td>
                    <td class="py-2 text-center"><?= $product['color'] ?>/<?= $product['size'] ?></td>
                    <td class="py-2 text-center"><?= number_format($product['price'], 0, ',', '.') ?>₫</td>
                    <td class="py-2 text-center"><?= $product['quantity'] ?></td>
                    <td class="py-2 text-end">
                        <?= number_format($product['price'] * $product['quantity'], 0, ',', '.') ?>₫</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-md-4">
                <div class="border-top pt-2">
                    <div class="d-flex justify-content-between">
                        <span class="fw-semibold">Tổng cộng:</span>
                        <span class="fw-bold">
                            <?= number_format(array_reduce($orderDetails['products'], function($total, $product) {
                                return $total + $product['price'] * $product['quantity'];
                            }, 0), 0, ',', '.') ?>₫
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.invoice-container {
    max-width: 1200px;
    margin: 0 auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.company-name {
    font-size: 2rem;
    letter-spacing: 1.5px;
}

.invoice-title {
    font-size: 1.5rem;
    letter-spacing: 2px;
}

.table th {
    background-color: #f8f9fa !important;
    font-weight: 600;
}

.signature-placeholder {
    height: 40px;
}

@media print {
    .print-hide {
        display: none !important;
    }

    .invoice-container {
        box-shadow: none;
        padding: 0 !important;
    }

    .signature-placeholder {
        border-color: #000 !important;
    }
}
</style>

<script>
const orderInfo = "Mã đơn hàng: <?= $orderDetails['order_id'] ?>\n" +
    "Tên khách: <?= $orderDetails['customer_name'] ?>\n" +
    "Tổng tiền: <?= number_format(array_reduce($orderDetails['products'], function($total, $product) {
        return $total + $product['price'] * $product['quantity'];
    }, 0), 0, ',', '.') ?>₫\n" +
    "Địa chỉ: <?= $orderDetails['customer_address'] ?>";

new QRCode(document.getElementById("qrcode"), {
    text: orderInfo,
    width: 150,
    height: 150,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H
});
</script>

<style>
.container {
    max-width: 1200px;
    margin: 0 auto;
}

.company-name img {
    max-width: 100%;
    height: auto;
    width: auto;
}

.card {
    border-radius: 15px;
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.order-header {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    position: relative;
}

.order-header h3 {
    font-size: 1.8rem;
    letter-spacing: -0.5px;
    color: #2d3436;
}

.order-header .badge {
    font-size: 1rem;
    padding: 0.6rem 1.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

#qrcode {
    background: white;
    padding: 10px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.customer-info h5 {
    color: #2d3436;
    border-left: 4px solid #007bff;
    padding-left: 1rem;
    margin: 1.5rem 0;
}

.customer-info .bi {
    font-size: 1.2rem;
    min-width: 30px;
    color: #007bff;
}

.product-item {
    transition: all 0.3s ease;
    border: 1px solid rgba(0, 0, 0, 0.05);
    background: white;
    border-radius: 12px;
    overflow: hidden;
}

.product-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
}

.product-item img {
    border-radius: 8px;
    border: 1px solid #eee;
}

.product-item h6 {
    color: #2d3436;
    font-weight: 600;
}

.total-price {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-radius: 12px;
    padding: 1.5rem;
}

.table {
    width: 100%;
    table-layout: fixed;
    word-wrap: break-word;
}

.table th,
.table td {
    padding: 10px;
    vertical-align: middle;
}

@media (max-width: 768px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .order-header h3 {
        font-size: 1.5rem;
    }

    #qrcode {
        order: 3;
        margin-top: 1rem;
    }

    .customer-info .row>div {
        width: 100%;
        margin-bottom: 1rem;
    }

    .product-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .product-item img {
        width: 100%;
        height: 200px;
        margin-bottom: 1rem;
    }

    .total-price .col-md-8 {
        text-align: left !important;
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 576px) {
    .btn-back {
        width: 100%;
        text-align: center;
    }

    .order-header .badge {
        font-size: 0.9rem;
    }

    .product-item img {
        height: 150px;
    }

    .total-price p {
        font-size: 1.5rem;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card {
    animation: fadeIn 0.6s ease-out;
}

.product-item {
    animation: fadeIn 0.4s ease-out forwards;
    animation-delay: 0.2s;
    opacity: 0;
}

.text-danger {
    color: #ff4757 !important;
}

.bg-success {
    background: #2ed573 !important;
}

.border-bottom {
    border-color: rgba(0, 0, 0, 0.08) !important;
}

.table {
    width: 100%;
    table-layout: fixed;
    word-wrap: break-word;
}

.table th,
.table td {
    padding: 10px;
    vertical-align: middle;
}

@media (max-width: 768px) {
    .table thead {
        display: none;
    }

    .table,
    .table tbody,
    .table tr,
    .table td {
        display: block;
        width: 100%;
    }

    .table tr {
        margin-bottom: 15px;
    }

    .table td {
        display: flex;
        justify-content: space-between;
        padding: 8px;
        border: 1px solid #dee2e6;
    }

    .table td::before {
        content: attr(data-label);
        font-weight: bold;
        width: 50%;
    }

    .table td img {
        max-width: 50px;
        height: 50px;
        object-fit: cover;
    }
}
</style>