<?php
function render_list_product($data)
{
    echo '<div class="product-list">';
    foreach ($data as $product): ?>
        <div class="product-card">
            <div class="">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="product-actions">
                    <ul class="product-icons">
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=detail&id=<?= $product['id'] ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=detail&id=<?= $product['id'] ?>"><i class="fa-regular fa-eye"></i></a>
                        </li>
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=detail&id=<?= $product['id'] ?>"><i class="fa-regular fa-heart"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="padding: 10px;">
                <a href="http://localhost/sportking/public/?controller=home&action=detail&id=<?= $product['id'] ?>" style="font-size: 16px; margin: 0;"><?= $product['name'] ?></a>
                <p style="font-size: 14px;margin: 0;" class="text-muted mb-2"><?= $product['brand'] ?></p>
                <p style="font-size: 16px; font-weight: 600; margin: 0;">đ<?= $product['price'] ?></p>
            </div>
        </div>
<?php endforeach;
    echo '</div>';
}
?>