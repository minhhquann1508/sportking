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

    .dodgeImage:hover {
        transform: scale(1.5);
    }

    .cursor-dot {
        position: fixed;
        width: 5px;
        height: 5px;
        background: #b57a43;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9999;
        transform: translate(-50%, -50%) scale(1);
        transition: transform 0.4s ease, background 0.4s ease;
    }

    .cursor-ring {
        position: fixed;
        width: 30px;
        height: 30px;
        border: 1px solid #b57a43;
        border-radius: 50%;
        pointer-events: none;
        z-index: 9998;
        transform: translate(-50%, -50%);
    }

    body.hovered .cursor-dot {
        transform: translate(-50%, -50%) scale(13);
        background: rgba(185, 123, 66, 0.2);
    }

    body.hovered .cursor-ring {
        opacity: 0;
    }
</style>
<div class="cursor-dot"></div>
<div class="cursor-ring"></div>
<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="container hero-container">
                    <div class="hero-info">
                        <div class="hero-content-wrapper">
                            <div class="mb-3">
                                <p style="font-size: 70px; font-weight:700">Áo thể thao nam</p>
                                <p>Thời trang nữ cao cấp, thiết kế trẻ trung.</p>
                            </div>
                            <div class="d-flex mb-5">
                                <div style="width: 33%;">
                                    <p>Giá:</p>
                                    <p>đ300.000</p>
                                </div>
                                <div style="width: 33%;">
                                    <p>Màu:</p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div style="border-radius:50%; background-color:white;width:20px;height:20px;"></div>
                                        <div style="border-radius:50%; background-color:#cccccc;width:20px;height:20px;"></div>
                                        <div style="border-radius:50%; background-color:#f0cce6;width:20px;height:20px;"></div>
                                    </div>
                                </div>
                                <div style="width: 33%;">
                                    <p>Cỡ:</p>
                                    <div class="d-flex gap-2" style="color: #888888;">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="border-radius:3px; background-color:white;width:25px;height:25px;">
                                            <span style="font-size:15px;font-weight:600">S</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="border-radius:3px; background-color:white;width:25px;height:25px;">
                                            <span style="font-size:15px;font-weight:600">M</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <button class="btn"
                                    style="border: 1px solid black;border-radius:8px;font-weight:700;padding:8px 15px">Giảm
                                    40%</button>
                                <button class="btn"
                                    style="background:#e5b220;color:white ;border-radius:8px;font-weight:700;padding:8px 15px">Mua
                                    Ngay</button>
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
                            <img class="dodgeImage" src="./img/neymar.png" alt="" style="
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

        <div class="carousel-item">
            <section class="hero-section d-flex justify-content-center align-items-center">
                <div class="container hero-container">
                    <div class="hero-info">
                        <div class="hero-content-wrapper">
                            <div class="mb-3">
                                <p style="font-size: 70px; font-weight:700">Áo thể thao nữ</p>
                                <p>BST mới nhất 2025.</p>
                            </div>
                            <div class="d-flex mb-5">
                                <div style="width: 33%;">
                                    <p>Giá:</p>
                                    <p>đ350.000</p>
                                </div>
                                <div style="width: 33%;">
                                    <p>Màu:</p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div style="border-radius:50%; background-color:white;width:20px;height:20px;"></div>
                                        <div style="border-radius:50%; background-color:#cccccc;width:20px;height:20px;"></div>
                                    </div>
                                </div>
                                <div style="width: 33%;">
                                    <p>Cỡ:</p>
                                    <div class="d-flex gap-2" style="color: #888888;">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="border-radius:3px; background-color:white;width:25px;height:25px;">
                                            <span style="font-size:15px;font-weight:600">S</span>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="border-radius:3px; background-color:white;width:25px;height:25px;">
                                            <span style="font-size:15px;font-weight:600">L</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <button class="btn"
                                    style="border: 1px solid black;border-radius:8px;font-weight:700;padding:8px 15px">Sale
                                    30%</button>
                                <button class="btn"
                                    style="background:#e5b220;color:white ;border-radius:8px;font-weight:700;padding:8px 15px">Mua
                                    Ngay</button>
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
                            <img class="dodgeImage"
                                src="https://www.freeiconspng.com/uploads/zlatan-ibrahimovic-png-12.png" alt="" style="
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
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev"
        style="z-index: 999;">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next"
        style="z-index: 999;">
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

    const hoverElements = document.querySelectorAll('a, button');

    hoverElements.forEach(el => {
        el.addEventListener('mouseenter', () => {
            document.body.classList.add('hovered');
        });
        el.addEventListener('mouseleave', () => {
            document.body.classList.remove('hovered');
        });
    });
    animate();
</script>