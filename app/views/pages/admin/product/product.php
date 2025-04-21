<div class="d-flex justify-content-between align-items-center">
    <h5>Danh sách sản phẩm</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm sản phẩm
    </button>
</div>
<form class="row g-3 align-items-end mt-2 mb-3">
    <!-- Tên sản phẩm -->
    <div class="col-md-4">
        <input type="text" class="form-control" id="search_name" placeholder="Nhập tên sản phẩm">
    </div>

    <!-- Danh mục -->
    <div class="col-md-3">
        <select id="search_category" class="form-select">
            <option value="">Tất cả danh mục</option>
            <?php 
                foreach ($categories as $category) {
                    echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                }
            ?>
        </select>
    </div>

    <!-- Thương hiệu -->
    <div class="col-md-3">
        <select id="search_brand" class="form-select">
            <option value="">Tất cả thương hiệu</option>
            <?php 
                foreach ($brands as $brand) {
                    echo '<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                }
            ?>
        </select>
    </div>

    <!-- Nút tìm kiếm -->
    <div class="col-md-2 d-grid">
        <button type="submit" id="search_btn" class="btn btn-primary">Tìm kiếm</button>
    </div>
</form>
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
    <div class="d-flex justify-content-center">
        <div id="pagination"></div>
    </div>
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
                        <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="product_name">
                        <div class="text-danger error-message" id="error-name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input placeholder="Nhập mô tả ngắn" type="text" class="form-control" id="subdesc">
                        <div class="text-danger error-message" id="error-subdesc"></div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="thumbnail">
                        <div class="text-danger error-message" id="error-thumbnail"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Lượt bán</label>
                            <input type="number" value="0" class="form-control" id="solds">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Lượt xem</label>
                            <input type="number" value="0" class="form-control" id="views">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" id="category">
                                <?php 
                                    foreach ($categories as $key => $category) {
                                        echo '<option value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="text-danger error-message" id="error-category"></div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" id="brand">
                                <?php 
                                    foreach ($brands as $key => $brand) {
                                        echo '<option value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                                    }
                                ?>
                            </select>
                            <div class="text-danger error-message" id="error-brand"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea id="editor"></textarea>
                        <div class="text-danger error-message" id="error-description"></div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_public" checked>
                        <label class="form-check-label" for="is_public">Hiện sản phẩm</label>
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
                        <input disabled placeholder="Nhập tên sản phẩm" type="text" class="form-control"
                            id="product_id">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input placeholder="Nhập tên sản phẩm" type="text" class="form-control" id="updated_name">
                        <div class="text-danger mt-1" id="error_name" style="display: none;">Tên sản phẩm không được để
                            trống</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả ngắn</label>
                        <input placeholder="Nhập mô tả ngắn" type="text" class="form-control" id="updated_subdesc">
                        <div class="text-danger mt-1" id="error_subdesc" style="display: none;">Mô tả ngắn không được để
                            trống</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt bán</label>
                                <input type="number" value="0" class="form-control" id="updated_solds">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Lượt xem</label>
                                <input type="number" value="0" class="form-control" id="updated_views">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" id="updated_category">
                                <?php 
                                    foreach ($categories as $key => $category) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" id="updated_brand">
                                <?php 
                                    foreach ($brands as $key => $brand) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$brand['brand_id'].'">'.$brand['brand_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3 p-0">
                        <label class="form-label">Mô tả chi tiết</label>
                        <textarea id="updated_editor"></textarea>
                        <div class="text-danger mt-1" id="error_detail" style="display: none;">Mô tả chi tiết không được
                            để trống</div>
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
    let html = '';

    if (!products || products.length === 0) {
        html = `<tr>
                    <td colspan="7" class="text-center text-muted">Không có sản phẩm nào</td>
                </tr>`;
    } else {
        html = products.map(product => {
            return `<tr>
                <td style="width: 350px">${product.product_name}</td>
                <td class="text-center">
                    <img style="object-fit: contain" width="35" height="35" src="${product.thumbnail}" alt="">
                </td>
                <td class="text-center">${product.solds}</td>
                <td class="text-center">${product.views}</td>
                <td class="text-center">${product.brand_name}</td>
                <td class="text-center">${product.category_name}</td>
                <td class="text-center">
                    <button type="button" class="btn-sm btn-border">
                        <a href="?controller=variant&product_id=${product.product_id}">
                            <i class="fa-regular fa-object-group"></i>
                        </a>
                    </button>
                    <button type="button" onclick="setUpdatedProduct('${product.product_id}')" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" onclick="setIdProduct('${product.product_id}')" class="btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>`;
        }).join('');
    }
    document.getElementById('table-body').innerHTML = html;
}

// Fetch list product
$(document).ready(() => {
    const fetchListProducts = () => {
        const page = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;

        $.ajax({
            url: `?controller=product&action=get_list_products&page=${page}`,
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                renderListProduct(response.data);
                if (response.pagination) {
                    renderPagination(page, response.pagination.total);
                }
            },
            error: (error) => {
                console.log(error.responseText);
            }
        })
    }
    fetchListProducts();

    // Add new product
    submitBtn.click(() => {
        // Reset lỗi trước
        $('.error-message').text('');

        const file = fileInput[0].files[0];
        const name = nameInput.val().trim();
        const subDesc = subDescInput.val().trim();
        const description = descriptionInput[0]['data-froala.editor'].html.get().trim();
        const solds = soldsInput.val();
        const views = viewsInput.val();
        const category = categoryInput.val();
        const brand = brandInput.val();

        let isValid = true;

        if (!name) {
            $('#error-name').text("Tên sản phẩm không được để trống!");
            isValid = false;
        }
        if (!subDesc) {
            $('#error-subdesc').text("Mô tả ngắn không được để trống!");
            isValid = false;
        }
        if (!description || description === "<p><br></p>") {
            $('#error-description').text("Mô tả chi tiết không được để trống!");
            isValid = false;
        }
        if (!category) {
            $('#error-category').text("Vui lòng chọn danh mục!");
            isValid = false;
        }
        if (!brand) {
            $('#error-brand').text("Vui lòng chọn thương hiệu!");
            isValid = false;
        }

        if (!isValid) return;

        // Nếu hợp lệ, tiếp tục upload ảnh và gửi form
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
                    product_name: name,
                    sub_desc: subDesc,
                    solds: solds,
                    views: views,
                    category_id: category,
                    brand_id: brand,
                    description: description,
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
                        descriptionInput[0]['data-froala.editor'].html.set('');
                        publicInput.prop('checked', false);
                        fileInput.val('');
                        $('#addModal').modal('hide');
                        fetchListProducts();
                        showToast(response.message);
                    },
                    error: (error) => {
                        showToast(error.responseText);
                    }
                });
            },
            error: (error) => {
                showToast("Lỗi khi upload ảnh lên Cloudinary!");
            }
        });
    });

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
        // Xoá lỗi cũ
        $('#error_name, #error_subdesc, #error_detail').hide();

        const file = fileInputUpdate[0].files[0];
        const name = nameInputUpdate.val().trim();
        const subDesc = subDescInputUpdate.val().trim();
        const description = descriptionInputUpdate.val().trim();

        let hasError = false;

        if (!name) {
            $('#error_name').show();
            hasError = true;
        }

        if (!subDesc) {
            $('#error_subdesc').show();
            hasError = true;
        }

        if (!description) {
            $('#error_detail').show();
            hasError = true;
        }

        if (hasError) {
            return; // Dừng nếu có lỗi
        }

        const product = {
            product_name: name,
            sub_desc: subDesc,
            solds: soldsInputUpdate.val(),
            views: viewsInputUpdate.val(),
            category_id: categoryInputUpdate.val(),
            brand_id: brandInputUpdate.val(),
            description: description,
            is_public: publicInputUpdate.is(':checked') ? 1 : 0,
        }

        if (file) {
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "chovybe_present");
            formData.append("cloud_name", "dtdkm7cjl");

            try {
                const cloudinaryResponse = await $.ajax({
                    url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false
                });
                product.thumbnail = cloudinaryResponse.secure_url;
            } catch (error) {
                showToast("Lỗi khi upload ảnh!");
                return;
            }
        } else {
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
        });
    });
})

$('#search_btn').click((e) => {
    const page = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
    e.preventDefault();
    const name = $('#search_name').val();
    const brand = $('#search_brand').val();
    const category = $('#search_category').val();
    const search_params = {
        product_name: name,
        brand_id: brand,
        category_id: category
    };

    $.ajax({
        url: '?controller=product&action=search_product',
        method: 'GET',
        data: {
            search_params
        },
        dataType: 'json',
        success: (res) => {
            renderListProduct(res.data);
            renderPagination(page, res.pagination.total);
        },
        error: (err) => {
            renderListProduct([]);
        }
    })
})
</script>