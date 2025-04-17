<div class="row">
    <div class="col-md-6">
        <img src="<?= $product['data'][0]['thumbnail'] ?>" id="mainImage" class="img-fluid mb-3" alt="Ảnh sản phẩm">

        <?php if (!empty($variant['data'][0]['images'])): ?>
            <div class="d-flex gap-2">
                <?php foreach ($variant['data'][0]['images'] as $data): ?>
                    <img src="<?= $data ?>" class="img-thumbnail sub-img" style="width: 60px; height: 60px; object-fit: cover;" onclick="document.getElementById('mainImage').src=this.src">
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-md-6">
        <h5><?= $product['data'][0]['product_name'] ?></h5>
        <p class="text-muted"><?= $product['data'][0]['brand_name'] ?></p>
        <p class="fw-bold">đ<?= number_format($variant['data'][0]['price'], 0, ',', '.') ?></p>

        <div class="d-flex gap-3 mb-2">
            <span><strong>Lượt xem:</strong> <?= $product['data'][0]['views'] ?></span>
            <span><strong>Lượt bán:</strong> <?= $product['data'][0]['solds'] ?></span>
        </div>

        <div class="mb-2">
            <strong>Mô tả ngắn</strong>
            <p style="line-height: 1.6;"><?= $product['data'][0]['sub_desc'] ?></p>
        </div>
        <div class="mb-2">
            <strong>Màu sắc:</strong>
            <?php if (!empty($variant['data'][0]['colors'])): ?>
                <div class="d-flex gap-2 mb-3">
                    <?php foreach ($variant['data'][0]['colors'] as $color): ?>
                        <button class="btn btn-sm border d-flex align-items-center gap-2 color-btn"
                            data-color-id="<?= $color['color_id'] ?>">
                            <span style="width: 18px; height: 18px; background-color:<?= $color['color_hex'] ?>; display:inline-block;"></span>
                            <span><?= $color['color_name'] ?></span>
                        </button>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>


        <div class="mb-3">
            <strong>Kích cỡ:</strong>
            <?php if (!empty($variant['data'][0]['sizes'])): ?>
                <div class="mb-3">
                    <select style="width: 200px;" id="size-input" class="form-select">
                        <option selected disabled>Vui lòng chọn size</option>
                        <?php foreach ($variant['data'][0]['sizes'] as $size): ?>
                            <option value="<?= $size['size_id'] ?>"><?= $size['size_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>

        </div>

        <div class="d-flex align-items-center border rounded mb-3" style="width: fit-content;">
            <button class="btn border-end" onclick="handleChangeQuantity(false)">-</button>
            <span id="quantity" class="mx-3">1</span>
            <button class="btn border-start" onclick="handleChangeQuantity(true)">+</button>
        </div>

        <div class="d-flex gap-2">
            <button class="btn" style="background: #BD844C;color:white;border-radius:0;font-weight:700;padding:8px 15px">
                Thêm vào giỏ hàng
            </button>
            <button class="btn" style="background:black;color:white;border-radius:0;font-weight:700;padding:8px 15px">
                Mua Ngay
            </button>
        </div>
    </div>
</div>
</div>


<script>
    function handleChangeQuantity(increase) {
        const quantityEl = document.getElementById("quantity");
        let quantity = parseInt(quantityEl.textContent);

        if (increase) {
            quantity += 1;
        } else {
            quantity = quantity > 1 ? quantity - 1 : 1;
        }

        quantityEl.textContent = quantity;
    }
</script>