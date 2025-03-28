<?php
$products = [
    ["id" => 1, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "./img/product1.png"],
    ["id" => 2, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "./img/product2.png"],
    ["id" => 3, "name" => "Blue Ruffle Dress", "price" => 42, "image" => "./img/product3.png"],
    ["id" => 4, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product4.png"],
    ["id" => 5, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product5.png"],
    ["id" => 6, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product3.png"],
    ["id" => 7, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product3.png"],
    ["id" => 8, "name" => "Mint Green Floral Dress", "price" => 38, "image" => "./img/product3.png"],
    ["id" => 9, "name" => "Mint Green Floral Dress", "price" => 38, "image" => "./img/product3.png"],
    ["id" => 10, "name" => "Mint Green Floral Dress", "price" => 38, "image" => "./img/product3.png"],
    ["id" => 11, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 12, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 13, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 14, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 15, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 16, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 17, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 18, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 19, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"],
    ["id" => 20, "name" => "Black & White Printed Shirt", "price" => 45, "image" => "./img/product6.png"]
];
?>
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
</style>
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

    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <div class="d-flex align-items-center filter">
                <div class="d-flex align-items-center action-filter me-3">
                    <i class="fas fa-arrow-down-wide-short me-2"></i>
                    <span class="fw-bold me-2">BỘ LỌC</span>
                    <span class="text-muted">| 130 sản phẩm</span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="d-flex align-items-center justify-content-md-end sort">
                <span class="me-2 text-secondary fw-semibold">Sắp xếp theo:</span>
                <div class="dropdown">
                    <button class="btn btn-outline-primary dropdown-toggle rounded-pill px-3" type="button"
                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Phổ biến
                    </button>
                    <ul class="dropdown-menu shadow" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Tên A-Z</a></li>
                        <li><a class="dropdown-item" href="#">Tên Z-A</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Giá thấp đến cao</a></li>
                        <li><a class="dropdown-item" href="#">Giá cao đến thấp</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Mới nhất</a></li>
                        <li><a class="dropdown-item" href="#">Bán chạy nhất</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-2">
        <?php foreach ($products as $product): ?>
        <div class="col-6 col-md-4 col-lg-3 mb-4">
            <a href="?controller=product&action=detail&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                <div class="card h-100 border-0 d-grid gap-2">
                    <img src="<?= $product['image'] ?>" class="card-img-top object-fit-cover"
                        alt="<?= $product['name'] ?>" style="height: 350px;">
                    <div class="card-body p-2">
                        <p class="card-title fs-6 mb-1"><?= $product['name'] ?></p>
                        <p class="card-text fw-semibold">đ<?= $product['price'] ?></p>
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
    </div>

    <div class="row pagination pb-3">
        <div class="col-md-12">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1"><i class="fa-solid fa-angle-left"></i></a>
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
</div>