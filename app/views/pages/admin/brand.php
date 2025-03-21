
<div class="w-100"></div>
<div class="row">
    <form method="POST" class="col-4">
        <h5 class="mb-3">Form nhập thương hiệu</h5>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Tên thuơng hiệu </label>
            <input type="text" class="form-control" name="name_brand" id="exampleFormControlInput1" placeholder="Nhập đường dẫn tại đây">
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn phương thức nhập ảnh</label>
            <div>
                <input type="radio" id="urlOption" name="imageOption" checked>
                <label for="urlOption">Nhập URL</label>
                <input type="radio" id="fileOption" name="imageOption">
                <label for="fileOption">Tải lên tệp</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="imageUrl" class="form-label">Đường dẫn URL</label>
            <input type="text" class="form-control" name="hinh_anh" id="imageUrl" placeholder="Nhập URL hình ảnh">
        </div>

        <div class="mb-3">
            <label for="imageFile" class="form-label">Hình ảnh</label>
            <input class="form-control" type="file" name="hinh_anh" id="imageFile" disabled>
        </div>
        <div class="mb-3 text-end">
            <button type="button" name="add_brand" class="btn btn-primary">Thêm ngay</button>
        </div>
    </form>
   

    <div class="col-8">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">Id</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Đường dẫn</th>
                    <th scope="col">Tùy chọn</th>
                </tr>
            </thead>
            <tbody>
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
        </table>
    </div>
</div>
</div>


