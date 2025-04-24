<?php
function render_list_product($data)
{
    if (!empty($data) && !empty($data['data'])) {
        echo '<div class="product-list">';
        foreach ($data['data'] as $product) {
            $price = $product['price'];
            $color_name = $product['color_name'];
            $image = $product['image_url'];
            $productName = $product['product_name'];
            $brand = $product['brand_name'];
            $variantId = $product['variant_id'];
            $productId = $product['product_id'];
?>
<div class="product-card">
    <div class="">
        <div class="d-flex jusity-content-center">
            <img style="object-fit: contain;" src="<?= $image ?>" alt="<?= $productName ?>">
        </div>
        <div class="product-actions">
            <ul class="product-icons">
                <li>
                    <a
                        href="?controller=home&action=product_detail&product_id=<?= $productId ?>&variant_id=<?= $variantId ?>"><i
                            class="fa-solid fa-cart-shopping"></i></a>
                </li>
                <li>
                    <a href="#" class="quick-view-btn" data-product-id="<?= $productId ?>" data-bs-toggle="modal"
                        data-bs-target="#quickViewModal">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </li>
                <li>
                    <a
                        href="?controller=home&action=product_detail&product_id=<?= $productId ?>&variant_id=<?= $variantId ?>"><i
                            class="fa-regular fa-heart"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div style="padding: 10px;">
        <a href="?controller=home&action=product_detail&product_id=<?= $productId ?>&variant_id=<?= $variantId ?>"
            style="font-size: 16px; margin: 0;"><?= $productName . ' ' . $color_name; ?></a>
        <p style="font-size: 14px;margin: 0;" class="text-muted mb-2"><?= $brand ?></p>
        <p style="font-size: 16px; font-weight: 600; margin: 0;">đ<?= number_format($price, 0, ',', '.') ?></p>
    </div>
</div>
<?php
    }
        echo '</div>';
    } else {
        echo '<p class="text-center text-muted py-5">Không có sản phẩm phù hợp.</p>';
    }
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

        $("#quickViewContent").html(
            '<div class="text-center py-3"><div class="spinner-border text-primary"></div></div>');

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
                $("#quickViewContent").html(
                    "<p class='text-danger'>Lỗi tải thông tin sản phẩm.</p>");
                console.error("Lỗi AJAX: ", error);
            }
        });
    });
});
</script>