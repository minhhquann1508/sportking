<style>
.pagination .page-item .page-link {
    color: #333;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 5px;
    background-color: #f8f9fa;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.pagination .page-item.active .page-link {
    color: #fff;
    background-color: #007bff;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
}

.pagination .page-item .page-link:hover {
    color: #007bff;
    background-color: #e9ecef;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
}

.pagination .page-item.disabled .page-link {
    color: #888;
    background-color: #f0f0f0;
    pointer-events: none;
}

.card-img-top {
    object-fit: cover;
}

/* Bộ lọc đẹp hơn */
.filter {
    background-color: #fff;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 20px;
}

.filter h5 {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.filter select,
.filter button {
    border-radius: 8px;
    padding: 10px;
    font-size: 14px;
}

.filter button:hover {
    background-color: #007bff;
    color: #fff;
}

.filter .form-select {
    background-color: #f8f9fa;
    border: 1px solid #ddd;
}

.filter .form-select:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

.filter .mb-4 {
    margin-bottom: 1.5rem;
}

.filter .btn-outline-secondary {
    border: 1px solid #007bff;
    color: #007bff;
    transition: all 0.3s ease;
}

.filter .btn-outline-secondary:hover {
    background-color: #007bff;
    color: #fff;
}

/* Media query cho mobile */
@media (max-width: 768px) {
    .filter {
        padding: 15px;
    }

    .filter select,
    .filter button {
        width: 100%;
        margin-bottom: 10px;
    }

    .filter h5 {
        font-size: 1rem;
    }

    .filter .btn-outline-secondary {
        width: 100%;
    }

    .filter label {
        font-size: 0.9rem;
    }
}

@media (min-width: 768px) {

    .filter select,
    .filter button {
        width: 100%;
    }
}
</style>

<main>
    <div class="container-lg mt-5 py-5">
        <div class="row mb-3">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 mb-4">
                <form method="POST" action="" id="productForm" class="filter p-4 border rounded shadow-sm">
                    <h5 class="fw-bold mb-3"><i class="fas fa-arrow-down-wide-short me-2"></i>BỘ LỌC </h5>

                    <!-- Lọc theo danh mục -->
                    <div class="mb-4">
                        <label class="fw-bold">Danh mục</label>
                        <select name="category" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach ($categories['data'] as $category): ?>
                            <option value="<?php echo $category['category_id']; ?>">
                                <?php echo $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Lọc theo thương hiệu -->
                    <div class="mb-4">
                        <label class="fw-bold">Thương hiệu</label>
                        <select name="brand" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả thương hiệu</option>
                            <?php foreach ($brands['data'] as $brand): ?>
                            <option value="<?php echo $brand['brand_id']; ?>">
                                <?php echo $brand['brand_name']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>

                    <!-- Lọc theo giá -->
                    <div class="mb-4">
                        <label class="fw-bold">Giá</label>
                        <select name="price" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả giá</option>
                            <option value="1" <?= isset($_GET['price']) && $_GET['price'] == '1' ? 'selected' : '' ?>>
                                Dưới 1 triệu</option>
                            <option value="2" <?= isset($_GET['price']) && $_GET['price'] == '2' ? 'selected' : '' ?>>1
                                - 5 triệu</option>
                            <option value="3" <?= isset($_GET['price']) && $_GET['price'] == '3' ? 'selected' : '' ?>>5
                                - 10 triệu</option>
                            <option value="4" <?= isset($_GET['price']) && $_GET['price'] == '4' ? 'selected' : '' ?>>
                                Trên 10 triệu</option>
                        </select>
                    </div>

                    <!-- Lọc theo số lượng tồn -->
                    <div class="mb-4">
                        <label class="fw-bold">Khác</label>
                        <select name="orther" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả</option>
                            <option value="1">A-Z</option>
                            <option value="2">Z-A</option>
                            <option value="3">Tăng dan</option>
                            <option value="4">Giảm dan</option>
                            <option value="5">Mới nhất</option>
                            <option value="6">Xem nhiều nhất</option>
                            <option value="7">Bán chạy nhất</option>
                        </select>
                    </div>
                    <!-- Nút reset bộ lọc -->
                    <div class="d-flex justify-content-center">
                        <button type="reset" class="btn btn-outline-secondary w-100">Đặt lại bộ lọc</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9">
                <div class="row py-2">
                    <?php if (!empty($productList['data'])): ?>
                    <?php foreach ($productList['data'] as $product): ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <a href="?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>"
                            class="text-decoration-none text-dark">
                            <div class="card h-100 border-0 d-grid gap-2">
                                <img src="<?= $product['thumbnail'] ?>" class="card-img-top object-fit-cover"
                                    alt="<?= $product['product_name'] ?>" style="height: 350px;">
                                <div class="card-body p-2">
                                    <p class="card-title fs-6 mb-1"><?= $product['product_name'] ?></p>
                                    <p class="card-text fw-semibold">
                                        <!-- <?= number_format($product['price'], 0, ',', '.') ?> đ</p> -->
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-auto p-2">
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="background-color: #E6B31E; border-radius:50%; padding:8px;">
                                        <img src="./img/cart.svg" width="20">
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center"
                                        style="border-radius:50%; padding:8px;">
                                        <img src="./img/heart.svg" width="20">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                    <div class="row pagination pb-3">
                        <div class="col-md-12">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1"><i
                                            class="fa-solid fa-angle-left"></i></a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#"><i class="fa-solid fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="col-12">
                        <h3 class="text-center">Không tìm thấy sản phẩm</h3>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
function submitForm() {
    var form = document.getElementById('productForm');
    if (form) {
        form.submit();
    } else {
        console.error("Form not found");
    }
}
</script>