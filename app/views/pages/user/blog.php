<?php
function limitWords($content, $word_limit = 30) {
    // Cắt chuỗi thành mảng các từ
    $words = explode(' ', $content);
    
    // Nếu số từ trong chuỗi nhiều hơn giới hạn, cắt bớt và nối lại
    if (count($words) > $word_limit) {
        $words = array_slice($words, 0, $word_limit);
        $content = implode(' ', $words) . '...';
    }

    return $content;
}
?>
<style>
    .list-group-item {
        border-bottom: 1px solid #ddd;
        border-left: none;
        border-right: none;
        border-top: none;
    }

    .card {
        border-bottom: 1px solid #ddd;
        border-left: none;
        border-right: none;
        border-top: none;
        border-radius: 0px;
    }

    .card img {
        border-radius: 10px;
    }

    .list-category ul li a {
        text-decoration: none;
        color: #333;
    }

    .list-category ul li a:hover {
        color: #007bff;
    }
    .wrapper{
        display: flex;
    }
</style>
<div class="container mt-5 py-5">
    <div class="row">
        <!-- Cột trái: danh sách bài viết -->
        <div class="col-8">
            <?php foreach($blogs['data'] as $blog): ?>
                <div class="box">
                    <div class="img ">
                        <img src="<?= $blog['thumbnail'] ?>" class="img-fluid rounded-start" alt="<?= $blog['title'] ?>">
                    </div>
                    <div class="content-blog  p-3">
                        <p class="mb-1 text-muted">
                            <i class="bi bi-calendar3"></i> <?= date("H:i d/m/y", strtotime($blog['created_at'])) ?>
                            <i class="bi bi-person-fill ms-3"></i> <?= $blog['author_id'] ?>
                            <i class="fa-solid fa-eye ms-3"></i> <?= $blog['views'] ?>
                        </p>
                        <a class="fw-bold text-dark fs-5" href="?controller=home&action=blogdetail&id=<?= $blog['blog_id'] ?>">
                            <?= $blog['title'] ?>
                        </a>
                        <p class="limit-content">
    <?= limitWords(strip_tags($blog['content']), 30) ?>
</p>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Cột phải: sidebar -->
        <div class="col-4">
            <!-- Form tìm kiếm -->
            <form class="input-group mb-4" method="GET">
                <input type="text" name="keyword" class="form-control" placeholder="Tìm kiếm tin" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>

            <!-- Các bài viết khác -->
            <div class="list-group mb-4">
                <h5 class="mb-3">Các bài viết khác</h5>
                <?php foreach ($blogRelated['data'] as $blog): ?>
                    <div class="d-flex align-items-center border-bottom py-2">
                        <img src="<?= $blog['thumbnail'] ?>" class="me-2 w-25 rounded" alt="">
                        <a href="?controller=home&action=blogdetail&id=<?= $blog['blog_id'] ?>"><?= $blog['title'] ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Danh mục -->
            <div class="list-category mb-4">
                <h5>Danh mục</h5>
                <ul class="list-unstyled">
                    <?php foreach ($categories as $category): ?>
                        <li class="py-1"><a href="#" class="text-dark text-decoration-none"><?= $category['category_name'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Từ khóa -->
            <div class="list-key">
                <h5 class="mb-2">Từ khóa nổi bật</h5>
                <div class="d-flex flex-wrap gap-2">
                    <span class="badge bg-light text-dark border">Thời Trang</span>
                    <span class="badge bg-light text-dark border">Sản Phẩm Mới</span>
                    <span class="badge bg-light text-dark border">Phong Cách</span>
                    <span class="badge bg-light text-dark border">Phụ Kiện</span>
                </div>
            </div>
        </div>
    </div>
</div>


