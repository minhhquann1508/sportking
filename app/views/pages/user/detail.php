<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>

<?php
print_r($variant_detail);
?>

<main style="padding-top: 76px;">
    <section class="py-4">
        <div class="container">
            <input type="hidden" id="product-id" value="<?php echo $variant_detail['data'][0]['variant_id'] ?>">
            <div class="row">
                <div class="col-6 d-flex">
                    <div class="me-2 d-flex gap-2 h-100" style="flex-direction: column; width: 80px;">
                        <?php
                        $content = '';
                        foreach ($variant_detail['data'][0]['images'] as $img) {
                            $content .= '<div class="position-relative flex-grow-1" onclick="changeImage(this, \'' . $img . '\')">
                                    <div class="overplay position-absolute w-100 h-100 bg-light top-0 start-0 opacity-50"
                                        style="cursor: pointer;"></div>
                                    <img height="120" width="80" class="w-100" style="object-fit: contain;"
                                        src="' . $img . '"
                                        alt="">
                                </div>';
                        }
                        echo $content;
                        ?>
                    </div>
                    <div style="width: 100%; height: 100%">
                        <img id="thumbnail" class="product-thumbnail fade-in w-100 h-100" style="object-fit: contain;"
                            src="<?php echo $thumbnail ?>" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <h3 class="text-uppercase" style="font-weight: 500;">
                        <?php echo $variant_detail['data'][0]['product_name'] ?></h3>
                    <h4 style="font-weight: 200;" class="d-flex align-items-center gap-3">
                        <h4 id="price"><?php echo number_format($variant_detail['data'][0]['price'], 0, ',', '.') ?></h4>
                    </h4>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Danh mục:
                                <span><?php echo $variant_detail['data'][0]['category']['category_name']; ?></span>

                                <span><strong>Thương hiệu:
                                    </strong><span><?php echo $variant_detail['data'][0]['brand']['brand_name'] ?></span></span>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Lượt xem: </strong><span><?php echo $variant_detail['data'][0]['views'] ?></span></span>
                        <span><strong>Lượt bán: </strong><span><?php echo $variant_detail['data'][0]['solds'] ?></span></span>
                    </div>
                    <strong>Mô tả ngắn</strong>
                    <p style="line-height: 1.6;"><?php echo $variant_detail['data'][0]['sub_desc'] ?>
                    </p>
                    <div class="d-flex gap-2 mb-3">
                        <?php
                        $colors = $variant_detail['data'][0]['colors'];
                        foreach ($colors as $color) {
                            echo '
                                <button class="btn btn-sm border d-flex align-items-center gap-2 color-btn"
                                    data-color-id="' . $color['color_id'] . '">
                                    <p class="m-0"
                                        style="width: 18px; height: 18px; background-color: ' . $color['color_hex'] . '; border-radius: 50%;">
                                    </p>
                                    <span>' . $color['color_name'] . '</span>
                                </button>
                            ';
                        }
                        ?>

                    </div>

                    <div class="mb-3">
                        <select style="width: 200px;" id="size-input" class="form-select"
                            aria-label="Default select example">
                            <option selected>Vui lòng chọn size</option>
                            <?php
                            $sizes = $variant_detail['data'][0]['sizes'];
                            foreach ($sizes as $size) {
                                echo '<option value="' . $size['size_id'] . '">' . $size['size_name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="d-flex align-items-center border rounded mb-3" style="width: fit-content;">
                        <button class="btn border-end" onclick="handleChangeQuantity(false)">-</button>
                        <span id="quantity" class="mx-3">1</span>
                        <button class="btn border-start" onclick="handleChangeQuantity(true)">+</button>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary" id="add-btn">Thêm vào giỏ hàng</button>
                        <button class="btn btn-primary">Mua ngay</button>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6 mb-3 d-flex gap-2 align-items-center">
                            <img width="32" height="32" src="https://www.coolmate.me/images/product-detail/return.svg"
                                alt="">
                            <small class="fw-bold">Đổi trả cực dễ chỉ cần số
                                điện thoại</small>
                        </div>
                        <div class="col-6 mb-3 d-flex gap-2 align-items-center">
                            <img width="32" height="32" src="https://www.coolmate.me/images/product-detail/phone.svg"
                                alt="">
                            <small class="fw-bold">Hotline 1900.27.27.37 hỗ
                                trợ từ 8h30 - 22h mỗi ngày</small>
                        </div>
                        <div class="col-6 mb-3 d-flex gap-2 align-items-center">
                            <img width="32" height="32"
                                src="https://www.coolmate.me/images/product-detail/return-60.svg" alt="">
                            <small class="fw-bold">60 ngày đổi trả vì bất kỳ lý do gì</small>
                        </div>
                        <div class="col-6 mb-3 d-flex gap-2 align-items-center">
                            <img width="32" height="32" src="https://www.coolmate.me/images/product-detail/location.svg"
                                alt="">
                            <small class="fw-bold">Đến tận nơi nhận hàng trả,
                                hoàn tiền trong 24h</small>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
            <div class="py-4">
                <h4>Mô tả chi tiết sản phẩm</h4>
                <p style="line-height: 1.6;"><?php echo $product['data'][0]['description'] ?>
                </p>
            </div>
        </div>
    </section>

    <section class="py-4 bg-light">1
        <div class="container">
            <h4>Đánh giá sản phẩm</h4>
            <hr>
            <?php if (!empty($comments) && is_array($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="row">
                        <div class="col-2 text-start pe-0 mt-1">
                            <strong style="font-size: 14px;">
                                <?= $comment['fullname'] ?>
                            </strong>
                            <br>
                            <small><?= date('d/m/Y', strtotime($comment['ngay_binh_luan'])) ?></small>
                        </div>
                        <div class="col-10 ps-0">
                            <div class="flex">
                                <?php
                                for ($i = 1; $i <= $comment['rating']; $i++) {
                                    echo '<i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>';
                                }
                                ?>
                            </div>
                            <small style="line-height: 1.6;">
                                <?= htmlspecialchars($comment['content'] ?? 'Không có nội dung bình luận.') ?>
                            </small>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Chưa có bình luận nào.</p>
            <?php endif; ?>
        </div>
    </section>

    <section class="py-4">
        <div class="container">
            <h4 class="text-center">Sản phẩm liên quan</h4>
            <?php render_list_product($variant_list); ?>
        </div>
    </section>
</main>
<script>
    let selectedColorId = null;
    document.querySelectorAll('.color-btn').forEach(button => {
        button.addEventListener('click', function() {
            selectedColorId = this.getAttribute('data-color-id');
        });
    });
    const handleChangeQuantity = (status) => {
        const quantitySpan = document.getElementById('quantity');
        let quantity = Number(quantitySpan.textContent);

        if (status) {
            quantity += 1;
        } else {
            if (quantity > 1) {
                quantity -= 1;
            } else {
                return;
            }
        }
        quantitySpan.textContent = quantity;
    }

    const changeImage = (e, img) => {
        document.querySelector('.product-thumbnail').classList.remove("fade-in");
        const overPlays = document.querySelectorAll('.overplay');
        overPlays.forEach(overPlay => overPlay.style.display = 'block');
        const overPlay = e.querySelector('.overplay');
        overPlay.style.display = 'none';
        document.querySelector('.product-thumbnail').src = img;
        setTimeout(() => {
            document.querySelector('.product-thumbnail').classList.add("fade-in");
        }, 10);
    }

    $('#add-btn').click((e) => {
        const quantity = $('#quantity').text();
        const size = $('#size-input').val();
        const product_id = $('#product-id').val();
        $.ajax({
            url: `?controller=variant&action=get_variant_item&product_id=${product_id}&color_id=${selectedColorId}&size_id=${size}`,
            method: 'GET',
            dataType: 'json',
            success: (res) => {
                console.log(res);
                const variant = {
                    ...res.data,
                    quantity: Number(quantity)
                };
                // Thêm vào giỏ
                $.ajax({
                    url: '?controller=cart&action=add',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        product_id: product_id,
                        variant
                    },
                    success: (res) => {
                        updateCartQuantitySpan()
                        showToast('Thêm vào giỏ thành công')
                    },
                    error: (err) => {
                        console.log(err);
                    }
                })
            },
            error: (err) => {
                console.log(err);
            }
        })
    })
</script>