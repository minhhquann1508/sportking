<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

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
</style>

<div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
    </div>

    <div class="carousel-inner">
        <div class="carousel-item active">
            <section class="hero-section d-flex justify-content-center align-items-center" style="background-color: #f2f2f2;">
                <div class="container hero-container">
                    <div class="hero-info">
                        <div class="hero-content-wrapper">
                            <div class="mb-3">
                                <p style="font-size: 70px; font-weight:700;">Áo thể thao nam</p>
                                <p>Thời trang nữ cao cấp, thiết kế trẻ trung.</p>
                            </div>

                            <div class="d-flex gap-1">
                                <button class="btn"
                                    style="border: 1px solid black;border-radius:0;font-weight:700;padding:8px 15px">Giảm
                                    40%</button>
                                <button class="btn"
                                    style="background:#BD844C;color:white ;border-radius:0;font-weight:700;padding:8px 15px">Mua
                                    Ngay</button>
                            </div>
                        </div>
                    </div>
                    <div class="hero-img">
                        <div class="shape-wrapper position-relative" style="width: 100%; max-width: 700px;">
                            <div class="bg-shape position-absolute" style="
                                    outline: 2px solid #BD844C;
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
                    <div>

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
</script>