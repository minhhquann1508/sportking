<?php
    include_once '../app/models/Brand.php';
    include_once '../app/models/Blog.php';
    $brand = new Brand();
    $blog = new Blog();
    $brands = $brand->get_all_brands();
    $blogs = $blog->get_all_blogs();
?>

<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<?php include '../app/views/layouts/_home_btn.php' ?>
<?php include 'home.php' ?>

<?php

$category = [
    ["name" => "Jackets", "products" => 110, "image" => "https://placehold.co/200x200"],
    ["name" => "Skirts", "products" => 180, "image" => "https://placehold.co/200x200"],
    ["name" => "Dress", "products" => 250, "image" => "https://placehold.co/200x200"],
    ["name" => "Sweaters", "products" => 150, "image" => "https://placehold.co/200x200"],
    ["name" => "Hats", "products" => 120, "image" => "https://placehold.co/200x200"],
    ["name" => "Trousers", "products" => 210, "image" => "https://placehold.co/200x200"]
];


$blog = [
    [
        "title" => "Đệm bông ép Everon Lux - Diện mạo mới, giá không đổi",
        "description" => "Everon tự hào có các sản phẩm đệm bông ép đa dạng...",
        "image" => "https://placehold.co/600x400",
        "category" => "Sự kiện",
        "date" => "05/03/2025"
    ],
    [
        "title" => "Đẹp Deal Đúng - Mừng tháng 3 ngàn hoa",
        "description" => "Người đẹp ơi, chinh phục bí quyết đẹp dáng...",
        "image" => "https://placehold.co/600x400",
        "category" => "Sự kiện",
        "date" => "05/03/2025"
    ],
    [
        "title" => "Chất liệu chăn ga 'đáng đồng tiền' được Everon khuyên dùng",
        "description" => "Chăn ga gối - đồ dùng tiếp xúc trực tiếp với chúng ta...",
        "image" => "https://placehold.co/600x400",
        "category" => "Tin sản phẩm",
        "date" => "21/02/2025"
    ]
];
?>

<?php include_once '_hero.php' ?>


<div class="cursor-dot"></div>
<div class="cursor-ring"></div>
<section class="my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 border-end py-4">
                <a href="">
                    <img class="mylogo mb-3" src="./img/delivery.svg">
                </a>
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Giao hàng toàn quốc tới tận nhà
                        với phí ship 0đ</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 border-end py-4">
                <a href="">
                    <img class="mb-3" src="./img/money.svg">
                </a>
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Chính sách bảo hành, đổi trả
                        trong 30 ngày.</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 py-4">
                <a href="">
                    <img class="mb-3" src="./img/payment.svg">
                </a>
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Thanh toán đa phương tiện. Thẻ
                        tín dụng dễ dàng</p>
                </div>
            </div>
        </div>
    </div>
</section>



<section class="my-5 py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-5  mb-lg-0 d-flex flex-column justify-content-center">
                <p class="mb-4" style="font-size:18px; font-weight:550;color:#BD844C">Tìm kiếm gu trang phục</p>
                <p class="mb-4" style="font-size: 50px; font-weight:700;line-height:1.1">Thời trang cho mọi nhà</p>
                <button class="home_btn btn border d-flex justify-content-center gap-2"
                    style="font-weight:600;width:150px;height:40px;border-radius:0">Mua Ngay <span><i
                            class="fa-solid fa-arrow-right"></i></span></button>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-5 mb-lg-0">
                <div class="bg-light overflow-hidden">
                    <img class="zoom-img img-fluid" src="./img/male.png" alt="Nam">
                </div>
                <div class="mt-4 d-flex gap-5 align-items-center">
                    <p class="m-0 fw-bold fs-5">Nam</p>
                    <button class="btn btn-outline-dark rounded-circle"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="bg-light overflow-hidden">
                    <img class="zoom-img img-fluid" src="./img/female.png" alt="Nữ">
                </div>
                <div class="mt-4 d-flex gap-5 align-items-center">
                    <p class="m-0 fw-bold fs-5">Nữ</p>
                    <button class="btn btn-outline-dark rounded-circle"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </div>
</section>





<div class="container my-5">
    <p class="mb-1" style="font-size:18px; font-weight:550;color:#BD844C">Sản phẩm của chúng tôi</p>
    <div class="d-flex justify-content-between align-items-center">
        <p class="mr-5" style="font-size: 40px;font-weight:550">Được lựa chọn cho bạn</p>

        <!-- Tabs -->
        <ul class="nav custom-tabs" id="productTabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#flashSale">Flash Sale</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#newArrivals">Hàng Mới</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#bestSellers">Bán Chạy</a>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="flashSale">
            <div class="container" style="padding: 20px 0;">
                <?php render_list_product($productList); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="newArrivals">
            <div class="container" style="padding: 20px 0;">
                <?php render_list_product($productList); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="bestSellers">
            <div class="container" style="padding: 20px 0;">
                <?php render_list_product($productList); ?>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 text-center">
    <p>Tìm kiếm trang phục mơ ước cho bé yêu từ nhiều danh mục khác nhau</p>
    <p>
        Từ áo sơ mi, áo khoác, quần dài, váy, áo hoodie, giày dép và cả những phụ kiện dễ thương đi kèm.
    </p>

    <div class="row justify-content-center">
        <?php foreach ($category as $item): ?>
        <div class="col-md-4 col-lg-2 mb-3">
            <div class="card p-3 text-center">
                <img src="<?= $item['image'] ?>" class="img-fluid" alt="<?= $item['name'] ?>">
                <h5 class="mt-2"><?= $item['name'] ?></h5>
                <p><?= $item['products'] ?>+ Products</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <button class="btn btn-outline-primary mt-3">Xem thêm danh mục</button>
</div>

<div class="container py-5">
    <p class="text-center mb-4" style="font-size: 2rem; font-weight: bold;">Tin tức</p>

    <div class="row">
        <?php 
            foreach (array_slice($blogs['data'], 0,2) as $blog) {
                echo '
                    <div class="col-md-4">
                        <div class="card border-0" style="background: none;">
                            <img src="'.$blog['thumbnail'].'" class="card-img-top" alt="'.$blog['title'].'">
                            <div class="card-body">
                                <p class="text-muted" style="font-size: 0.9rem;">'.$blog['fullname'].'</p>
                                <h5 class="card-title">'.$blog['title'].'</h5>
                                <p class="card-text" style="color: #555;">'.$blog['content'].'</p>
                                <p class="text-muted" style="font-size: 0.9rem;">'.$blog['created_at'].'</p>
                            </div>
                        </div>
                    </div>
                ';
            }
        ?>
    </div>

    <div class="text-center mt-4">
        <a href="#" class="text-dark" style="text-decoration: none; font-size: 1rem;">Xem tất cả →</a>
    </div>
</div>

<!-- Brands -->
<div class="mt-5">
    <div class="container text-center my-4">
        <p>Chúng tôi hợp tác với hơn 50+ thương hiệu nổi tiếng</p>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php 
                foreach (array_slice($brands, 0, 5) as $brand) {
                echo '<div class="col-6 col-sm-4 col-md-2 text-center">
                        <img src="'.$brand['thumbnail'].'" alt="'.$brand['brand_name'].'" style="width: 100px; height: auto;">
                    </div>';
                }
            ?>
        </div>
    </div>
</div>

<script>
function myCursor() {
    const dot = document.querySelector('.cursor-dot');
    const ring = document.querySelector('.cursor-ring');

    let mouseX = 0,
        mouseY = 0;
    let ringX = 0,
        ringY = 0;

    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
        dot.style.left = `${mouseX}px`;
        dot.style.top = `${mouseY}px`;
    });

    function animate() {
        ringX += (mouseX - ringX) * 0.3;
        ringY += (mouseY - ringY) * 0.3;
        ring.style.left = `${ringX}px`;
        ring.style.top = `${ringY}px`;
        requestAnimationFrame(animate);
    }

    const hoverElements = document.querySelectorAll('a, button, img');
    hoverElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            document.body.classList.add('hovered');
        });
        el.addEventListener('mouseleave', () => {
            document.body.classList.remove('hovered');
        });
    });

    animate();
}

document.addEventListener('DOMContentLoaded', myCursor);
</script>