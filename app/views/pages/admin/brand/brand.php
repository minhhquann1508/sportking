<?php
require_once __DIR__ . '/../../../controller/BrandController.php';
$brandController = new BrandController();
$brands = $brandController->index();
?>

<div class="container mt-5">
    <div class="row">
        <!-- Form thêm thương hiệu -->
        <div class="col-4">
            <form id="brand-form" method="POST">
                <h5>Thêm Thương Hiệu</h5>
                <div class="mb-3">
                    <label>Tên thương hiệu:</label>
                    <input type="text" id="brand_name" name="brand_name" class="form-control" placeholder="Nhập tên thương hiệu">
                </div>
                <div class="mb-3">
                    <label>URL Hình ảnh:</label>
                    <input type="text" id="brand_thumbnail" name="brand_thumbnail" class="form-control" placeholder="Nhập URL hình ảnh">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Thêm ngay</button>
                </div>
            </form>
        </div>

        <!-- Bảng hiển thị thương hiệu -->
        <div class="col-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="brand-table">
                    <?php
                        $content = '';
                        foreach ($brands as $key => $brand) {
                            $content .= '
                                <tr class="text-center">
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>'.$brand['brand_name'].'</td>
                                    <td><img src="'.$brand['thumbnail'].'" width="100"></td>
                                    <td>
                                        <button class="btn btn-info update-brand" 
                                            data-id="'.$brand['brand_id'].'" 
                                            data-name="'.$brand['brand_name'].'" 
                                            data-thumbnail="'.$brand['thumbnail'].'">
                                            Sửa
                                        </button>
                                        <button class="btn btn-danger delete-brand" 
                                            data-id="'.$brand['brand_id'].'">
                                            Xóa
                                        </button>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                    <?php echo $content; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal chỉnh sửa thương hiệu -->
<div class="modal fade" id="updateBrandModal" tabindex="-1" aria-labelledby="updateBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateBrandModalLabel">Cập nhật Thương Hiệu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-brand-form">
                    <input type="hidden" id="update_brand_id">
                    <div class="mb-3">
                        <label>Tên thương hiệu:</label>
                        <input type="text" id="update_brand_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>URL Hình ảnh:</label>
                        <input type="text" id="update_brand_thumbnail" class="form-control">
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../../js/brand.js"></script>





<tbody id="brand-table">
                <?php
                        $content = '';
                        foreach ($brands as $key => $brand) {
                            $content .= '
                                <tr class="text-center">
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>
                                        <img class="mx-auto" width="200" height="100"
                                            src="'.$brand['img_url'].'"
                                            alt="">
                                    </td>
                                    <td><a target="_blank" href="'.$brand['url'].'">Link</a></td>
                                    <td>
                                        <button class="btn btn-danger">Xóa</button>
                                        <button class="btn btn-primary">Sửa</button>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                <?php echo $content ?>
            </tbody>