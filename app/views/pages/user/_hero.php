<style>
.hero_section {
    height: 400px;
    overflow: hidden;
}

.hero_section .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}
</style>

<section class="hero_section container mt-4" style="height: 400px;">
    <div id="heroCarousel" class="carousel slide h-100" data-bs-ride="carousel">
        <div class="carousel-inner h-100">
            <?php foreach ($banners['data'] as $index => $banner): ?>
            <div class="carousel-item h-100 <?= $index === 0 ? 'active' : '' ?>">
                <img src="<?= $banner['img_url'] ?>" class="d-block w-100 h-100" alt="Banner <?= $index + 1 ?>"
                    style="object-fit: cover;">
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
        <div class="carousel-indicators">
            <?php foreach ($banners['data'] as $index => $banner): ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                <?= $index === 0 ? 'class="active" aria-current="true"' : '' ?>
                aria-label="Slide <?= $index + 1 ?>"></button>
            <?php endforeach; ?>
        </div>
    </div>
</section>