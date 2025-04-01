<div class="d-flex justify-content-between align-items-center">
    <h6>Danh sách sản phẩm</h6>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm sản phẩm
    </button>
</div>
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm sản phẩm mới</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="product_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input placeholder="Nhập mô tả ngắn" type="text" class="form-control" id="subdesc"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="thumbnail">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt bán</label>
                                <input type="number" value="0" class="form-control" id="solds"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt xem</label>
                                <input type="number" value="0" class="form-control" id="views"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" aria-label="Default select example" id="category">
                                <?php 
                                    foreach ($categories as $key => $category) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" aria-label="Default select example" id="brand">
                                <?php 
                                    foreach ($brands as $key => $brand) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$brand['brand_id'].'">
                                            '.$brand['brand_name'].'
                                            </option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 p-0">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea id="editor"></textarea>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_public" checked>
                        <label class="form-check-label" for="flexSwitchCheckChecked">Hiện sản phẩm</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" id="add_btn" class="btn btn-primary">Thêm ngay</button>
            </div>
        </div>
    </div>
</div>

<script>
const submitBtn = $('#add_btn');
const nameInput = $('#product_name');
const subDescInput = $('#subdesc');
const soldsInput = $('#solds');
const viewsInput = $('#views');
const categoryInput = $('#category');
const brandInput = $('#brand');
const descriptionInput = $('#editor');
const publicInput = $('#public');
const fileInput = $('#thumbnail');
submitBtn.click(() => {
    const file = fileInput[0].files[0];
    const formData = new FormData();
    formData.append("file", file);
    formData.append("upload_preset", "chovybe_present");
    formData.append("cloud_name", "dtdkm7cjl");
    $.ajax({
        url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: (cloudinaryResponse) => {
            const imageUrl = cloudinaryResponse.secure_url;
            const product = {
                product_name: nameInput.val(),
                sub_desc: subDescInput.val(),
                solds: soldsInput.val(),
                views: viewsInput.val(),
                category_id: categoryInput.val(),
                brand_id: brandInput.val(),
                description: descriptionInput.val(),
                is_public: publicInput.is(':checked') ? 1 : 0,
                thumbnail: imageUrl
            }
            $.ajax({
                url: "?controller=product&action=add_product",
                method: "POST",
                dataType: "json",
                data: product,
                success: (response) => {
                    nameInput.val('');
                    subDescInput.val('');
                    soldsInput.val(0);
                    viewsInput.val(0);
                    descriptionInput.val('');
                    publicInput.prop('checked', false);
                    fileInput.val('');
                    $('#addModal').modal('hide');
                    showToast(response.message)
                },
                error: (error) => {
                    showToast(error.responseText)
                }
            })
        },
        error: (error) => {
            showToast("Lỗi khi upload ảnh lên Cloudinary!");
        }
    })

})
</script>