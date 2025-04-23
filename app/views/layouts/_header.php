<?php
    include_once '../app/models/Category.php';
    include_once '../app/models/Brand.php';
    $category = new Category();
    $brand = new Brand();
    $categories = $category->get_all_category();
    $brands = $brand->get_all_brands();
    if(isset($_POST['search'])) {
        header('Location: ?controller=home&action=search_product&search='.$_POST['search'].'');
    }
?>

<style>
header {
    position: fixed;
    top: 0;
    left: 0;
    height: 76px;
    width: 100%;
    background: white;
    transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
    z-index: 1000;
}

.header-scroll {
    background: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.header-hidden {
    transform: translateY(-100%);
}
</style>

<header class="d-flex align-items-center">
    <nav class="container d-flex justify-content-between align-items-center py-2">
        <a href="?controller=home">
            <img src="./img/logo.png" alt="Logo" width="120px">
        </a>

        <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="d-none d-lg-flex align-items-center gap-3 mb-0">
            <li class="nav-item dropdown">
                <a class="  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Danh mục
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($categories as $category) {
                        echo '<li><a class="dropdown-item" href="?action=product&category_id=' . $category['category_id'] . '">' . $category['category_name'] . '</a></li>';
                    }
                    ?>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Thương hiệu
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($brands as $brand) {
                        echo '<li><a class="dropdown-item" href="?action=product&brand_id=' . $brand['brand_id'] . '">' . $brand['brand_name'] . '</a></li>';
                    }
                    ?>
                </ul>
            </li>

            <li class="nav-item"><a class=" " href="#">Giới thiệu</a></li>
            <li class="nav-item"><a class=" " href="#">Liên hệ</a></li>
        </ul>

        <div class="collapse navbar-collapse d-lg-none" id="navbarNav">
            <ul class="navbar-nav bg-white shadow rounded p-3">
                <li class="nav-item"><a class=" " href="#">Danh mục</a></li>
                <li class="nav-item"><a class=" " href="#">Thương hiệu</a></li>
                <li class="nav-item"><a class=" " href="#">Giới thiệu</a></li>
                <li class="nav-item"><a class=" " href="#">Liên hệ</a></li>
            </ul>
        </div>

        <div class="d-flex gap-3">
            <div data-bs-toggle="modal" data-bs-target="#searchModal">
                <a href="#"><img src="./img/search.svg" width="20"></a>
            </div>
            <div class="">
                <a href="#"><img src="./img/heart.svg" width="20"></a>
            </div>

            <div class="dropdown">
                <a href="#" data-bs-toggle="dropdown"><img src="./img/user.svg" width="20"></a>
                <ul class="dropdown-menu text-center"
                    style="left: 50%; transform: translateX(-50%); width: max-content;">
                    <?php
                    if (isset($_SESSION['user'])) {
                    ?>
                    <li><a class="dropdown-item" href="?controller=home&action=profile">Thông tin tài khoản</a></li>
                    <li><a class="dropdown-item" href="#">Quản lý đơn hàng</a></li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                    <?php
                    } else {
                    ?>
                    <li><a class="dropdown-item" href="?controller=auth">Đăng nhập</a></li>
                    <li><a class="dropdown-item" href="?controller=auth&action=register">Đăng kí</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>


            <div class=" position-relative">
                <a href="?controller=cart">
                    <img src="./img/cart.svg" width="20">
                    <span id="cart-quantity"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill"
                        style="background: #bd844c;">3</span>
                </a>
            </div>
        </div>
    </nav>
</header>
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Tìm kiếm sản phẩm theo tên</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="d-flex justify-content-center">
                    <div class="input-group mb-3" style="width: 100%;">
                        <input type="text" name="search" class="form-control" placeholder="Tìm kiếm..."
                            aria-label="Tìm kiếm">
                        <button type="submit" class="input-group-text bg-white border-0">
                            <img src="./img/search.svg" width="20">
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>