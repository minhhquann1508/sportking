<?php 
if(isset($_POST['filter'])) {
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $price_range = $_POST['price_range'];
    $search = $_GET['search'] ?? '';

    $location = "?controller=home&action=search_product"
              . "&search=" . urlencode($search)
              . "&category_id=" . urlencode($category_id)
              . "&brand_id=" . urlencode($brand_id)
              . "&price_range=" . urlencode($price_range);

    header("Location: $location");
}
?>
<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<main style="padding-top: 76px;">
    <div class="container">
        <div class="row">
            <div class="col-3 mb-4">
                <form method="POST" action="" id="productForm" class="filter p-4 border rounded shadow-sm">
                    <h5 class="fw-bold mb-3"><i class="fas fa-arrow-down-wide-short me-2"></i>BỘ LỌC </h5>
                    <!-- Lọc theo danh mục -->
                    <div class="mb-4">
                        <label class="fw-bold">Danh mục</label>
                        <select name="category" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả danh mục</option>
                            <?php foreach ($categories as $category): ?>
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
                            <?php foreach ($brands as $brand): ?>
                            <option value="<?php echo $brand['brand_id']; ?>">
                                <?php echo $brand['brand_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Lọc theo giá -->
                    <div class="mb-4">
                        <label class="fw-bold">Giá</label>
                        <select name="price_range" class="form-select" onchange="submitForm()">
                            <option value="">Tất cả giá</option>
                            <option value="1">
                                Từ thấp đến cao</option>
                            <option value="2">
                                Từ cao đến thấp</option>
                            <option value="3">
                                Dưới 500.000</option>
                            <option value="4">
                                Từ 500.000 đến 1.000.000</option>
                        </select>
                    </div>
                    <!-- Nút reset bộ lọc -->
                    <div class="d-flex justify-content-center">
                        <button type="submit" name="filter" class="btn btn-outline-secondary w-100">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <?php
                    render_list_product($variants);
                ?>
            </div>
        </div>
    </div>
</main>