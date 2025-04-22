<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>

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
                            src="<?php echo $variant_detail['data'][0]['images'][0] ?>" alt="">
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
                    <style>
                        .color-btn.active,
                        .size-btn.active {
                            border: 2px solid #ff5722;
                            background-color: #ffe9e0;
                            color: #ff5722;
                            font-weight: bold;
                            transition: all 0.3s ease;
                        }

                        .color-btn,
                        .size-btn {
                            cursor: pointer;
                            border: 1px solid #ddd;
                            padding: 8px 12px;
                            border-radius: 6px;
                            background-color: #fff;
                            margin-right: 8px;
                            transition: all 0.2s ease;
                        }

                        button.disabled {
                            opacity: 0.4;
                            pointer-events: none;
                        }
                    </style>
                    <?php
                    $colors = $variant_detail_list['data']['colors'];
                    $sizes = $variant_detail_list['data']['sizes'];
                    $variants = $variant_detail_list['data']['variants'];

                    $availableCombinations = [];
                    foreach ($variants as $variant) {
                        $availableCombinations[$variant['color_id']][$variant['size_id']] = $variant['variant_id'];
                    }

                    $default_variant_id = $variant_detail['data'][0]['variant_id'];
                    $first_variant_id = $variant_detail_list['data']['first_variant_id'];

                    foreach ($variants as $variant) {
                        if ($variant['variant_id'] == $first_variant_id) {
                            $default_size_id = $variant['size_id'];
                            $default_color_id = $variant['color_id'];
                            break;
                        }
                    }

                    echo '<div class="d-flex gap-3 mb-2" id="color-buttons">';
                    foreach ($colors as $color) {
                        $color_id = $color['color_id'];
                        $isActive = ($color_id == $default_color_id) ? 'active' : '';

                        $hasSize = false;
                        foreach ($sizes as $size) {
                            if (isset($availableCombinations[$color_id][$size['size_id']])) {
                                $hasSize = true;
                                break;
                            }
                        }
                        $isDisabled = !$hasSize ? 'disabled' : '';

                        echo '
                            <button class="btn d-flex align-items-center gap-2 color-btn ' . $isActive . '" 
                                data-color-id="' . $color_id . '" ' . $isDisabled . '>
                                <p class="m-0"
                                style="width: 18px; height: 18px; background-color: ' . $color['color_hex'] . '; border-radius: 50%;"></p>
                                <span>' . $color['color_name'] . '</span>
                            </button>
                        ';
                    }
                    echo '</div>';

                    echo '<div class="d-flex gap-3 mb-2" id="size-buttons">';
                    foreach ($sizes as $size) {
                        $size_id = $size['size_id'];
                        $isActive = ($size_id == $default_size_id) ? 'active' : '';
                        $isDisabled = !isset($availableCombinations[$default_color_id][$size_id]) ? 'disabled' : '';

                        echo '
                            <button class="btn btn-outline-dark size-btn ' . $isActive . '" 
                                data-size-id="' . $size_id . '" ' . $isDisabled . '>' . $size['size_name'] . '</button>
                        ';
                    }
                    echo '</div>';
                    ?>




                    <div id="stock-info"></div>
                    <script>
                        const availableCombinations = <?php echo json_encode($availableCombinations); ?>;

                        let selectedColorId = document.querySelector('.color-btn.active')?.dataset.colorId;
                        let selectedSizeId = document.querySelector('.size-btn.active')?.dataset.sizeId;

                        if (selectedColorId && selectedSizeId && availableCombinations[selectedColorId]?.[selectedSizeId]) {
                            fetchVariant();
                        }


                        // Đoạn xử lý .color-btn như bạn đã viết
                        document.querySelectorAll('.color-btn').forEach(btn => {
                            btn.addEventListener('click', function() {
                                if (this.disabled) return;

                                document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
                                this.classList.add('active');

                                selectedColorId = this.dataset.colorId;

                                document.querySelectorAll('.size-btn').forEach(sizeBtn => {
                                    const sizeId = sizeBtn.dataset.sizeId;
                                    const isAvailable = availableCombinations[selectedColorId] && availableCombinations[selectedColorId][sizeId];

                                    sizeBtn.disabled = !isAvailable;

                                    if (!isAvailable && sizeBtn.classList.contains('active')) {
                                        sizeBtn.classList.remove('active');
                                        selectedSizeId = null;
                                    }
                                });

                                if (selectedSizeId && availableCombinations[selectedColorId]?.[selectedSizeId]) {
                                    fetchVariant();
                                }
                            });
                        });

                        document.querySelectorAll('.size-btn').forEach(btn => {
                            btn.addEventListener('click', function() {
                                if (this.disabled) return;

                                document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
                                this.classList.add('active');

                                selectedSizeId = this.dataset.sizeId;

                                if (selectedColorId && availableCombinations[selectedColorId]?.[selectedSizeId]) {
                                    fetchVariant();
                                }
                            });
                        });



                        function fetchVariant() {
                            $.ajax({
                                url: '?controller=home&action=get_variant',
                                method: 'POST',
                                dataType: 'json',
                                data: {
                                    color_id: selectedColorId,
                                    size_id: selectedSizeId
                                },
                                success: (res) => {
                                    console.log("Response:", res);
                                    if (res.success && res.data) {
                                        const variant = res.data;
                                        $('#stock-info').text(
                                            variant.stock > 0 ? `Còn lại: ${variant.stock} sản phẩm` : 'Hết hàng'
                                        ).show();
                                        selectedVariantId = variant.variant_id;
                                    } else {
                                        $('#stock-info').text(res.message || 'Không tìm thấy dữ liệu').show();
                                    }
                                },
                                error: (xhr) => {
                                    console.error('Lỗi khi lấy variant:', xhr);
                                    console.log('Phản hồi từ server:', xhr.responseText);
                                    $('#stock-info').text('Có lỗi xảy ra').show();
                                }
                            });
                        }
                    </script>
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
                <p style="line-height: 1.6;"><?php echo $variant_detail_list['data']['product']['description'] ?>
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
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });
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