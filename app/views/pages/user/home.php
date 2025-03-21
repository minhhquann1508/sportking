<?php
$carouselItems = [
    [
        'img' => './img/banner.jpg',
        'title' => 'Welcome to Our Store',
        'subtitle' => 'Find the best products here',
        'btn_url' => 'shop.php',
        'btn_text' => 'Shop Now'
    ],
    [
        'img' => './img/banner.jpg',
        'title' => 'Big Sale 50% Off',
        'subtitle' => 'Limited time offer, grab it now!',
        'btn_url' => 'sale.php',
        'btn_text' => 'Check Deals'
    ],
    [
        'img' => './img/banner.jpg',
        'title' => 'New Arrivals',
        'subtitle' => 'Explore our latest collections',
        'btn_url' => 'new.php',
        'btn_text' => 'Discover Now'
    ]
];

$categories = [
    "nam" => [
        ["title" => "Áo thun nam", "image" => "https://everon.com/upload/phu-kien/bo-chan-ga-2-600x0.png"],
        ["title" => "Áo khoác nam", "image" => "https://everon.com/upload/phu-kien/bo-chan-ga-2-600x0.png"],
        ["title" => "Quần thun nam", "image" => "https://everon.com/upload/phu-kien/bo-chan-ga-2-600x0.png"],
    ],
    "nu" => [
        ["title" => "Áo thun nữ", "image" => "https://everon.com/upload/phu-kien/bo-chan-ga-2-600x0.png"],
        ["title" => "Áo khoác nữ", "image" => "https://placehold.co/600x400"],
        ["title" => "Quần thun nữ", "image" => "https://placehold.co/600x400"],
    ]
];
?>

<style>
    @media (max-width: 1200px) {
        .hero-slider {
            height: 70vh;
        }

        .hero-slider .carousel-item {
            height: 70vh;
        }
    }
</style>

<!-- Hero Slider -->
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" style="height: 100vh; position: relative;">
    <div class="carousel-indicators">
        <?php foreach ($carouselItems as $index => $item): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <div class="carousel-inner">
        <?php foreach ($carouselItems as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>"
                style="height: 100vh; background-image: url('<?= $item['img'] ?>'); background-size: cover; background-position: center; position: relative; overflow: hidden;">

                <!-- Gradient Overlay -->
                <div style="content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background: linear-gradient(to bottom, #fff 10.87%, rgba(255, 255, 255, 0.91) 40.72%, rgba(255, 255, 255, 0.6) 67.14%, rgba(255, 255, 255, 0) 92.12%); pointer-events: none;">
                </div>

                <div class="d-flex align-items-center justify-content-center text-center"
                    style="position: relative; z-index: 200; height: 100%; color: #000;">
                    <div>
                        <h1><?= $item['title'] ?></h1>
                        <p><?= $item['subtitle'] ?></p>
                        <a href="<?= $item['btn_url'] ?>" class="btn btn-primary mt-3"><?= $item['btn_text'] ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

<!-- Category Section -->
<div class="container mt-5">
    <p style="font-size: 60px; font-weight: bold; width: 360px; line-height: 1.3; color: #292929;">Mọi nhu cầu cho giấc mơ của bạn</p>

    <ul class="nav nav-pills mb-5">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#nam"
                style="border-radius: 50px; padding: 10px 25px; font-weight: bold; transition: all 0.3s ease-in-out; color: black;">
                Nam
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#nu"
                style="border-radius: 50px; padding: 10px 25px; font-weight: bold; transition: all 0.3s ease-in-out; color: black;">
                Nữ
            </button>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="nam">
            <div class="row">
                <?php foreach ($categories["nam"] as $item): ?>
                    <div class="col-md-2">
                        <div style="position: relative; overflow: hidden; margin-bottom: 15px; transition: all 0.3s;">
                            <img src="<?= $item['image'] ?>" width="200px" height="auto"
                                style="width: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <p style="position: absolute; top: 10px; left: 10px; font-weight: bold; width: 100%; color: #fff; padding: 5px; margin: 0; font-size: 18px;">
                                <?= $item['title'] ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="tab-pane fade" id="nu">
            <div class="row">
                <?php foreach ($categories["nu"] as $item): ?>
                    <div class="col-md-2">
                        <div style="position: relative; overflow: hidden; margin-bottom: 15px; transition: all 0.3s;">
                            <img src="<?= $item['image'] ?>" width="200px" height="auto"
                                style="width: 100%; object-fit: cover; transition: transform 0.3s ease;"
                                onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                            <p style="position: absolute; top: 10px; left: 10px; font-weight: bold; width: 100%; color: #fff; padding: 5px; margin: 0; font-size: 18px;">
                                <?= $item['title'] ?>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>