<div class="w-100">
    <div class="row">
        <div class="col-4">
            <h5 class="mb-3">Form nhập danh mục</h5>
            <form action="?controller=category&action=addCategory" method="POST">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                        placeholder="Nhập tên danh mục tại đây">
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" name="addCategory" class="btn btn-primary">Thêm ngay</button>
                </div>
            </form>
        </div>

        <div class="col-8">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Id danh mục</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Cập nhật lần cuối</th>
                        <th scope="col">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $content = '';
                        foreach ($category as $key => $danhmuc) {
                            $content .= '
                                <tr class="text-center">
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>
                                       '.$danhmuc['category_name'].'
                                    </td>
                                    <td>'.date('H:i:s d-m-Y', strtotime($danhmuc['created_at'])).'</td>
                                    <td>'.$danhmuc['updated_at'].'</td>
                                    <td>
                                        <a href="?controller=category&action=deleteCategory&category_id='.$danhmuc['category_id'].'" class="btn btn-danger">Xóa</a>
                                        <a href="?controller=category&action=updateCategory&category_id='.$danhmuc['category_id'].'" class="btn btn-primary">Sửa</a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                    <?php echo $content ?>
                </tbody>
            </table>
        </div>
    </div>
</div>