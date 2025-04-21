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