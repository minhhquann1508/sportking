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
                        <select name="category" id="category" class="form-select"">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach ($categories as $category): ?>
                            <option value=" <?php echo $category['category_id']; ?>">
                            <?php echo $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="fw-bold">Thương hiệu</label>
                        <select name="brand" id="brand" class="form-select"">
                            <option value="">Tất cả thương hiệu</option>
                            <?php foreach ($brands as $brand): ?>
                            <option value=" <?php echo $brand['brand_id']; ?>">
                            <?php echo $brand['brand_name']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button onclick="submitForm()" type="reset" class="btn btn-outline-secondary w-100">Đặt lại bộ
                            lọc</button>
                    </div>
                </form>
            </div>

            <div class="col-md-9">
                <div class="row py-2">
                    <?php if (!empty($productList['data'])): ?>
                    <?php foreach ($productList['data'] as $product): ?>
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <a href="?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>&variant_id=<?= $product['variant_id'] ?>"
                            class="text-decoration-none text-dark">
                            <div class="card d-flex justify-content-center border-0 d-grid gap-2"
                                style="height: auto;width:200px">
                                <img src="<?= $product['image_url'] ?>" class="card-img-top"
                                    alt="<?= $product['product_name'] ?>" style="height: 200px;width:200px;">
                                <div class="card-body" style="width:100%;height:100px">
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
    const category_id = $('#category').val().trim(); // Loại bỏ khoảng trắng
    const brand_id = $('#brand').val().trim(); // Loại bỏ khoảng trắng
    window.location.href = `?controller=home&action=product&category=${category_id}&brand_id=${brand_id}`;
}
</script>