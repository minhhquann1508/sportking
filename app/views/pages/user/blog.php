<?php 
    function truncateContent($content, $limit = 100) {
        return mb_strlen($content) > $limit
            ? mb_substr($content, 0, $limit) . '...'
            : $content;
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
        .card img{
            border-radius: 10px;
        }
    </style>
<body>
    <div class="container-lg mt-4 py-5">
        <div class="row">
            <div class="col-lg-8 col-md-12">
            <?php if (!empty($blogList['data'])): ?>
                <?php foreach ($blogList['data'] as $blog): ?>
                <div class="card mb-4">
                    <img src="<?= $blog['thumbnail'] ?>" class="card-img-top w-100 h-auto" alt="...">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="me-2"><i class="fa-regular fa-calendar-minus"></i> <?= date("H:i d/m/y", strtotime($blog['created_at'])) ?></p>
                            <p class="me-2"><i class="fa-regular fa-circle-user"></i> <?= $blog['author_id'] ?></p>
                            <p class="me-2"><i class="fa-solid fa-eye"></i> <?= $blog['views'] ?></p>
                        </div>
                        <a class="card-title" style="font-size: 24px; font-weight: ;" href="?controller=home&action=blogdetail&id=<?= $blog['blog_id']?>" ><?= $blog['title'] ?></a>
                        <p class="card-text"><?= truncateContent($blog['content'], 100) ?>
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Sidebar -->

            <div class="col-lg-4 col-md-12">
                <div class="input-group mb-4">
                <form action="" method="GET" class="input-group mb-4">
                    <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm tin" value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
                </div>

                <div class="list-group mb-4">
                    <h5 class="mb-3">Các bài viết khác</h5>
                    <?php foreach ($blogRelated['data'] as $blog): ?>
                    <div class="d-flex align-items-center mb- border-bottom border-muted py-2">
                        <img src="<?= $blog['thumbnail'] ?>" class="me-2 w-25 h-auto rounded" alt="">
                        <a href="?controller=home&action=blogdetail&id=<?= $blog['blog_id']?>"><?= $blog['title'] ?></a>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="list-category p-2">
                    <h5 class="mb-3">Danh mục</h5>
                    <ul class="list-unstyled">
                    <?php foreach ($categories['data'] as $category): ?>
                        <li class="py-2"><a href="#"><?php echo $category['category_name']; ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                </div>

                <div class="list-key">
                    <h5 class="mt-4 py-2">Từ khóa nổi bật</h5>
                    <div class="d-flex flex-wrap gap-2 mt-2 py-2">
                        <span class="badge bg-light text-dark border">Thời Trang</span>
                        <span class="badge bg-light text-dark border">Sản Phẩm Mới</span>
                        <span class="badge bg-light text-dark border">Phong Cách</span>
                        <span class="badge bg-light text-dark border">Phụ Kiện</span>
                    </div>
                </div>
            </div>
        </div>  
    </div>
                    <?php else: ?>
                    <div class="col-12">
                        <h3 class="text-center">Không tìm thấy bài viết</h3>
                    </div>
                    <?php endif; ?>
</body>
