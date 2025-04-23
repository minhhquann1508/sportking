<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<style>
    button {
        cursor: pointer;
        outline: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    .color-btn.active,
    .size-btn.active,
    .color-btn:hover,
    .size-btn:hover {
        border: 1px solid #C92127;
        background-color: rgb(255, 255, 255);
        color: #C92127;
    }

    .color-btn,
    .size-btn {
        border: 1px solid #ccc;
        border-radius: none;
        padding: 8px 24px;
        background-color: white;
        cursor: pointer;
    }

    button.disabled {
        opacity: 0.6;
        pointer-events: none;
    }

    p {
        padding: 0;
        margin: 0;
    }
</style>

<main style="padding-top: 76px;background-color:#f0f0f0">
    <section class="py-4">
        <div class="container">

            <div class="breadcrumb d-flex align-items-center gap-2">
                <span href="#"
                    style="font-size:13px;color:#212121;text-transform: uppercase;"><?php echo $variant_detail['data'][0]['category']['category_name']; ?></span></span>
                <i class="fa-solid fa-angle-right" style="color:#ccc"></i>
                <span href="#"
                    style="font-size:13px;color:#212121;text-transform: uppercase;"><?php echo $variant_detail['data'][0]['brand']['brand_name'] ?></span>
                <i class="fa-solid fa-angle-right" style="color:#ccc"></i>
                <span href="#" id=""
                    style="font-size:13px;color:#212121;text-transform: uppercase;"><?php echo $variant_detail['data'][0]['product_name'] ?></span>
            </div>

            <div class="d-flex gap-3">
                <!-- product imgs & cart -->
                <div class="p-4 rounded-3 position-sticky sticky-top" style="min-width: 500px;max-width: 500px;max-height:800px; background-color: white;z-index:100">
                    <div style="width: 100%; aspect-ratio: 1 / 1; background-color: #ccc; overflow: hidden;">
                        <img id="thumbnail" class="product-thumbnail"
                            style="width: 100%; height: 100%; object-fit: cover;"
                            src="<?php echo $variant_detail['data'][0]['images'][0] ?>" alt="">
                    </div>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <?php
                        $variants = $variant_detail_list['data']['variants'];
                        $all_images = [];

                        foreach ($variants as $variant) {
                            if (isset($variant['images']) && is_array($variant['images'])) {
                                foreach ($variant['images'] as $img) {
                                    $all_images[] = $img;
                                }
                            }
                        }
                        $max_thumbnail_img = 4;
                        $total_img = count($all_images);
                        $i = 0;
                        ?>
                        <div class="mt-3 d-flex gap-2 flex-wrap">
                            <?php foreach ($all_images as $img): ?>
                                <?php if ($i < $max_thumbnail_img): ?>
                                    <div class="position-relative" onclick="changeImage(this, '<?= $img ?>')" style="height:84px;width:84px">
                                        <div class="overplay position-absolute w-100 h-100 bg-light top-0 start-0 opacity-50" style="cursor: pointer;"></div>
                                        <img height="84" width="84" style="object-fit: contain;" src="<?= $img ?>" alt="">
                                    </div>
                                <?php elseif ($i === $max_thumbnail_img):
                                    $hidden_count = $total_img - $max_thumbnail_img;
                                ?>
                                    <button type="button" class="d-flex align-items-center justify-content-center border-0"
                                        style="background:#818181;width:84px;height:84px"
                                        data-bs-toggle="modal" data-bs-target="#moreImagesModal">
                                        <p class="fw-bold m-0" style="color:white">+<?= $hidden_count ?></p>
                                    </button>
                                    <?php break; ?>
                            <?php endif;
                                $i++;
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="fw-bold" style="font-size: 16px;">Chính sách ưu đãi của Sportking</p>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_truck_v2.png" alt="" width="18">
                                <p class="m-auto  fw-bold" style="font-size: 14px;">Thời gian giao hàng:</p>
                                <p class="m-auto" style=" font-size: 14px;">Giao hàng nhanh và uy tín</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 justify-content-between mt-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_transfer_v2.png" alt="" width="18">
                                <p class="m-auto fw-bold" style="font-size: 14px;">Chính sách đổi trả:</p>
                                <p class="m-auto" style="font-size: 14px;">Đổi trả miễn phí toàn quốc</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 justify-content-between mt-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_shop_v2.png" alt="" width="18">
                                <p class="m-auto fw-bold" style="font-size: 14px;">Chính sách khách sỉ:</p>
                                <p class="m-auto" style="font-size: 14px;">Ưu đãi khi mua số lượng lớn</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Modal Thumbnail -->
                <div class="modal fade" id="moreImagesModal" tabindex="-1" aria-labelledby="moreImagesLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
                            </div>
                            <div class="modal-body d-flex align-items-start gap-4 ">
                                <div style="width:100%; max-width:500px; aspect-ratio:1/1; background:#eee; overflow:hidden;">
                                    <img id="modal-main-img" src="<?= $variants[0]['images'][0] ?>"
                                        style="width:100%; height:100%; object-fit:cover;" class="rounded" alt="">
                                </div>

                                <div class="d-flex flex-wrap align-items-start" style="max-width: 260px; gap: 8px;">
                                    <?php foreach ($variants as $imgs): ?>
                                        <?php foreach ($imgs['images'] as $img): ?>
                                            <img src="<?= $img ?>"
                                                onclick="document.getElementById('modal-main-img').src='<?= $img ?>'"
                                                style="width: 80px; height: 80px; object-fit: contain; cursor: pointer;"
                                                class="p-1 bg-light" alt="">
                                        <?php endforeach; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="w-100">
                    <div class="p-4 rounded-3" style="background-color: white;">
                        <p class="text-uppercase fw-bold" style="font-size: 23px;"><?php echo $variant_detail['data'][0]['product_name'] ?></p>
                        </p>
                        <p class="mt-2"><?php echo $variant_detail['data'][0]['sub_desc'] ?>
                        </p>
                        <div class="d-flex gap-3 mt-3">
                            <p style="font-size: 14px;">Danh mục:</p>
                            <span class="fw-bolder" style="font-size: 14px;font-size: bold;"><?php echo $variant_detail['data'][0]['category']['category_name']; ?></span>
                            <p style="font-size: 14px;">Thương hiệu:</p>
                            <span class="fw-bolder" style="font-size: 14px;font-size: bold;"><?php echo $variant_detail['data'][0]['brand']['brand_name'] ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-2">
                            <div class="d-flex">
                                <span style="color: #F39801;font-size:18px">★</span>
                                <span style="color: #F39801;font-size:18px">★</span>
                                <span style="color: #F39801;font-size:18px">★</span>
                                <span style="color: #F39801;font-size:18px">★</span>
                                <span style="color: #F39801;font-size:18px">★</span>
                            </div>
                            <p style="color: #F39801;font-size:14px">(10 đánh giá)</p>
                            <span class="mx-2" style="color:grey">|</span>
                            <p style="font-size:14px">Đã bán <span style="color:#212121"><?php echo $variant_detail['data'][0]['solds'] ?></span></p>
                        </div>
                        <p style="font-size: 32px;font-weight: 900;color:#C92127" id="price"><?php echo number_format($variant_detail['data'][0]['price'], 0, ',', '.') ?>
                    </div>

                    <div class="p-4 rounded-3 mt-3" style="background-color: white">
                        <p class="fw-bold" style="font-size: 18px;">Thông tin sản phẩm</p>
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
                        ?>

                        <!-- Color buttons -->
                        <div class="d-flex gap-3 align-items-center mt-4">
                            <span style="width:100px">Màu: </span>
                            <div class="d-flex gap-3 align-items-center" id="color-buttons">
                                <?php foreach ($colors as $color): ?>
                                    <?php
                                    $color_id = $color['color_id'];
                                    $isActive = ($color_id == $default_color_id) ? 'active' : '';

                                    $hasSize = false;
                                    foreach ($sizes as $size):
                                        if (isset($availableCombinations[$color_id][$size['size_id']])) {
                                            $hasSize = true;
                                            break;
                                        }
                                    endforeach;

                                    $isDisabled = !$hasSize ? 'disabled' : '';
                                    ?>
                                    <button class="btn d-flex align-items-center gap-2 color-btn <?= $isActive ?>"
                                        data-color-id="<?= $color_id ?>" <?= $isDisabled ?>>
                                        <p class="m-0" style="width: 18px; height: 18px; background-color: <?= $color['color_hex'] ?>; border-radius: 50%;"></p>
                                        <span><?= $color['color_name'] ?></span>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Size buttons -->
                        <div class="d-flex gap-3 align-items-center mt-3">
                            <span style="width:100px">Size: </span>
                            <div class="d-flex gap-3 mb-2" id="size-buttons">
                                <?php foreach ($sizes as $size): ?>
                                    <?php
                                    $size_id = $size['size_id'];
                                    $isActive = ($size_id == $default_size_id) ? 'active' : '';
                                    $isDisabled = !isset($availableCombinations[$default_color_id][$size_id]) ? 'disabled' : '';
                                    ?>
                                    <button class="btn size-btn <?= $isActive ?>"
                                        data-size-id="<?= $size_id ?>" <?= $isDisabled ?>><?= $size['size_name'] ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>


                        <!-- Quantity control -->
                        <div class="d-flex align-items-center gap-4 mt-4">
                            <p style="font-size: 18px">Số lượng</p>
                            <div class="d-flex align-items-center border rounded" style="width: fit-content;margin-left:15px">
                                <button class="btn border-end" onclick="handleChangeQuantity(false)">-</button>
                                <span id="quantity" class="mx-3">1</span>
                                <button class="btn border-start" onclick="handleChangeQuantity(true)">+</button>
                            </div>
                            <div style="font-size: 14px" id="stock-info"></div>
                            <input id="stock" type="hidden" />
                        </div>
                        <div class="d-flex my-4 gap-3">
                            <div class="">
                                <button style="background: #BD844C;color:white;border-radius:0;font-weight:700;;padding:8px 15px" class="btn border w-100" id="add-btn">Thêm vào giỏ hàng</button>
                            </div>
                            <div class="">
                                <button style="background: black;color:white;border-radius:0;font-weight:700;;padding:8px 40px" class="btn border w-100">Mua ngay</button>
                            </div>
                        </div>
                    </div>

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
    const urlParams = new URLSearchParams(window.location.search);
    const product_id = urlParams.get('product_id');
    const availableCombinations = <?php echo json_encode($availableCombinations); ?>;

    let selectedColorId = document.querySelector('.color-btn.active')?.dataset.colorId;
    let selectedSizeId = document.querySelector('.size-btn.active')?.dataset.sizeId;

    if (selectedColorId && selectedSizeId && availableCombinations[selectedColorId]?.[
            selectedSizeId
        ]) {
        fetchVariant();
    }


    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('quantity').textContent = 1;
            if (this.disabled) return;

            document.querySelectorAll('.color-btn').forEach(b => b.classList.remove(
                'active'));
            this.classList.add('active');

            selectedColorId = this.dataset.colorId;

            document.querySelectorAll('.size-btn').forEach(sizeBtn => {
                const sizeId = sizeBtn.dataset.sizeId;
                const isAvailable = availableCombinations[selectedColorId] &&
                    availableCombinations[selectedColorId][sizeId];

                sizeBtn.disabled = !isAvailable;

                if (!isAvailable && sizeBtn.classList.contains('active')) {
                    sizeBtn.classList.remove('active');
                    selectedSizeId = null;
                }
            });

            if (selectedSizeId && availableCombinations[selectedColorId]?.[
                    selectedSizeId
                ]) {
                fetchVariant();
            }
        });
    });

    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('quantity').textContent = 1;
            if (this.disabled) return;

            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove(
                'active'));
            this.classList.add('active');

            selectedSizeId = this.dataset.sizeId;

            if (selectedColorId && availableCombinations[selectedColorId]?.[
                    selectedSizeId
                ]) {
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
                size_id: selectedSizeId,
                product_id: product_id
            },
            success: (res) => {
                console.log("Response:", res);
                if (res.success && res.data) {
                    const variant = res.data;

                    $('#stock-info').text(
                        variant.stock > 0 ? `${variant.stock} sản phẩm có sẵn` : 'Hết hàng'
                    ).show();
                    $('#stock').val(variant.stock);
                    $('#price').text(`${Number(variant.price).toLocaleString()} đ`);
                    selectedVariantId = variant.variant_id;

                    $('#thumbnail').attr('src', variant.image_url);
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

<script>
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('selected'));
            this.classList.add('selected');
        });
    });

    const handleChangeQuantity = (status) => {
        const quantitySpan = document.getElementById('quantity');
        let quantity = Number(quantitySpan.textContent.trim());
        const stock = Number(document.getElementById('stock').value);
        console.log(stock);

        if (status) {
            if (quantity < stock) {
                quantity++;
            }
        } else {
            if (quantity > 1) {
                quantity--;
            }
        }
        quantitySpan.textContent = quantity;
    }

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
        const quantity = Number($('#quantity').text());
        const urlParams = new URLSearchParams(window.location.search);
        const product_id = urlParams.get('product_id');
        const price = Number($('#price').text().replace(/\./g, ""));
        $.ajax({
            url: '?controller=variant&action=get_variant_item',
            method: 'POST',
            data: {
                product_id,
                color_id: selectedColorId,
                size_id: selectedSizeId
            },
            dataType: 'json',
            success: (res) => {
                const variant = {
                    ...res.data,
                    quantity
                };
                $.ajax({
                    url: '?controller=cart&action=add',
                    method: 'POST',
                    dataType: 'json',
                    data: variant,
                    success: (res) => {
                        updateCartQuantitySpan();
                        showToast(res.message);
                    },
                    error: (err) => {
                        console.log(err);
                    }
                });
            },
            error: (err) => {
                console.log(err);
            }
        });
    });
</script>