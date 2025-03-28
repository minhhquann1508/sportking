<section class="py-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item fw-bold">Chi tiết sản phẩm</li>
                <li class="breadcrumb-item text-primary fw-bold">Áo thể thao chống thấm hút mồ hôi</li>
            </ol>
        </nav>
        <div class="row">
            <div class="col d-flex">
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
                <div style="width: 420px; height: 633.5px;">
                    <img class="product-thumbnail fade-in w-100 h-100"
                        src="
                    https://media3.coolmate.me/cdn-cgi/image/quality=80,format=auto/uploads/December2024/quan-dai-kaki-ecc-pants-xam_(5).jpg" alt="">
                </div>
            </div>
            <div class="col-7">
                <h3 class="text-uppercase" style="font-weight: 500;">Áo thể thao chống thấm hút mồ hôi</h3>
                <h4 style="font-weight: 200;">2.000.000đ</h4>
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
                <p style="line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus itaque vitae
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
            </div>
        </div>
        <div class="py-4">
            <h4>Mô tả chi tiết sản phẩm</h4>
            <p style="line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente modi harum
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
                officiis exercitationem excepturi optio placeat dolorem dolor. Iste culpa at sed modi nesciunt iure ad
                laudantium illum molestiae ut tempore repudiandae, eaque qui atque. Adipisci quos facere nemo sed
                tempora,
                laboriosam cumque eveniet tenetur. Ratione error officiis consequuntur omnis vel in dolor unde illo
                numquam
                suscipit harum fugiat autem placeat impedit necessitatibus maiores est accusantium ipsum nisi eius, eum
                a
                sed id. Enim quas, optio quaerat suscipit error eos autem ipsum neque libero repudiandae vero? Nobis,
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
        <div class="row">
            <div class="col-2 text-start pe-0 mt-1">
                <strong style="font-size: 14px;">
                    Nguyễn Minh Quân
                </strong>
                <br>
                <small>15/08/2025</small>
            </div>
            <div class="col-10 ps-0">
                <div class="flex">
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                </div>
                <small style="line-height: 1.6;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, accusantium. Veritatis delectus
                    cupiditate, corrupti laboriosam praesentium debitis architecto laudantium hic dolorum cum obcaecati
                    aperiam neque est nisi facilis excepturi nemo consequatur animi. Accusantium, vel debitis!
                    Dignissimos officia, quisquam placeat sequi commodi cumque dolorem laborum nam similique alias
                    eligendi fugiat fugit, blanditiis necessitatibus quia aspernatur vitae reiciendis delectus ut, ea id
                    Similique ullam eveniet distinctio dolor minima aliquam officiis voluptatem error exercitationem
                    temporibus, iure enim repudiandae?
                </small>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-2 text-start pe-0 mt-1">
                <strong style="font-size: 14px;">
                    Nguyễn Minh Quân
                </strong>
                <br>
                <small>15/08/2025</small>
            </div>
            <div class="col-10 ps-0">
                <div class="flex">
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                    <i class="fa-solid fa-star" style="font-size: 10px; color: orange"></i>
                </div>
                <small style="line-height: 1.6;">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi, accusantium. Veritatis delectus
                    cupiditate, corrupti laboriosam praesentium debitis architecto laudantium hic dolorum cum obcaecati
                    aperiam neque est nisi facilis excepturi nemo consequatur animi. Accusantium, vel debitis!
                    Dignissimos officia, quisquam placeat sequi commodi cumque dolorem laborum nam similique alias
                    eligendi fugiat fugit, blanditiis necessitatibus quia aspernatur vitae reiciendis delectus ut, ea id
                    Similique ullam eveniet distinctio dolor minima aliquam officiis voluptatem error exercitationem
                    temporibus, iure enim repudiandae?
                </small>
            </div>
        </div>
    </div>
</section>

<section class="py-4">
    <div class="container">
        <h4 class="text-center">Sản phẩm liên quan</h4>
    </div>
</section>

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