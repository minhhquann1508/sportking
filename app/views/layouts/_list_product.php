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
                            <a href="#" class="quick-view-btn" data-product-id="<?= $product['product_id'] ?>" data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                <i class="fa-regular fa-eye"></i>
                            </a>
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

<div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" style="border-radius: none;max-width:1200px">
        <div class="modal-content" style="border-radius: none;">
            <div class="modal-header" style="border:none;border-radius: none">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body" id="quickViewContent">
                hello
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(".quick-view-btn").on("click", function(e) {
            e.preventDefault();

            var productId = $(this).data("product-id");

            $("#quickViewContent").html('<div class="text-center py-3"><div class="spinner-border text-primary"></div></div>');

            $.ajax({
                url: "?controller=home&action=quickview",
                method: "GET",
                data: {
                    product_id: productId
                },
                success: (response) => {
                    $("#quickViewContent").html(response);
                },
                error: (xhr, status, error) => {
                    $("#quickViewContent").html("<p class='text-danger'>Lỗi tải thông tin sản phẩm.</p>");
                    console.error("Lỗi AJAX: ", error);
                }
            });
        });
    });
</script>