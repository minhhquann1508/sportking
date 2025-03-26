<?php
$carouselItems = [
    [
        'img' => './img/banner.jpg',
        'title' => 'Chào mừng đến với cửa hàng của chúng tôi',
        'subtitle' => 'Tìm kiếm những sản phẩm tốt nhất tại đây',
        'btn_url' => 'shop.php',
        'btn_text' => 'Mua ngay'
    ],
    [
        'img' => './img/banner2.jpg',
        'title' => 'Chào mừng đến với cửa hàng của chúng tôi',
        'subtitle' => 'Tìm kiếm những sản phẩm tốt nhất tại đây',
        'btn_url' => 'shop.php',
        'btn_text' => 'Mua ngay'
    ],
    [
        'img' => './img/banner3.jpg',
        'title' => 'Hàng mới về',
        'subtitle' => 'Khám phá bộ sưu tập mới nhất',
        'btn_url' => 'new.php',
        'btn_text' => 'Khám phá ngay'
    ]
];

$brands = [
    "https://media.loveitopcdn.com/3807/logo-coca-cola-vector-dongphucsongphu4.png",
    "https://upload.wikimedia.org/wikipedia/commons/2/24/Adidas_logo.png",
    "https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg",
    "https://99designs-blog.imgix.net/blog/wp-content/uploads/2016/08/hbo.png?auto=format&q=60&fit=max&w=930",
    "https://techvietnam.com.vn/wp-content/uploads/2023/07/Apple-Logo.png",
    "https://i.pinimg.com/474x/d8/d3/4d/d8d34d5226cc7b34d452ae860aa20907.jpg"
];

$flashSale = [
    ["brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "./img/product6.png"],
    ["brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "./img/product6.png"],
    ["brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "./img/product6.png"],
    ["brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "./img/product6.png"]
];

$products = [
    ["id" => 1, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "./img/product1.png"],
    ["id" => 2, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "./img/product2.png"],
    ["id" => 3, "name" => "Blue Ruffle Dress", "price" => 42, "image" => "./img/product3.png"],
    ["id" => 4, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product4.png"],
    ["id" => 5, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product5.png"],
    ["id" => 6, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product3.png"],
    ["id" => 7, "name" => "Classic Black Tee", "price" => 50, "image" => "./img/product3.png"],
    ["id" => 8, "name" => "Mint Green Floral Dress", "price" => 38, "image" => "./img/product3.png"]
];

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

<style>
    @media (max-width: 1200px) {
        #heroCarousel {
            height: 70vh;
        }

        #heroCarousel .carousel-item {
            height: 70vh;
        }
    }

    .hero-content {
        opacity: 0;
        transition: all 1s ease-in-out;
    }

    .hero-content:first-child {
        transform: translateY(30px);
    }

    .hero-content.show {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            document.querySelectorAll(".hero-content").forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add("show");
                }, index * 100);
            });
        }, 300);
    });
</script>

<!-- Hero -->
<div id="heroCarousel" class="hero-slider carousel slide" data-bs-ride="carousel" style="height: 100vh; position: relative;">
    <div class="carousel-indicators" style="z-index:200;">
        <?php foreach ($carouselItems as $index => $item): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($carouselItems as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>"
                style="height: 100vh; background-image: url('<?= $item['img'] ?>'); background-size: cover; background-position: center; position: relative; overflow: hidden;">

                <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background: linear-gradient(to bottom, #fff 5%, rgba(255, 255, 255, 0.91) 10.72%, rgba(255, 255, 255, 0.6) 20.14%, rgba(255, 255, 255, 0) 92.12%); pointer-events: none;">
                </div>

                <div class="d-flex align-items-center justify-content-center text-center"
                    style="position: relative; z-index: 200; height: 100%; color: #000;">
                    <div>
                        <p class="hero-content hidden" style="color: #05472a; font-size: 40px;"><?= $item['title'] ?></p>
                        <p class="hero-content "><?= $item['subtitle'] ?> </p>
                        <a href="<?= $item['btn_url'] ?>" class="btn border mt-3 hero-content "><?= $item['btn_text'] ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index:200;">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index:200;">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Brands -->
<div class="mt-5">
    <div class="container text-center my-4">
        <p>Chúng tôi hợp tác với hơn 50+ thương hiệu nổi tiếng</p>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <?php foreach ($brands as $brand): ?>
                <div class="col-6 col-sm-4 col-md-2 text-center">
                    <img src="<?= $brand ?>" alt="Brand Logo" style="width: 100px; height: auto;">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<div class="container my-4">
    <p>
        Nhanh tay mua sắm với ưu đãi chớp nhoáng
        <span class="badge bg-secondary">35h 56m 32s</span>
    </p>
    <div class="container" style="padding: 40px 0;">
        <div class="d-flex justify-content-between align-items-center">
            <?php foreach ($flashSale as $product): ?>
                <a href="">
                    <div>
                        <img src="<?= $product['image'] ?>"
                            style="width: 300px; height: 100%; object-fit: cover">
                        <div class="pt-2">
                            <p style="font-size: 16px"><?= $product['name'] ?></p>
                            <p style="font-size: 14px;font-weight:600">đ<?= $product['price'] ?></p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="d-flex justify-content-center align-items-center" style="background-color: #E6B31E; border-radius:50px;padding:5px 7px">
                                <img src="./img/cart.svg" width="20">
                            </div>
                            <img src="./img/heart.svg" width="20">
                        </div>

                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <p class="mt-4">Hàng mới về</p>
    <div class="container" style="padding: 40px 0;">
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 20px;">
            <?php foreach ($products as $product): ?>
                <a href="?controller=product&action=detail&id=<?= $product['id'] ?>">
                    <div>
                        <img src="<?= $product['image'] ?>"
                            style="width: auto; height: 100%; object-fit: cover">
                        <div class="pt-2">
                            <p style="font-size: 16px"><?= $product['name'] ?></p>
                            <p style="font-size: 14px;font-weight:600">đ<?= $product['price'] ?></p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="d-flex justify-content-center align-items-center" style="background-color: #E6B31E; border-radius:50px;padding:5px 7px">
                                <img src="./img/cart.svg" width="20">
                            </div>
                            <img src="./img/heart.svg" width="20">
                        </div>

                    </div>
                </a>
            <?php endforeach; ?>
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
        <?php foreach ($blog as $post): ?>
            <div class="col-md-4">
                <div class="card border-0" style="background: none;">
                    <img src="<?= $post['image'] ?>" class="card-img-top" alt="<?= $post['title'] ?>">
                    <div class="card-body">
                        <p class="text-muted" style="font-size: 0.9rem;"><?= $post['category'] ?></p>
                        <h5 class="card-title"><?= $post['title'] ?></h5>
                        <p class="card-text" style="color: #555;"><?= $post['description'] ?></p>
                        <p class="text-muted" style="font-size: 0.9rem;"><?= $post['date'] ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="text-center mt-4">
        <a href="#" class="text-dark" style="text-decoration: none; font-size: 1rem;">Xem tất cả →</a>
    </div>
</div>