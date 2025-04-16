<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>

<?php
$productData = $product['data'][0] ?? [];
$variantData = $variant['data'] ?? [];

$thumbnail = !empty($productData['thumbnail']) ? $productData['thumbnail'] : 'https://placehold.co/400x600';
$views = $productData['views'] ?? 0;
$solds = $productData['solds'] ?? 0;
$subDesc = $productData['sub_desc'] ?? 'Không có mô tả ngắn';
$desc = $productData['desc'] ?? 'Không có mô tả chi tiết';
$price = !empty($variantData[0]['price']) ?  $variantData[0]['price'] : 0;
?>


<main style="padding-top: 76px;">
    <section class="py-4">
        <div class="container">
            <!-- <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item fw-bold">Chi tiết sản phẩm</li>
                    <li class="breadcrumb-item  fw-bold">Áo thể thao chống thấm hút mồ hôi</li>
                </ol>
            </nav> -->
            <div class="row">
                <div class="col-5 d-flex">
                    <div class="me-2 d-flex gap-2 h-100" style="flex-direction: column; width: 80px;">
                        <?php
                        $img_arr = [
                            'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(5).jpg',
                            'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(1).jpg',
                            'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(2).jpg',
                            'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(9).jpg',
                            'https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(11).jpg'
                        ];

                        $content = '';
                        if (!empty($variant['data'])):

                            foreach ($variant['data'] as $img) {
                                $image_url = !empty($img['image_url']) ? $img['image_url'] : 'https://placehold.co/400x600';
                                $content .= '<div class="position-relative flex-grow-1" onclick="changeImage(this, \'' . $image_url . '\')">
                                            <div class="overplay position-absolute w-100 h-100 bg-light top-0 start-0 opacity-50"
                                                style="cursor: pointer;"></div>
                                            <img height="120" width="80" class="w-100"
                                                src="' . $image_url . '"
                                                alt="">
                                        </div>';
                            }
                            echo $content;
                        endif;
                        ?>

                    </div>
                    <div style="width: 420px; height: 100%">
                        <img class="product-thumbnail fade-in w-100 h-100"
                            src="<?php echo $thumbnail ?>" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <h3 class="text-uppercase" style="font-weight: 500;"><?php echo $product['data'][0]['product_name'] ?></h3>
                    <h6 style="font-weight: 200;" class="text-decoration-line-through text-black-50">2.500.000đ</h6>
                    <h4 style="font-weight: 200;" class="d-flex align-items-center gap-3">
                        <?php echo number_format($price, 0, ',', '.') ?>
                        <span class="bg-primary fw-bold fs-6 px-2 py-1 rounded text-white">-20%</span>
                    </h4>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Danh mục: </strong><span><?php echo $product['data'][0]['category_name'] ?></span></span>
                        <span><strong>Thương hiệu: </strong><span><?php echo $product['data'][0]['brand_name'] ?></span></span>
                    </div>
                    <!-- <div class="d-flex gap-3 mb-2">
                        <span><strong>Màu sắc: </strong><span></span></span>
                        <span><strong>Còn lại: </strong><span>1</span></span>
                    </div> -->
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Lượt xem: </strong><span><?php echo $product['data'][0]['views'] ?></span></span>
                        <span><strong>Lượt bán: </strong><span><?php echo $product['data'][0]['solds'] ?></span></span>
                    </div>
                    <strong>Mô tả ngắn</strong>
                    <p style="line-height: 1.6;"><?php echo $product['data'][0]['sub_desc'] ?>
                    </p>
                    <div class="d-flex gap-2 mb-3">
                        <?php if (!empty($variant['data'])): ?>
                            <?php foreach ($variant['data'] as $data) : ?>
                                <button class="btn btn-sm border d-flex align-items-center gap-2">
                                    <p class="m-0" style="width: 18px; height: 18px; background-color: <?php echo $data['color_hex'] ?>;"></p>
                                    <span><?php echo $data['color_name'] ?></span>
                                </button>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="mb-3">
                        <select style="width: 200px;" class="form-select" aria-label="Default select example">
                            <option selected>Vui lòng chọn size</option>
                            <?php foreach ($variant['data'] as $data) : ?>
                                <option value="<?php echo $data['size_id'] ?>"><?php echo $data['size_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="d-flex align-items-center border rounded mb-3" style="width: fit-content;">
                        <button class="btn border-end">-</button>
                        <span id="quantity" class="mx-3">1</span>
                        <button class="btn border-start">+</button>
                    </div>
                    <div>
                        <button class="btn btn-outline-primary">Thêm vào giỏ hàng</button>
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

    <section class="py-4 bg-light">
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
            <?php render_list_product($productList); ?>
        </div>
    </section>
</main>
<?php
print_r($product);
print_r($variant);
?>
<script>
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
</script>