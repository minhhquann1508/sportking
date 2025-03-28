<?php
$hero = [
    [
        "title" => "Áo thể thao nam",
        "description" => "Thời trang nữ cao cấp, thiết kế trẻ trung.",
        "price" => "300.000",
        "colors" => ["white", "#cccccc", "#f0cce6"],
        "sizes" => ["S", "M"],
        "discount" => "Giảm 40%",
        "image" => "./img/neymar.png"
    ],
    [
        "title" => "Áo thể thao nữ",
        "description" => "BST mới nhất 2025.",
        "price" => "350.000",
        "colors" => ["white", "#cccccc"],
        "sizes" => ["S", "L"],
        "discount" => "Sale 30%",
        "image" => "https://www.freeiconspng.com/uploads/zlatan-ibrahimovic-png-12.png"
    ]
];
?>

<style>
    .hero-content-wrapper {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s ease;
    }

    .hero-content-wrapper.active {
        opacity: 1;
        transform: translateY(0);
    }

    .hero-section {
        background-color: #f2f2f2;
        padding-top: 76px;
        overflow: hidden;
    }

    .hero-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: calc(100vh - 76px);
    }

    .hero-info {
        width: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-img {
        width: 45%;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
    }
</style>

<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <?php foreach ($hero as $index => $item): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                class="<?= $index === 0 ? 'active' : '' ?>" aria-current="<?= $index === 0 ? 'true' : 'false' ?>"
                aria-label="Slide <?= $index + 1 ?>"></button>
        <?php endforeach; ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= count($hero) ?>"
            aria-label="Slide <?= count($hero) + 1 ?>"></button>
    </div>

    <div class="carousel-inner">
        <?php foreach ($hero as $index => $item): ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                <section class="hero-section d-flex justify-content-center align-items-center">
                    <div class="container hero-container">
                        <div class="hero-info">
                            <div class="hero-content-wrapper">
                                <div class="mb-3">
                                    <p style="font-size: 70px; font-weight:700"><?= $item['title'] ?></p>
                                    <p><?= $item['description'] ?></p>
                                </div>
                                <div class="d-flex mb-5">
                                    <div style="width: 33%;">
                                        <p>Giá:</p>
                                        <p>đ<?= $item['price'] ?></p>
                                    </div>
                                    <div style="width: 33%;">
                                        <p>Màu:</p>
                                        <div class="d-flex gap-2 align-items-center">
                                            <?php foreach ($item['colors'] as $color): ?>
                                                <div style="border-radius:50%; background-color:<?= $color ?>;width:20px;height:20px;"></div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div style="width: 33%;">
                                        <p>Cỡ:</p>
                                        <div class="d-flex gap-2" style="color: #888888;">
                                            <?php foreach ($item['sizes'] as $size): ?>
                                                <div class="d-flex align-items-center justify-content-center"
                                                    style="border-radius:3px; background-color:white;width:25px;height:25px;">
                                                    <span style="font-size:15px;font-weight:600"><?= $size ?></span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex gap-1">
                                    <button class="btn" style="border: 1px solid black;border-radius:8px;font-weight:700;padding:8px 15px"><?= $item['discount'] ?></button>
                                    <button class="btn" style="background:#e5b220;color:white ;border-radius:8px;font-weight:700;padding:8px 15px">Mua Ngay</button>
                                </div>
                            </div>
                        </div>
                        <div class="hero-img">
                            <div class="shape-wrapper position-relative" style="width: 100%; max-width: 700px;">
                                <div class="bg-shape position-absolute" style="
                                    outline: 2px solid #e5b220;
                                    outline-offset: 10px;
                                    width: 80%;
                                    aspect-ratio: 1/1;
                                    border-radius: 50%;
                                    background: #FFF9F9;
                                    z-index: 10;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                  "></div>
                                <img class="dodgeImage" src="<?= $item['image'] ?>" alt="" style="
                                    width: 100%;
                                    height: auto;
                                    position: relative;
                                    z-index: 11;
                                    transition: transform 0.3s ease;    
                                  ">
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        <?php endforeach; ?>

        <!-- Static Slide -->
        <div class="carousel-item"
            style="height: 100vh; background-image: url('./img/banner.jpg'); background-size: cover; background-position: center; position: relative;">
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
                    background: linear-gradient(to bottom, #fff 5%, rgba(255, 255, 255, 0.91) 10.72%, rgba(255, 255, 255, 0.6) 20.14%, rgba(255, 255, 255, 0) 92.12%); pointer-events: none;">
            </div>
            <div class="d-flex align-items-center justify-content-center text-center"
                style="position: relative; z-index: 200; height: 100%; color: #000;">
                <div class="hero-content-wrapper">
                    <p style="color: #05472a; font-size: 40px;">hello</p>
                    <p>sdfcjksdljakj</p>
                    <a href="#" class="btn border mt-3">Shop now</a>
                </div>
            </div>
        </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index: 999;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index: 999;">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.getElementById('heroCarousel');

        function fadeIn() {
            const items = carousel.querySelectorAll('.carousel-item');
            items.forEach(item => {
                const content = item.querySelector('.hero-content-wrapper');
                if (content) {
                    content.classList.remove('active');
                }
            });

            const activeItem = carousel.querySelector('.carousel-item.active');
            const content = activeItem.querySelector('.hero-content-wrapper');
            if (content) {
                setTimeout(() => {
                    content.classList.add('active');
                }, 100);
            }
        }

        fadeIn();
        carousel.addEventListener('slid.bs.carousel', function() {
            fadeIn();
        });
    });

    const carouselItems = document.querySelectorAll('.carousel-item');

    carouselItems.forEach((item) => {
        const dodgeImage = item.querySelector('.dodgeImage');

        item.addEventListener('mousemove', (e) => {
            const rect = item.getBoundingClientRect();
            const mouseX = e.clientX - rect.left;
            const mouseY = e.clientY - rect.top;

            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const offsetX = (centerX - mouseX) / 15;
            const offsetY = (centerY - mouseY) / 15;

            dodgeImage.style.transform = `translate(${offsetX}px, ${offsetY}px)`;
        });

        item.addEventListener('mouseleave', () => {
            dodgeImage.style.transform = `translate(0, 0)`;
        });
    });
</script>