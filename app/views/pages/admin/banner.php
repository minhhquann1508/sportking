<div class="w-100"></div>
<div class="row">
    <div class="col-4">
        <h5 class="mb-3">Form nhập banner</h5>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Đường dẫn URL</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Nhập đường dẫn tại đây">
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
            <input type="text" class="form-control" id="imageUrl" placeholder="Nhập URL hình ảnh">
        </div>

        <div class="mb-3">
            <label for="imageFile" class="form-label">Hình ảnh</label>
            <input class="form-control" type="file" id="imageFile" disabled>
        </div>
        <div class="mb-3 text-end">
            <button type="button" class="btn btn-primary">Thêm ngay</button>
        </div>
    </div>

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
                        foreach ($banners as $key => $banner) {
                            $content .= '
                                <tr class="text-center">
                                    <th scope="row">'.($key + 1).'</th>
                                    <td>
                                        <img class="mx-auto" width="200" height="100"
                                            src="'.$banner['img_url'].'"
                                            alt="">
                                    </td>
                                    <td><a target="_blank" href="'.$banner['url'].'">Link</a></td>
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

<script>
// Lấy các phần tử
const urlOption = document.getElementById("urlOption");
const fileOption = document.getElementById("fileOption");
const imageUrl = document.getElementById("imageUrl");
const imageFile = document.getElementById("imageFile");
const previewImage = document.getElementById("previewImage");

// Chọn phương thức nhập ảnh
urlOption.addEventListener("change", () => {
    imageUrl.disabled = false;
    imageFile.disabled = true;
    imageFile.value = "";
    previewImage.classList.add("d-none");
});

fileOption.addEventListener("change", () => {
    imageUrl.disabled = true;
    imageFile.disabled = false;
    imageUrl.value = "";
    previewImage.classList.add("d-none");
});

// Xem trước hình ảnh từ URL
imageUrl.addEventListener("input", () => {
    if (imageUrl.value.trim() !== "") {
        previewImage.src = imageUrl.value;
        previewImage.classList.remove("d-none");
    } else {
        previewImage.classList.add("d-none");
    }
});

// Xem trước hình ảnh từ file
imageFile.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    }
});
</script>