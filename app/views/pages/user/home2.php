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

<section class="hero d-flex justify-content-center align-items-center" style="background-color: #f2f2f2;margin-top:76px;overflow:hidden">
    <div class="container row" style="height:calc(100vh - 76px)">
        <div class="col-6 d-flex flex-column justify-content-center">
            <div class="mb-3">
                <p style="font-size: 70px; font-weight:700">Áo cho nữ</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi eveniet quam laudantium asperiores dolorem,
                    odio dolores? Obcaecati molestias quis tenetur.</p>
            </div>
            <div class="row mb-5">
                <div class="col-4">
                    <p>Giá: </p>
                    <p>đ300.000</p>
                </div>
                <div class="col-4">
                    <p>Màu: </p>
                    <div class="d-flex gap-2 align-items-center">
                        <div style="border-radius:50%; background-color:white;width:20px;height:20px;"></div>
                        <div style="border-radius:50%; background-color:#cccccc;width:20px;height:20px;"></div>
                        <div style="border-radius:50%; background-color:#f0cce6;width:20px;height:20px;"></div>
                        <div style="border-radius:50%; background-color:#cdbfed;width:20px;height:20px;"></div>
                    </div>
                </div>
                <div class="col-4">
                    <p>Cỡ: </p>
                    <div class="d-flex gap-2" style="color: #888888;">
                        <div class="d-flex align-items-center justify-content-center" style="border-radius:3px; background-color:white;width:25px;height:25px;">
                            <span style="font-size:15px;font-weight:600">9</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="border-radius:3px; background-color:white;width:25px;height:25px;">
                            <span style="font-size:15px;font-weight:600">10</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="border-radius:3px; background-color:white;width:25px;height:25px;">
                            <span style="font-size:15px;font-weight:600">11</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-center" style="border-radius:3px; background-color:white;width:25px;height:25px;">
                            <span style="font-size:15px;font-weight:600">12</span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="d-flex gap-1">
                <button class="btn" style="border: 1px solid black;border-radius:8px;font-weight:700;padding:8px 15px">Giảm 40%</button>
                <button class="btn" style="background:#e5b220;color:white ;border-radius:8px;font-weight:700;padding:8px 15px">Mua Ngay</button>
            </div>
        </div>
        <div class="hero_img col-6 d-flex justify-content-center align-items-center position-relative">
            <div class="bg-shape" style="outline: 2px solid #e5b220;outline-offset: 20px;position: absolute;
            width: 500px;height: 500px;border-radius: 50%;background: #FFF9F9;z-index: 10;left:130px;"></div>
            <img src="./img/heroimg.png" style="transform:translate(-30px, -30px);z-index:11" alt="" width="120%" height="auto">
        </div>
    </div>
</section>


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