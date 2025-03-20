<?php
$carouselItems = [
    [
        'img' => 'https://placehold.co/600x400',
        'title' => 'Welcome to Our Store',
        'subtitle' => 'Find the best products here',
        'btn_url' => 'shop.php',
        'btn_text' => 'Shop Now'
    ],
    [
        'img' => 'https://placehold.co/600x400',
        'title' => 'Big Sale 50% Off',
        'subtitle' => 'Limited time offer, grab it now!',
        'btn_url' => 'sale.php',
        'btn_text' => 'Check Deals'
    ],
    [
        'img' => 'https://placehold.co/600x400',
        'title' => 'New Arrivals',
        'subtitle' => 'Explore our latest collections',
        'btn_url' => 'new.php',
        'btn_text' => 'Discover Now'
    ]
];
?>

<style>
    .hero-slider {
        height: 100vh;
    }

    .hero-slider .carousel-item {
        height: 100vh;
        background-size: cover;
        background-position: center;
    }

    .carousel-indicators {
        bottom: 10px;
    }

    @media (max-width: 1200px) {
        .hero-slider {
            height: 70vh;
        }

        .hero-slider .carousel-item {
            height: 70vh;
        }
    }
</style>

<div id="heroCarousel" class="carousel slide hero-slider" data-bs-ride="carousel">
    <!-- Indicators -->
    <div class="carousel-indicators">
        <?php foreach ($carouselItems as $index => $item): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
    </div>

    <!-- Carousel Items -->
    <div class="carousel-inner">
        <?php foreach ($carouselItems as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>" style="background-image: url('<?= $item['img'] ?>'); background-size: cover; background-position: center;">
                <div class="d-flex align-items-center justify-content-center h-100 text-white text-center">
                    <div>
                        <h1><?= $item['title'] ?></h1>
                        <p><?= $item['subtitle'] ?></p>
                        <a href="<?= $item['btn_url'] ?>" class="btn btn-primary mt-3"><?= $item['btn_text'] ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Điều hướng -->
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>