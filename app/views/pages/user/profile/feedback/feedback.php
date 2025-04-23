<?php if (!empty($feedback)): ?>
<?php foreach ($feedback['data'] as $item): ?>
<div class="pb-3 mb-3 border-bottom">
    <div class="row g-0">
        <div class="col-md-2">
            <a
                href="?controller=home&action=product_detail&product_id=<?= $item['product_id'] ?>&variant_id=<?= $item['variant_id'] ?>">
                <img src="<?= $item['thumbnail'] ?>" class="img-fluid rounded" alt="<?= $item['product_name'] ?>"
                    style="max-width: 100px;">
            </a>
        </div>
        <div class="col-md-10 ps-md-3">
            <div class="d-flex justify-content-between">
                <h5 class="mb-1" style="font-size: 1rem;">
                    <a href="?controller=home&action=product_detail&product_id=<?= $item['product_id'] ?>&variant_id=<?= $item['variant_id'] ?>"
                        class="text-decoration-none text-primary fw-bold">
                        <?= $item['product_name'] ?>
                    </a>
                </h5>
                <small class="text-muted"
                    style="font-size: 0.875rem;"><?= date('d/m/Y', strtotime($item['create_at'])) ?></small>
            </div>
            <p class="mb-2" style="font-size: 0.875rem;"><?= nl2br($item['content']) ?></p>
            <div class="text-warning">
                <?php for ($i = 0; $i < (int)$item['rating']; $i++): ?>
                ⭐
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php else: ?>
<p>Bạn chưa có nhận xét nào.</p>
<?php endif; ?>