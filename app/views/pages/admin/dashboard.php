<?php
    // // Tổng số sản phẩm
    // print_r($total_products);
    // print_r($top_5_products);
?>
<style>
body {
    background-color: #f8f9fa;
}

.stats-box {
    background: white;
    border-radius: 20px;
    padding: 30px 20px;
    text-align: center;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease;
}

.stats-box:hover {
    transform: translateY(-5px);
}

.stats-icon {
    font-size: 40px;
    color: #0d6efd;
    margin-bottom: 10px;
}

.stats-number {
    font-size: 28px;
    font-weight: 600;
    color: #0d6efd;
}

.stats-label {
    font-size: 16px;
    color: #6c757d;
}
</style>
<div class="container py-2">
    <h2 class="text-center mb-5">Thống kê tổng quan</h2>
    <div class="row g-4 justify-content-center">

        <!-- Tổng sản phẩm -->
        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-icon"><i class="bi bi-box-seam"></i></div>
                <div class="stats-number"><?= $total_products ?></div>
                <div class="stats-label">Tổng sản phẩm</div>
            </div>
        </div>

        <!-- Tổng người dùng -->
        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-icon"><i class="bi bi-people-fill"></i></div>
                <div class="stats-number"><?= $total_users ?></div>
                <div class="stats-label">Người dùng</div>
            </div>
        </div>

        <!-- Doanh thu -->
        <div class="col-md-4">
            <div class="stats-box">
                <div class="stats-icon"><i class="bi bi-cash-stack"></i></div>
                <div class="stats-number"><?= number_format($total_amount, 0, ',', '.') ?>₫</div>
                <div class="stats-label">Tổng doanh thu</div>
            </div>
        </div>

    </div>
    <div class="row mt-5">
        <div class="col-7">
            <div class="chart-container">
                <h3 style="text-align: center;">Sản phẩm bán chạy</h3>
                <canvas id="productChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>


<script>
const ctx = document.getElementById('productChart').getContext('2d');

// Dữ liệu từ PHP
const productNames = <?= json_encode(array_column($top_5_products, 'product_name')) ?>;
const soldCounts = <?= json_encode(array_column($top_5_products, 'solds')) ?>;
const revenues = <?= json_encode(array_column($top_5_products, 'total_revenue')) ?>;

const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: productNames,
        datasets: [{
                label: 'Số lượng bán',
                data: soldCounts,
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Doanh thu (₫)',
                data: revenues,
                backgroundColor: 'rgba(255, 159, 64, 0.6)',
                borderColor: 'rgba(255, 159, 64, 1)',
                borderWidth: 1,
                yAxisID: 'y2'
            }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false,
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Số lượng'
                }
            },
            y2: {
                beginAtZero: true,
                position: 'right',
                title: {
                    display: true,
                    text: 'Doanh thu (VNĐ)'
                },
                grid: {
                    drawOnChartArea: false
                }
            }
        },
        plugins: {
            legend: {
                position: 'top'
            },
            title: {
                display: false
            }
        }
    }
});
</script>