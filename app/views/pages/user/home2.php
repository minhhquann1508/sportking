<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<?php include '../app/views/layouts/_home_btn.php' ?>
<?php include 'home.php' ?>


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
    ["id" => 1, "brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "https://www.sporter.vn/wp-content/uploads/2022/09/Tong-hop-ao-bong-da-doi-tuyen-quoc-gia-adidas-tai-tro-world-cup-2022-14.jpg"],
    ["id" => 2, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://photo.znews.vn/w660/Uploaded/pnbcuhbatgunb/2022_11_25/Fhr0q3bX0AIZjXR.jpg"],
    ["id" => 3, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 4, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://icdn.psgtalk.com/wp-content/uploads/2021/04/Kylian-Mbappe-warming-up-Strasbourg-vs-PSG-Ligue-1-2021.jpg"]
];
$newArrivals = [
    ["id" => 5, "brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "https://cdn.giaoducthoidai.vn/images/87a7b2442062a13f399c8570bdaf2565a8f969d40e98698a410f920061ed3556e3eda6ef7e4fd2b79a00356c76e89d88/051-1386.png"],
    ["id" => 6, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 7, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://kenh14cdn.com/2019/1/26/hi-1548504545798711409173.jpg"],
    ["id" => 8, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 9, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://media-cdn-v2.laodong.vn/storage/newsportal/2024/7/4/1361447/Ronaldo-Tt2-01.jpeg"],
    ["id" => 10, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 11, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://cmu-cdn.vinfast.vn/2022/12/6ae187b4-doi-tuyen-nhat-ban.jpg"],
    ["id" => 12, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://icdn.psgtalk.com/wp-content/uploads/2021/04/Kylian-Mbappe-warming-up-Strasbourg-vs-PSG-Ligue-1-2021.jpg"]
];

$bestSellers = [
    ["id" => 13, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://icdn.psgtalk.com/wp-content/uploads/2021/04/Kylian-Mbappe-warming-up-Strasbourg-vs-PSG-Ligue-1-2021.jpg"],
    ["id" => 14, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://photo.znews.vn/w660/Uploaded/pnbcuhbatgunb/2022_11_25/Fhr0q3bX0AIZjXR.jpg"],
    ["id" => 15, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 16, "brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "https://www.sporter.vn/wp-content/uploads/2022/09/Tong-hop-ao-bong-da-doi-tuyen-quoc-gia-adidas-tai-tro-world-cup-2022-14.jpg"]
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
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Giao hàng toàn quốc tới tận nhà với phí ship 0đ</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 border-end py-4">
                <a href="">
                    <img class="mb-3" src="./img/money.svg">
                </a>
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Chính sách bảo hành, đổi trả trong 30 ngày.</p>
                </div>
            </div>
            <div class="col-md-4 col-12 d-flex flex-column align-items-center px-5 py-4">
                <a href="">
                    <img class="mb-3" src="./img/payment.svg">
                </a>
                <div>
                    <p class="text-center px-4" style="font-size: 15px; font-weight:600">Thanh toán đa phương tiện. Thẻ tín dụng dễ dàng</p>
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
                <button class="home_btn btn border d-flex justify-content-center gap-2" style="font-weight:600;width:150px;height:40px;border-radius:0">Mua Ngay <span><i class="fa-solid fa-arrow-right"></i></span></button>
            </div>

            <div class="col-lg-4 col-md-6 col-12 mb-5 mb-lg-0">
                <div class="bg-light overflow-hidden">
                    <img class="zoom-img img-fluid"
                        src="./img/male.png"
                        alt="Nam">
                </div>
                <div class="mt-4 d-flex gap-5 align-items-center">
                    <p class="m-0 fw-bold fs-5">Nam</p>
                    <button class="btn btn-outline-dark rounded-circle"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 col-12">
                <div class="bg-light overflow-hidden">
                    <img class="zoom-img img-fluid"
                        src="./img/female.png"
                        alt="Nữ">
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
                <?php render_list_product($flashSale); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="newArrivals">
            <div class="container" style="padding: 20px 0;">
                <?php render_list_product($newArrivals); ?>
            </div>
        </div>

        <div class="tab-pane fade" id="bestSellers">
            <div class="container" style="padding: 20px 0;">
                <?php render_list_product($bestSellers); ?>
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