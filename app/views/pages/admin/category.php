<div class="w-100">
    <div class="row">
        <div class="col-4">
            <h5 class="mb-3">Form nhập danh muc</h5>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="exampleFormControlInput1"
                    placeholder="Nhập tên danh mục tại đây">
            </div>
            <div class="mb-3 text-end">
                <button type="button" class="btn btn-primary">Thêm ngay</button>
            </div>
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
                                        <button class="btn btn-danger">Xóa</button>
                                        <button class="btn btn-primary">Sửa</button>
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