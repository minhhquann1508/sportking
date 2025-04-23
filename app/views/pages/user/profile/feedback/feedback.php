<div class="review-container">
    <h3>Nhận xét của tôi</h3>
    <?php if (!empty($feedback['data'])): ?>
    <?php foreach ($feedback['data'] as $item): ?>
    <div class="review-item">
        <div class="row g-0">
            <div class="col-md-2">
                <a
                    href="?controller=home&action=product_detail&product_id=<?= $item['product_id'] ?>&variant_id=<?= $item['variant_id'] ?>">
                    <img src="<?= $item['thumbnail'] ?>" class="img-fluid" alt="<?= $item['product_name'] ?>">
                </a>
            </div>
            <div class="col-md-10 ps-md-3">
                <div class="review-content-wrapper">
                    <div class="d-flex justify-content-between flex-wrap">
                        <a href="?controller=home&action=product_detail&product_id=<?= $item['product_id'] ?>&variant_id=<?= $item['variant_id'] ?>"
                            class="product-name"><?= $item['product_name'] ?></a>
                        <span class="review-date"><?= date('d/m/Y', strtotime($item['create_at'])) ?></span>
                    </div>
                    <p class="review-content"><?= nl2br($item['content']) ?></p>
                    <div class="review-rating">
                        <?php for ($i = 0; $i < (int)$item['rating']; $i++): ?>⭐<?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p>Bạn chưa có nhận xét nào. <a href="?controller=home&action=product">Mua hàng để đánh giá.</a></p>
    <?php endif; ?>
</div>

<style>
.review-container {
    padding: 24px;
    background: #fafafa;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
    margin-bottom: 40px;
    max-width: 100%;
}

.review-container h3 {
    font-size: 1.4rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.review-item {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    padding: 16px 0;
    border-bottom: 1px solid #ddd;
}

.review-item:last-child {
    border-bottom: none;
}

.review-item img {
    width: 600px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.review-content-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.product-name {
    font-size: 1.05rem;
    font-weight: 600;
    color: #0d6efd;
    text-decoration: none;
    transition: 0.3s;
}

.product-name:hover {
    color: #0b5ed7;
    text-decoration: underline;
}

.review-date {
    font-size: 0.875rem;
    color: #999;
}

.review-content {
    margin: 10px 0;
    font-size: 0.95rem;
    color: #444;
    white-space: pre-line;
    line-height: 1.5;
}

.review-rating {
    color: #f5c518;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .review-item {
        flex-direction: column;
    }

    .review-item img {
        width: 100%;
        height: auto;
        max-height: 200px;
    }

    .review-content-wrapper {
        padding-top: 10px;
    }
}
</style>