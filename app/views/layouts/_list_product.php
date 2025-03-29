<style>
    .tf-grid-layout {
        display: grid;
        gap: 20px;
    }

    .tf-col-2 {
        grid-template-columns: repeat(2, 1fr);
    }

    @media (min-width: 992px) {
        .tf-grid-layout.lg-col-3 {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1200px) {
        .tf-grid-layout.xl-col-4 {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    .product-card {
        position: relative;
        overflow: hidden;
        border-radius: 15px;
        background: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card:hover {}

    .product-card img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 15px;
    }

    .product-info {
        padding: 10px;
    }

    .product-actions {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(0, 0, 0, 0.5);
        opacity: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 10px;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .product-actions button {
        background-color: #E6B31E;
        border: none;
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        cursor: pointer;
        font-size: 14px;
    }

    .product-icons {
        display: flex;
        gap: 10px;
    }

    .product-icons img {
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        padding: 5px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .product-icons img:hover {
        background: #E6B31E;
    }

    @media (max-width: 768px) {
        .product-card img {
            height: 300px;
        }
    }

    @media (max-width: 576px) {
        .product-card img {
            height: 250px;
        }
    }
</style>

<?php
function render_list_product($data)
{
    foreach ($data as $product): ?>
        <div class="product-card">
            <a href="">
                <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                <div class="product-info">
                    <p style="font-size: 16px"><?= $product['name'] ?></p>
                    <p style="font-size: 14px; font-weight:600">đ<?= $product['price'] ?></p>
                </div>
            </a>
            <div class="product-actions">
                <button>Xem ngay</button>
                <div class="product-icons">
                    <img src="./img/cart.svg">
                    <img src="./img/heart.svg">
                </div>
            </div>
        </div>
<?php endforeach;
}
?>