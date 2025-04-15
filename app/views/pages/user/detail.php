<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>

<?php

print_r($product);
print_r($variant);

$related_products = [
    ["id" => 1, "brand" => "Uniqlo", "name" => "White Casual Shirt", "price" => 80, "oldPrice" => 120, "discount" => "20%", "image" => "https://www.sporter.vn/wp-content/uploads/2022/09/Tong-hop-ao-bong-da-doi-tuyen-quoc-gia-adidas-tai-tro-world-cup-2022-14.jpg"],
    ["id" => 2, "brand" => "Uniqlo", "name" => "Cream Casual Shirt", "price" => 77, "oldPrice" => 108.5, "discount" => "15%", "image" => "https://photo.znews.vn/w660/Uploaded/pnbcuhbatgunb/2022_11_25/Fhr0q3bX0AIZjXR.jpg"],
    ["id" => 3, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://pos.nvncdn.com/b0b717-26181/art/artCT/20221003_iKz3IVMmm8OPYN9Zq0SVfmMJ.jpg"],
    ["id" => 4, "brand" => "Adidas", "name" => "Jurassic Green Shirt", "price" => 47, "oldPrice" => 55.5, "discount" => "15%", "image" => "https://icdn.psgtalk.com/wp-content/uploads/2021/04/Kylian-Mbappe-warming-up-Strasbourg-vs-PSG-Ligue-1-2021.jpg"]
];
?>

<main style="padding-top: 76px;">
    <section class="py-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                    <li class="breadcrumb-item fw-bold">Chi tiết sản phẩm</li>
                    <li class="breadcrumb-item  fw-bold">Áo thể thao chống thấm hút mồ hôi</li>
                </ol>
            </nav>
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
                        foreach ($img_arr as $img) {
                            $content .= "
                        <div class='position-relative flex-grow-1' onclick='changeImage(this, \"$img\")'>
                            <div class='overplay position-absolute w-100 h-100 bg-light top-0 start-0 opacity-50'
                                style='cursor: pointer;'></div>
                            <img height='120' width='80' class='w-100'
                                src='$img'
                                alt=''>
                        </div>";
                        }
                        ?>
                        <?php echo $content ?>

                    </div>
                    <div style="width: 420px; height: 100%">
                        <img class="product-thumbnail fade-in w-100 h-100"
                            src="
                    https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(5).jpg" alt="">
                    </div>
                </div>
                <div class="col-7">
                    <h3 class="text-uppercase" style="font-weight: 500;">Áo thể thao chống thấm hút mồ hôi</h3>
                    <h6 style="font-weight: 200;" class="text-decoration-line-through text-black-50">2.500.000đ</h6>
                    <h4 style="font-weight: 200;" class="d-flex align-items-center gap-3">
                        2.000.000đ
                        <span class="bg-primary fw-bold fs-6 px-2 py-1 rounded text-white">-20%</span>
                    </h4>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Danh mục: </strong><span>Áo thể thao</span></span>
                        <span><strong>Thương hiệu: </strong><span>Khuyến Dương</span></span>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Màu sắc: </strong><span>Đen / Xanh</span></span>
                        <span><strong>Còn lại: </strong><span>1</span></span>
                    </div>
                    <div class="d-flex gap-3 mb-2">
                        <span><strong>Lượt xem: </strong><span>4532</span></span>
                        <span><strong>Lượt bán: </strong><span>1500</span></span>
                    </div>
                    <strong>Mô tả ngắn</strong>
                    <p style="line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus itaque
                        vitae
                        molestiae unde, nam dolorem
                        possimus nesciunt ut eum voluptates sequi id, voluptatibus quibusdam? Assumenda, harum!
                    </p>
                    <div class="d-flex gap-2 mb-3">
                        <button class="btn btn-sm border d-flex align-items-center gap-2">
                            <p class="m-0" style="width: 18px; height: 18px; background-color: black;"></p>
                            <span>Màu đen</span>
                        </button>
                        <button class="btn btn-sm border d-flex align-items-center gap-2">
                            <p class="m-0" style="width: 18px; height: 18px; background-color: red;"></p>
                            <span>Màu đỏ</span>
                        </button>
                    </div>
                    <div class="mb-3">
                        <select style="width: 200px;" class="form-select" aria-label="Default select example">
                            <option selected>Vui lòng chọn size</option>
                            <option value="1">Size S</option>
                            <option value="2">Size M</option>
                            <option value="3">Size L</option>
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
                <p style="line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente modi
                    harum
                    officiis nesciunt repellat
                    suscipit accusamus, ea excepturi qui, consequatur dicta laudantium error voluptatem, quidem hic.
                    Doloremque
                    nihil similique dolorum cupiditate voluptates omnis eveniet autem, exercitationem quisquam rerum
                    blanditiis
                    error quae enim sapiente officia distinctio beatae quo unde, cum asperiores a deleniti! Aperiam
                    doloribus
                    eveniet iure voluptatum inventore suscipit quasi dicta, odit minus in magnam eligendi consequatur
                    sapiente
                    ab doloremque, quibusdam qui dolore nulla, expedita sunt quo officiis ad laudantium? Eligendi libero
                    officiis exercitationem excepturi optio placeat dolorem dolor. Iste culpa at sed modi nesciunt iure
                    ad
                    laudantium illum molestiae ut tempore repudiandae, eaque qui atque. Adipisci quos facere nemo sed
                    tempora,
                    laboriosam cumque eveniet tenetur. Ratione error officiis consequuntur omnis vel in dolor unde illo
                    numquam
                    suscipit harum fugiat autem placeat impedit necessitatibus maiores est accusantium ipsum nisi eius,
                    eum
                    a
                    sed id. Enim quas, optio quaerat suscipit error eos autem ipsum neque libero repudiandae vero?
                    Nobis,
                    dolore
                    corporis ipsa laboriosam qui dolores commodi. Magnam dolores, vitae nobis ex soluta explicabo
                    voluptatibus
                    sapiente eveniet recusandae illum perspiciatis veritatis suscipit, placeat ab harum, ipsa tempore
                    deserunt
                    fugiat nulla? Error maiores laudantium sit temporibus ab nihil quod explicabo officiis placeat
                    doloribus?
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