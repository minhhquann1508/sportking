<?php include '../app/views/layouts/_list_product.php' ?>
<?php include '../app/views/layouts/_list_product_cssfile.php' ?>
<style>
  .article-img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    display: block;
  }
  .sticky-sidebar {
    position: sticky;
    top: 1rem;
  }
  .article-meta {
    font-size: 0.875rem;
    color: #6c757d;
  }
  .content{
    /* overflow: hidden; */
    width: 100%;
  }
  .content img {
    width: 100%;
    height: auto;
    margin-bottom: 1rem;
    border-radius: 5px;
  }
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

</style>
  <div class="container mt-5 py-5">
    <div class="row">
      <!-- Nội dung chính -->
      <div class="col-8">
            <div class="blog-item mb-5">
              <h2 class="fw-bold"><?= $blogDetail['title'] ?></h2>
              <div class="article-meta mb-2">
                <i class="bi bi-calendar-event"></i> <?= $blogDetail['created_at'] ?> &nbsp; | &nbsp;
                <i class="bi bi-person"></i> <?= $blogDetail['fullname'] ?>
              </div>
              <div class="content" style="width: 100%;">
                <img src="<?= $blogDetail['thumbnail'] ?>" alt="" class="article-img" />
                <?= nl2br(html_entity_decode($blogDetail['content'])) ?>


              </div>
            </div>
      </div>

      <!-- Sidebar -->
      <div class="col-4">
        <div class="input-group mb-4">
          <form action="" method="post" class="d-flex align-items-center custom-search-form mb-4" style="width: 100%">
          <input type="text" name="noidung" class="form-control border-1" placeholder="Tìm kiếm tin tức">
          <button class="btn btn-primary rounded-0  bg-primary" name="btn-search" type="submit">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
          </form>
        </div>

        <div class="list-group mb-4">
          <h5 class="mb-3">Các bài viết khác</h5>
          <?php foreach ($blogRelated['data'] as $blog): ?>
            <div class="d-flex align-items-center mb-2 border-bottom border-muted py-2">
              <img src="<?= $blog['thumbnail'] ?>" class="me-2 w-25 h-auto rounded" alt="">
              <a href="#"><?= $blog['title'] ?></a>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="list-category p-2">
          <h5 class="mb-3">Danh mục</h5>
          <ul class="list-unstyled">
            <?php foreach ($categories as $category): ?>
              <li class="py-2"><a href="#"><?= $category['category_name']; ?></a></li>
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

    <div class="container splq">
      <h4 class="text-center">Sản phẩm liên quan</h4>
      <?php render_list_product($productList); ?>
    </div>

  </div>