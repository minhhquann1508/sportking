<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<?php
require_once '../app/models/Comment.php';
$commentModel = new Comment();
$data['comments'] = $commentModel->get_comment_by_product_id($product_detail['data'][0]['product_id']);
?>
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

    .product_view_info p {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    p {
        padding: 0;
        margin: 0;
    }

    .left-container {
        min-width: 500px;
        max-width: 500px;
        max-height: 800px;
        background-color: white;
        z-index: 100
    }

    @media (max-width: 1400px) {
        .left-container {
            max-width: 400px;
            min-width: 400px;
        }
    }

    @media (max-width: 600px) {
        .body {
            background-color: white;
        }

        .detail_section {
            padding: 0 !important;
        }

        .breadcrumb {
            display: none !important;
        }

        .left-container {
            min-width: 100vw;
            max-width: 100vw;
        }

        .right-container {
            display: none !important;
        }

        .container {
            max-width: 100vw;
            padding: 0 !important;
            margin: 0 !important;
        }

        .comment_container {
            display: none !important;
        }

        .detail_mobile {
            display: none !important;
        }
    }
</style>

<main style="padding-top: 76px;background-color:#f0f0f0">
    <section class="detail_section py-4">
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
                <div class="p-4 left-container rounded-3 position-sticky sticky-top">
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
                                    <div class="position-relative" onclick="changeImage(this, '<?= $img ?>')"
                                        style="height:84px;width:84px">
                                        <div class="small_img overplay position-absolute w-100 h-100 bg-light top-0 start-0 opacity-50"
                                            style="cursor: pointer;"></div>
                                        <img height="84" width="84" style="object-fit: contain;" src="<?= $img ?>" alt="">
                                    </div>
                                <?php elseif ($i === $max_thumbnail_img):
                                    $hidden_count = $total_img - $max_thumbnail_img;
                                ?>
                                    <button type="button" class="d-flex align-items-center justify-content-center border-0"
                                        style="background:#818181;width:84px;height:84px" data-bs-toggle="modal"
                                        data-bs-target="#moreImagesModal">
                                        <p class="fw-bold m-0" style="color:white">+<?= $hidden_count ?></p>
                                    </button>
                                    <?php break; ?>
                            <?php endif;
                                $i++;
                            endforeach; ?>
                        </div>
                    </div>
                    <div class="detail_mobile mt-4">
                        <p class="fw-bold" style="font-size: 16px;">Chính sách ưu đãi của Sportking</p>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_truck_v2.png" alt=""
                                    width="18">
                                <p class="m-auto  fw-bold" style="font-size: 14px;">Thời gian giao hàng:</p>
                                <p class="m-auto" style=" font-size: 14px;">Giao hàng nhanh và uy tín</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 justify-content-between mt-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_transfer_v2.png" alt=""
                                    width="18">
                                <p class="m-auto fw-bold" style="font-size: 14px;">Chính sách đổi trả:</p>
                                <p class="m-auto" style="font-size: 14px;">Đổi trả miễn phí toàn quốc</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                        <div class="d-flex align-items-center gap-2 justify-content-between mt-2">
                            <div class="d-flex align-items-center gap-2">
                                <img src="https://cdn0.fahasa.com/media/wysiwyg/icon-menu/ico_shop_v2.png" alt=""
                                    width="18">
                                <p class="m-auto fw-bold" style="font-size: 14px;">Chính sách khách sỉ:</p>
                                <p class="m-auto" style="font-size: 14px;">Ưu đãi khi mua số lượng lớn</p>
                            </div>
                            <div><i class="fa-solid fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <!-- Modal Thumbnail -->
                <div class="modal fade" id="moreImagesModal" tabindex="-1" aria-labelledby="moreImagesLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content p-3">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Đóng"></button>
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

                <div class="right-container w-100">
                    <div class="p-4 rounded-3" style="background-color: white;">
                        <p class="text-uppercase fw-bold" style="font-size: 23px;">
                            <?php echo $variant_detail['data'][0]['product_name'] ?></p>
                        </p>
                        <p class="mt-2"><?php echo $variant_detail['data'][0]['sub_desc'] ?>
                        </p>
                        <div class="d-flex gap-3 mt-3">
                            <p style="font-size: 14px;">Danh mục:</p>
                            <span class="fw-bolder"
                                style="font-size: 14px;font-size: bold;"><?php echo $variant_detail['data'][0]['category']['category_name']; ?></span>
                            <p style="font-size: 14px;">Thương hiệu:</p>
                            <span class="fw-bolder"
                                style="font-size: 14px;font-size: bold;"><?php echo $variant_detail['data'][0]['brand']['brand_name'] ?></span>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-2">
                            <div class="d-flex">
                                <?php
                                $total_rating = 0;
                                $total_comments = isset($data['comments']['data']) && is_array($data['comments']['data'])
                                    ? count($data['comments']['data'])
                                    : 0;

                                $rating_count = array_fill(1, 5, 0);

                                if ($total_comments > 0) {
                                    foreach ($data['comments']['data'] as $comment) {
                                        $rating = intval($comment['rating']);
                                        $total_rating += $rating;
                                        $rating_count[$rating]++;
                                    }
                                }

                                $average_rating = $total_comments > 0 ? $total_rating / $total_comments : 0;
                                $average_rating_rounded = round($average_rating, 1);

                                $percentages = [];
                                for ($i = 5; $i >= 1; $i--) {
                                    $percentages[$i] = isset($rating_count[$i]) && $total_comments > 0
                                        ? ($rating_count[$i] / $total_comments) * 100
                                        : 0;
                                }

                                $fullStars = floor($average_rating);
                                $halfStar = ($average_rating - $fullStars) >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $fullStars - $halfStar;

                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<span style="color: #F39801;font-size:18px">★</span>';
                                }
                                if ($halfStar) {
                                    echo '<span style="color: #F39801;font-size:18px">☆</span>';
                                }
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<span style="color: gray;font-size:18px">★</span>';
                                }

                                ?>
                            </div>
                            <p style="color: #F39801;font-size:14px">( <?= $total_comments ?> đánh giá )</p>
                            <span class="mx-2" style="color:grey">|</span>
                            <p style="font-size:14px">Đã bán <span
                                    style="color:#212121"><?php echo $variant_detail['data'][0]['solds'] ?></span></p>
                        </div>
                        <p style="font-size: 32px;font-weight: 900;color:#C92127" id="price">
                            <?php echo number_format($variant_detail['data'][0]['price'], 0, ',', '.') ?>
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
                                        <p class="m-0"
                                            style="width: 18px; height: 18px; background-color: <?= $color['color_hex'] ?>; border-radius: 50%;">
                                        </p>
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
                                    <button class="btn size-btn <?= $isActive ?>" data-size-id="<?= $size_id ?>"
                                        <?= $isDisabled ?>><?= $size['size_name'] ?></button>
                                <?php endforeach; ?>
                            </div>
                        </div>


                        <!-- Quantity control -->
                        <div class="d-flex align-items-center gap-4 mt-4">
                            <p style="font-size: 18px">Số lượng</p>
                            <div class="d-flex align-items-center border rounded"
                                style="width: fit-content;margin-left:15px">
                                <button class="btn border-end" onclick="handleChangeQuantity(false)">-</button>
                                <span id="quantity" class="mx-3">1</span>
                                <button class="btn border-start" onclick="handleChangeQuantity(true)">+</button>
                            </div>
                            <div style="font-size: 14px" id="stock-info"></div>
                            <input id="stock" type="hidden" />
                        </div>
                        <div class="d-flex my-4 gap-3">
                            <div class="">
                                <button
                                    style="background: #BD844C;color:white;border-radius:0;font-weight:700;;padding:8px 15px"
                                    class="btn border w-100" id="add-btn">Thêm vào giỏ hàng</button>
                            </div>
                            <div class="">
                                <button
                                    style="background: black;color:white;border-radius:0;font-weight:700;;padding:8px 40px"
                                    class="btn border w-100">Mua ngay</button>
                            </div>
                        </div>
                    </div>


                    <div class="rounded px-3 mt-3 pt-2 pb-2 w-100" style="background:white">
                        <p class="fw-bold" style="font-size: 18px;">Thông tin vận chuyển</p>
                        <div class="product_view_info mt-4">
                            <div class="d-flex">
                                <div class="d-flex flex-column text-m" style="color: #777777;width:200px;font-size:14px">
                                    <p>Mã hàng</p>
                                    <p>Tên Nhà Cung Cấp</p>
                                    <p>NXB</p>
                                    <p>Năm XB</p>
                                    <p>Sản phẩm hiển thị trong</p>
                                    <p>Sản phẩm bán chạy nhất</p>
                                </div>

                                <div class="d-flex flex-column text-m" style="width: 500px;font-size:14px">
                                    <p><?php echo $product_detail['data'][0]['product_id'] ?></p>
                                    <p><?php echo $product_detail['data'][0]['brand_name'] ?></p>
                                    <p>Sportking</p>
                                    <p>2025</p>
                                    <p>2025</p>
                                    <p>Top 100 sản phẩm bán chạy của tháng</p>
                                </div>
                            </div>
                        </div>
                        <p style="font-size:14px" class="mt-4">Giá sản phẩm trên Sportking đã bao gồm thuế theo luật hiện hành. Bên cạnh đó, tuỳ vào loại sản phẩm, hình thức và địa chỉ giao hàng mà có thể phát sinh thêm chi phí khác như Phụ phí đóng gói, phí vận chuyển, phụ phí hàng cồng kềnh,...</p>
                        <p style="font-size:14px;color:#C92127">Chính sách khuyến mãi trên Sportking.com không áp dụng cho Hệ thống Sportking trên toàn quốc</p>
                    </div>

                    <div class="rounded px-3 mt-3 pt-2 pb-4 w-100" style="background:white">
                        <p class="fw-bold" style="font-size: 18px;">Mô tả sản phẩm</p>
                        <p style="font-size:14px"><?php echo $product_detail['data'][0]['description'] ?></p>

                    </div>
                </div>
            </div>

            <!-- reviews && comments -->
            <div class="comment_container container pt-2 mt-3 rounded" style="background-color:white">
                <p class="fw-bold" style="font-size: 18px;">Đánh giá sản phẩm</p>
                <div class="d-flex">
                    <div class="d-flex">
                        <div class="rating-average text-center p-3">
                            <p class="text-center" style="font-size:38px;font-weight:600;width: 150px;"><?php echo $average_rating_rounded; ?><span style="font-size:24px">/5</span></p>
                            <div class="stars" style="color: #F6A500; font-size: 18px;">
                                <?php
                                for ($i = 0; $i < $fullStars; $i++) {
                                    echo '<span style="color: #F6A500;font-size:20px">★</span>'; // Sao vàng
                                }
                                if ($halfStar) {
                                    echo '<span style="color: #F6A500;font-size:20px">☆</span>'; // Sao nửa
                                }
                                for ($i = 0; $i < $emptyStars; $i++) {
                                    echo '<span style="color: #f2f4f5;font-size:20px">★</span>'; // Sao xám
                                }
                                ?>
                            </div>
                            <p class="text-m" style="color:#7a7e7f">(<?php echo $total_comments; ?> reviews)</p>
                        </div>
                        <div class="rating-breakdown mt-2" style="width: 350px;">
                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span style="font-size: 14px;"><?php echo $i; ?> sao</span>
                                    <div class="rating-bar" style="width:250px">
                                        <div class="bar flex-grow-1 rounded" style="height: 5px; background-color: #f2f4f5;position: relative;">
                                            <div class="fill rounded" style="height: 100%; background-color: #F6A500; width: <?php echo ($total_comments > 0) ? ($rating_count[$i] / $total_comments) * 100 : 0; ?>%;"></div>
                                        </div>
                                    </div>
                                    <span class="text-m"><?php echo ($total_comments > 0) ? number_format(($rating_count[$i] / $total_comments) * 100, 1) : 0; ?>%</span>
                                </div>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-center w-100">
                        <!-- Nút Write reviews -->
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#reviewModal">
                            <button class="d-flex gap-2 justify-content-center align-items-center border-0"
                                style="background: #BD844C; color:white; border-radius:0; font-weight:700; padding:10px 20px">
                                <i class="fa-solid fa-pen"></i>
                                Viết đánh giá
                            </button>
                        </a>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="reviewModalLabel">Write a Review</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="review-form">
                                        <div class="mb-3">
                                            <label class="form-label">Rating</label>
                                            <div class="d-flex gap-4" id="rating-buttons">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rating-1" value="1">
                                                    <label class="form-check-label" for="rating-1">1</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rating-2" value="2">
                                                    <label class="form-check-label" for="rating-2">2</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rating-3" value="3">
                                                    <label class="form-check-label" for="rating-3">3</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rating-4" value="4">
                                                    <label class="form-check-label" for="rating-4">4</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="rating-5" value="5">
                                                    <label class="form-check-label" for="rating-5">5</label>
                                                </div>
                                            </div>
                                            <input type="hidden" id="rating" name="rating" value="0" />
                                        </div>

                                        <div class="mb-3">
                                            <label for="review-content" class="form-label">Review</label>
                                            <textarea id="review-content" name="content" class="form-control" rows="4" placeholder="Write your review here"></textarea>
                                        </div>

                                        <button type="submit" class="btn border-0 w-100" style="background-color: #BD844C; color: white;">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-3"></div>
                <hr>
                <div class="pt-3"></div>
                <p style="font-size:18px;font-weight:800"><?= $total_comments ?> đánh giá</p>

                <div id="comments-container">
                    <div class="px-0 pb-2">
                        <?php if (isset($data['comments']['data']) && is_array($data['comments']['data']) && count($data['comments']['data']) > 0) : ?>
                            <?php foreach ($data['comments']['data'] as $value) : ?>
                                <div class="d-flex mt-3 mb-3 gap-5">
                                    <div class="me-3 mt-2" style="min-width:170px">
                                        <p style="color:#212121;font-size:14px;font-weight:semi-bold">
                                            <?= htmlspecialchars($value['email']) ?>
                                        </p>
                                        <p style="color:#7a7e7f;font-size:14px">
                                            <?= date('d/m/Y H:i', strtotime($value['create_at'])) ?>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="mt-1">
                                            <?php
                                            $fullStars = intval($value['rating']);
                                            $emptyStars = 5 - $fullStars;

                                            for ($i = 0; $i < $fullStars; $i++) {
                                                echo '<span style="color: #F6A500; font-size:20px">★</span>';
                                            }
                                            for ($i = 0; $i < $emptyStars; $i++) {
                                                echo '<span style="color: #f2f4f5; font-size:20px">★</span>';
                                            }
                                            ?>
                                        </p>
                                        <p class="mt-2" style="font-size:14px">
                                            <?= nl2br(htmlspecialchars($value['content'])) ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-muted">Chưa có đánh giá nào cho sản phẩm này.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

    </section>


    <section class="py-4">
        <div class="container">
            <h4 class="text-center mb-3">Sản phẩm liên quan</h4>
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
    // Đảm bảo chỉ chọn 1 checkbox và cập nhật giá trị rating
    $('#rating-buttons input[type="checkbox"]').on('change', function() {
        $('#rating-buttons input[type="checkbox"]').not(this).prop('checked', false);
        if ($(this).is(':checked')) {
            $('#rating').val($(this).val());
        } else {
            $('#rating').val('');
        }
    });

    // Submit form đánh giá
    $('#review-form').submit((e) => {
        e.preventDefault();

        const rating = $('#rating').val();
        const content = $('#review-content').val().trim();
        const user_id = <?= json_encode($_SESSION['user']['user_id'] ?? null) ?>;
        const urlParams = new URLSearchParams(window.location.search);
        const product_id = urlParams.get('product_id');

        if (!rating || !content) {
            alert('Vui lòng nhập đầy đủ thông tin.');
            return;
        }

        $.ajax({
            url: '?controller=home&action=add_comment',
            method: 'POST',
            dataType: 'json',
            data: {
                product_id,
                rating,
                content,
                user_id
            },
            success: (res) => {
                if (res.success) {
                    showToast('Thêm đánh giá thành công!');
                    $('#reviewModal').modal('hide');

                    setTimeout(() => {
                        location.reload();
                    }, 500);
                } else {
                    showToast('Thêm đánh giá thất bại.');
                }
            },
            error: (err) => {
                console.log(err);
                showToast('Lỗi khi gửi đánh giá.');
            }
        });
    });
</script>