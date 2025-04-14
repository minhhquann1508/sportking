<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Danh sách sản phẩm</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm sản phẩm
    </button>
</div>
<div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold">Tên sản phẩm</th>
                <th scope="col" class="fw-bold text-center">Hình ảnh</th>
                <th scope="col" class="fw-bold text-center">Lượt bán</th>
                <th scope="col" class="fw-bold text-center">Lượt xem</th>
                <th scope="col" class="fw-bold text-center">Thương hiệu</th>
                <th scope="col" class="fw-bold text-center">Danh mục</th>
                <th scope="col" class="fw-bold text-center">Tuỳ chọn</th>
            </tr>
        </thead>
        <tbody id="table-body">
        </tbody>
    </table>
</div>
<!-- Add Modal -->
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

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Cập nhật sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Id sản phẩm</label>
                        <input disabled placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="product_id"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="updated_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input placeholder="Nhập mô tả ngắn" type="text" class="form-control" id="updated_subdesc"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt bán</label>
                                <input type="number" value="0" class="form-control" id="updated_solds"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt xem</label>
                                <input type="number" value="0" class="form-control" id="updated_views"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" aria-label="Default select example" id="updated_category">
                                <?php 
                                    foreach ($categories as $key => $category) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" aria-label="Default select example" id="updated_brand">
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
                        <textarea id="updated_editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="updated_thumbnail">
                        <div class="mt-1" style="width: 150px; display: none;">
                            <img class="w-100" height="150" style="object-fit: cover;" id="preview" src="" alt="">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="updated_is_public">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Hiện sản phẩm</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" id="update_btn" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xoá ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có chắc muốn xoá sản phẩm id: <span id="delete_product_id"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" id="delete_btn" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<script>
const submitBtn = $('#add_btn');
const deleteBtn = $('#delete_btn');
const updateBtn = $('#update_btn');

//add form input
const nameInput = $('#product_name');
const subDescInput = $('#subdesc');
const soldsInput = $('#solds');
const viewsInput = $('#views');
const categoryInput = $('#category');
const brandInput = $('#brand');
const descriptionInput = $('#editor');
const publicInput = $('#public');
const fileInput = $('#thumbnail');

// Updated form
const idInput = $('#product_id');
const nameInputUpdate = $('#updated_name');
const subDescInputUpdate = $('#updated_subdesc');
const soldsInputUpdate = $('#updated_solds');
const viewsInputUpdate = $('#updated_views');
const categoryInputUpdate = $('#updated_category');
const brandInputUpdate = $('#updated_brand');
const descriptionInputUpdate = $('#updated_editor');
const publicInputUpdate = $('#updated_is_public');
const fileInputUpdate = $('#updated_thumbnail');
const updatedThumbnail = $('#preview');
const setIdProduct = (id) => {
    document.getElementById('delete_product_id').textContent = id;
}

// Set product updated
const setUpdatedProduct = (id) => {
    $.ajax({
        url: `?controller=product&action=get_product_by_id&id=${id}`,
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            const product = response.data[0];
            idInput.val(product.product_id);
            nameInputUpdate.val(product.product_name);
            subDescInputUpdate.val(product.sub_desc);
            categoryInputUpdate.val(product.category_id);
            brandInputUpdate.val(product.brand_id);
            soldsInputUpdate.val(product.solds);
            viewsInputUpdate.val(product.views);
            descriptionInputUpdate[0]['data-froala.editor'].html.set(product.description);
            publicInputUpdate.prop('checked', product.is_public == 1);
            updatedThumbnail.attr('src', product.thumbnail);
        },
        error: (error) => {
            showToast(error.responseText);
        }
    })
}

// render list product function
const renderListProduct = (products) => {
    const html = products.map(product => {
        return `<tr>
            <td>${product.product_name}</td>
            <td class="text-center">
                <img width="35" height="35" src="${product.thumbnail}" alt="">
            </td>
            <td class="text-center">${product.solds}</td>
            <td class="text-center">${product.views}</td>
            <td class="text-center">${product.brand_name}</td>
            <td class="text-center">${product.category_name}</td>
            <td class="text-center">
                <button type="button" class="btn-sm btn-border"><a href="?controller=variant&product_id=${product.product_id}"><i class="fa-regular fa-object-group"></a></i></button>
                <button type="button" onclick="setUpdatedProduct('${product.product_id}')" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fa-regular fa-pen-to-square"></i></button>
                <button type="button" onclick="setIdProduct('${product.product_id}')" class="btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </td>
        </tr>`;
    })
    document.getElementById('table-body').innerHTML = html.join('');
}

// Fetch list product
$(document).ready(() => {
    const fetchListProducts = () => {
        $.ajax({
            url: "?controller=product&action=get_list_products",
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                renderListProduct(response.data);
            },
            error: (error) => {
                console.log(error.responseText);
            }
        })
    }
    fetchListProducts();

    // Add new product
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
                        fetchListProducts();
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

    //Delete product
    deleteBtn.click(() => {
        const id = $('#delete_product_id').text();
        $.ajax({
            url: `?controller=product&action=delete_product&id=${id}`,
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                $('#deleteModal').modal('hide');
                fetchListProducts();
                showToast(response.message);
            },
            error: (error) => {
                showToast(error.responseText);
            }
        })
    })
    // Update product
    updateBtn.click(async () => {
        const file = fileInputUpdate[0].files[0];
        const product = {
            product_name: nameInputUpdate.val(),
            sub_desc: subDescInputUpdate.val(),
            solds: soldsInputUpdate.val(),
            views: viewsInputUpdate.val(),
            category_id: categoryInputUpdate.val(),
            brand_id: brandInputUpdate.val(),
            description: descriptionInputUpdate.val(),
            is_public: publicInputUpdate.is(':checked') ? 1 : 0,
        }
        if (file) {
            // Nếu có file thì upload
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "chovybe_present");
            formData.append("cloud_name", "dtdkm7cjl");
            const cloudinaryResponse = await $.ajax({
                url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                method: "POST",
                data: formData,
                processData: false,
                contentType: false
            });
            product.thumbnail = cloudinaryResponse.secure_url;
        } else {
            // Nếu không có file thì cập nhật thường
            product.thumbnail = updatedThumbnail.attr('src') || null;
        }

        const id = idInput.val();

        $.ajax({
            url: '?controller=product&action=update_product_by_id',
            method: 'POST',
            dataType: 'json',
            data: {
                product_id: id,
                product
            },
            success: (response) => {
                $('#updateModal').modal('hide');
                fetchListProducts();
                showToast(response.message)
            },
            error: (error) => {
                showToast(error.responseText)
            }
        })
    })
})
</script>