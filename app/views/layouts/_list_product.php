<?php
require_once '../app/models/Variant.php';

function render_list_product($data)
{
    echo '<div class="product-list">';
    foreach ($data['data'] as $product):
        $variantModel = new Variant();
        $variant = $variantModel->get_all_variant_by_product_id($product['product_id']);
        $price = 0;
        if (isset($variant['data'][0]['price'])) {
            $price = $variant['data'][0]['price'] ?? 0;
        }
?>
        <div class="product-card">
            <div class="">
                <img src="<?= $product['thumbnail'] ?>">
                <div class="product-actions">
                    <ul class="product-icons">
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>"><i class="fa-solid fa-cart-shopping"></i></a>
                        </li>
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>"><i class="fa-regular fa-eye"></i></a>
                        </li>
                        <li>
                            <a class="" href="http://localhost/sportking/public/?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>"><i class="fa-regular fa-heart"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div style="padding: 10px;">
                <a href="http://localhost/sportking/public/?controller=home&action=product_detail&product_id=<?= $product['product_id'] ?>" style="font-size: 16px; margin: 0;"><?= $product['product_name'] ?></a>
                <p style="font-size: 14px;margin: 0;" class="text-muted mb-2"><?= $product['brand_name'] ?></p>
                <p style="font-size: 16px; font-weight: 600; margin: 0;">đ<?= number_format($price, 0, ',', '.') ?></p>
            </div>
        </div>
<?php endforeach;
    echo '</div>';
}
?>