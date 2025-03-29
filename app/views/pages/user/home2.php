<?php include '../app/views/layouts/_list_product.php' ?>

<?php
$brands = [
    "https://media.loveitopcdn.com/3807/logo-coca-cola-vector-dongphucsongphu4.png",
    "https://upload.wikimedia.org/wikipedia/commons/2/24/Adidas_logo.png",
    "https://upload.wikimedia.org/wikipedia/commons/a/a6/Logo_NIKE.svg",
    "https://99designs-blog.imgix.net/blog/wp-content/uploads/2016/08/hbo.png?auto=format&q=60&fit=max&w=930",
    "https://techvietnam.com.vn/wp-content/uploads/2023/07/Apple-Logo.png",
    "https://i.pinimg.com/474x/d8/d3/4d/d8d34d5226cc7b34d452ae860aa20907.jpg"
];

$flashSale = [
    ["brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "https://www.sporter.vn/wp-content/uploads/2022/09/Tong-hop-ao-bong-da-doi-tuyen-quoc-gia-adidas-tai-tro-world-cup-2022-14.jpg"],
    ["brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://photo.znews.vn/w660/Uploaded/pnbcuhbatgunb/2022_11_25/Fhr0q3bX0AIZjXR.jpg"],
    ["brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://icdn.psgtalk.com/wp-content/uploads/2021/04/Kylian-Mbappe-warming-up-Strasbourg-vs-PSG-Ligue-1-2021.jpg"]
];

$products = [
    ["id" => 1, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "https://cdn.giaoducthoidai.vn/images/87a7b2442062a13f399c8570bdaf2565a8f969d40e98698a410f920061ed3556e3eda6ef7e4fd2b79a00356c76e89d88/051-1386.png"],
    ["id" => 2, "name" => "Dino Explorer Sweatshirt", "price" => 35, "image" => "https://photo.znews.vn/w660/Uploaded/pnbcuhbatgunb/2022_11_25/Fhr0q3bX0AIZjXR.jpg"],
    ["id" => 3, "name" => "Blue Ruffle Dress", "price" => 42, "image" => "https://www.sporter.vn/wp-content/uploads/2022/09/Tong-hop-ao-bong-da-doi-tuyen-quoc-gia-adidas-tai-tro-world-cup-2022-12.jpg"],
    ["id" => 4, "name" => "Classic Black Tee", "price" => 50, "image" => "https://cmu-cdn.vinfast.vn/2022/12/6ae187b4-doi-tuyen-nhat-ban.jpg"],
    ["id" => 5, "name" => "Classic Black Tee", "price" => 50, "image" => "https://i.guim.co.uk/img/media/5cb3a70c251f02a715fc299117472b7a7179e62a/60_184_1301_1587/master/1301.jpg?width=445&dpr=1&s=none&crop=none"],
    ["id" => 6, "name" => "Classic Black Tee", "price" => 50, "image" => "https://media-cdn-v2.laodong.vn/storage/newsportal/2024/7/4/1361447/Ronaldo-Tt2-01.jpeg"],
    ["id" => 7, "name" => "Classic Black Tee", "price" => 50, "image" => "https://pbs.twimg.com/media/EE7HIPPXoAEcpkt.jpg"],
    ["id" => 8, "name" => "Mint Green Floral Dress", "price" => 38, "image" => "https://kenh14cdn.com/2019/1/26/hi-1548504545798711409173.jpg"]
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

<?php include_once '_hero.php' ?>

<style>
    .zoom-img {
        transition: transform 0.5s ease;
        height: 600px;
        object-fit: cover;
        border-radius: 12px;
        width: 100%;
    }

    .zoom-img:hover {
        transform: scale(1.05);
    }
</style>

<section class="my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 border-end py-4">
                <img class="mb-3" src="//wpbingo-aktive.myshopify.com/cdn/shop/files/delivery.svg?v=1738722805">
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Giao hàng toàn quốc tới tận nhà với phí ship 0đ</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 border-end py-4">
                <img class="mb-3" src="//wpbingo-aktive.myshopify.com/cdn/shop/files/money.svg?v=1738723055">
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Chính sách bảo hành, đổi trả trong 30 ngày.</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 py-4">
                <img class="mb-3" src="//wpbingo-aktive.myshopify.com/cdn/shop/files/payment.svg?v=1738723102">
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Thanh toán đa phương tiện. Thẻ tín dụng dễ dàng</p>
                </div>
            </div>
        </div>
    </div>
</section>




<section class="my-5 py-5 border-bottom">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-5  mb-lg-0 d-flex flex-column justify-content-center">
                <p class="mb-4" style="font-size:20px; font-weight:600">Nâng cao gu thẩm mỹ</p>
                <p class="mb-4" style="font-size: 50px; font-weight:700;line-height:1.1">Trang phục bạn tìm kiếm</p>
                <button class="btn border rounded-pill" style="font-weight:600;width:130px;height:50px">Mua Ngay</button>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-5 mb-lg-0">
                <div class="bg-light rounded-3 overflow-hidden">
                    <img class="zoom-img img-fluid"
                        src="https://www.transparentpng.com/download/man/M8cqJS-handsome-man-png-transparent-handsome-man-png-images.png"
                        alt="Nam">
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <p class="m-0 fw-bold fs-5">Nam</p>
                    <button class="btn btn-outline-dark rounded-circle">→</button>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="bg-light rounded-3 overflow-hidden">
                    <img class="zoom-img img-fluid"
                        src="https://wpbingo-aktive.myshopify.com/cdn/shop/files/banner-5.jpg?v=1738723920%20470w"
                        alt="Nữ">
                </div>
                <div class="mt-3 d-flex justify-content-between align-items-center">
                    <p class="m-0 fw-bold fs-5">Nữ</p>
                    <button class="btn btn-outline-dark rounded-circle">→</button>
                </div>
            </div>
        </div>
    </div>
</section>



<div class="container my-5">
    <div class="d-flex gap-5 align-items-center">
        <p class="" style="font-size: 40px;font-weight:550">Được lựa chọn cho bạn</p>
        <p class="" style="font-weight:550; border-bottom:1px solid black">Xem thêm</p>
    </div>
    <div class="container" style="padding: 20px 0;">
        <div class="tf-grid-layout tf-col-2 lg-col-3 xl-col-4">
            <?php render_list_product($flashSale); ?>
        </div>
    </div>

    <p class="mt-4" style="font-size: 40px;font-weight:550">Hàng mới về</p>
    <div class="container" style="padding: 40px 0;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
            <?php foreach ($products as $product): ?>
                <a href="?controller=product&action=detail&id=<?= $product['id'] ?>" style="text-decoration: none; color: inherit;">
                    <div>
                        <img src="<?= $product['image'] ?>"
                            style="width: 100%; height: 400px; object-fit: cover;">
                        <div class="pt-2">
                            <p style="font-size: 16px"><?= $product['name'] ?></p>
                            <p style="font-size: 14px; font-weight: 600;">đ<?= $product['price'] ?></p>
                        </div>
                        <div class="d-flex gap-3">
                            <div class="d-flex justify-content-center align-items-center"
                                style="background-color: #E6B31E; border-radius: 50px; padding: 5px 7px;">
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