<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Danh sách biến thể <?php echo $product['product_name']; ?></h5>
    <input type="hidden" id="product_id" value="<?php echo $product['product_id']; ?>">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm biến thể
    </button>
</div>

<form method="GET" action="variant_search.php" class="row g-3 align-items-end mb-3">
    <div class="col-3">
        <select class="form-select" id="stock" name="stock">
            <option value="">Số lượng tồn</option>
            <option value="0">Đã hết hàng</option>
            <option value="1">Còn ít (dưới 10 sản phẩm)</option>
        </select>
    </div>
    <div class="col-3">
        <select class="form-select" id="price" name="price">
            <option value="">Lọc theo giá</option>
            <option value="0">Từ thấp đến cao</option>
            <option value="1">Từ cao đến thấp</option>
        </select>
    </div>
    <div class="col">
        <select class="form-select" id="size_id" name="size_id">
            <option value="">Size</option>
            <?php 
                foreach ($sizes['data'] as $size) {
                    echo '<option value="'.$size['size_id'].'">'.$size['size_name'].'</option>';
                }
            ?>
        </select>
    </div>
    <div class="col">
        <select class="form-select" id="color_id" name="color_id">
            <option value="">Màu sắc</option>
            <?php 
                foreach ($colors['data'] as $color) {
                    echo '<option value="'.$color['color_id'].'">'.$color['color_name'].'</option>';
                }
            ?>
        </select>
    </div>

    <div class="col">
        <button type="submit" id="search_btn" class="btn btn-primary w-100">Tìm kiếm</button>
    </div>
</form>

<div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold text-center">Hình ảnh</th>
                <th scope="col" class="fw-bold text-center">Giá (VNĐ)</th>
                <th scope="col" class="fw-bold text-center">Tồn kho</th>
                <th scope="col" class="fw-bold text-center">Màu</th>
                <th scope="col" class="fw-bold text-center">Size</th>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm biến thể</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-form">
                    <div class="mb-3">
                        <label for="id" class="form-label">Id sản phẩm</label>
                        <input disabled type="text" class="form-control add-form"
                            value="<?php echo $product['product_id']; ?>" name="product_id"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input disabled type="text" class="form-control add-form"
                            value="<?php echo $product['product_name']; ?>" name="product_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Giá bán</label>
                                <input type="number" placeholder="Nhập vào giá bán (VNĐ)" class="form-control add-form"
                                    name="price" aria-describedby="emailHelp">
                                <div class="text-danger error_span" name="price"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Số lượng</label>
                                <input type="number" placeholder="Nhập vào số lượng" class="form-control add-form"
                                    name="stock" aria-describedby="emailHelp">
                                <div class="text-danger error_span" name="stock"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Màu sắc</label>
                                <select class="form-select add-form" name="color_id"
                                    aria-label="Default select example">
                                    <option selected value="">Chọn màu sắc</option>
                                    <?php
                                        $content = '';
                                        foreach ($colors['data'] as $color) {
                                            $content .= '<option value="'.$color['color_id'].'">
                                            '.$color['color_name'].' - '.$color['color_hex'].'
                                            </option>';
                                        }
                                        echo $content;
                                    ?>
                                </select>
                                <div class="text-danger error_span" name="color_id"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Size</label>
                                <select class="form-select add-form" name="size_id" aria-label="Default select example">
                                    <option selected value="">Kích cỡ sản phẩm</option>
                                    <?php
                                        $content = '';
                                        foreach ($sizes['data'] as $size) {
                                            $content .= '<option value="'.$size['size_id'].'">'.$size['size_name'].'</option>';
                                        }
                                        echo $content;
                                    ?>
                                </select>
                                <div class="text-danger error_span" name="size_id"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="files" multiple>
                        <div class="text-danger error_span" name="files"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" id="add-btn">Thêm ngay</button>
            </div>
        </div>
    </div>
</div>

<!-- Update modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm biến thể</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-form">
                    <div class="mb-3">
                        <input type="hidden" class="form-control update-form" name="variant_id"
                            aria-describedby="emailHelp">
                        <input type="hidden" class="form-control update-form" name="img" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="id" class="form-label">Id sản phẩm</label>
                        <input disabled type="text" class="form-control update-form"
                            value="<?php echo $product['product_id']; ?>" name="product_id"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên sản phẩm</label>
                        <input disabled type="text" class="form-control update-form"
                            value="<?php echo $product['product_name']; ?>" name="product_name"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Giá bán</label>
                                <input type="number" value="0" class="form-control update-form" name="price"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Số lượng</label>
                                <input type="number" value="0" class="form-control update-form" name="stock"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Màu sắc</label>
                                <select class="form-select update-form" name="color_id"
                                    aria-label="Default select example">
                                    <option selected>Chọn màu sắc</option>
                                    <?php
                                        $content = '';
                                        foreach ($colors['data'] as $color) {
                                            $content .= '<option value="'.$color['color_id'].'">
                                            '.$color['color_name'].' - '.$color['color_hex'].'
                                            </option>';
                                        }
                                        echo $content;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Size</label>
                                <select class="form-select update-form" name="size_id"
                                    aria-label="Default select example">
                                    <option selected>Kích cỡ sản phẩm</option>
                                    <?php
                                        $content = '';
                                        foreach ($sizes['data'] as $size) {
                                            $content .= '<option value="'.$size['size_id'].'">'.$size['size_name'].'</option>';
                                        }
                                        echo $content;
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh sản phẩm</label>
                        <input class="form-control" type="file" id="update-files" multiple>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" id="update-btn">Chỉnh sửa</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xoá sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" id="delete-id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" id="confirm-delete-btn">Xoá ngay</button>
            </div>
        </div>
    </div>
</div>

<script>
const inputs = document.getElementById('add-form').querySelectorAll('.add-form');
const renderList = (variants) => {
    const html = variants.map(variant => {
        const imgs = variant.images.map(img =>
            `<img src="${img}" alt="Ảnh sản phẩm" style="width: 50px; height: 50px; object-fit: contain; margin-right: 5px;" />`
        ).join('');
        return `
            <tr>
                <td>${imgs}</td>
                <td class="text-center">${Number(variant.price).toLocaleString()}</td>
                <td class="text-center">${variant.stock}</td>
                <td class="text-center">${variant.color_name}</td>
                <td class="text-center">${variant.size_name}</td>
                <td class="text-center">
                    <button type="button" 
                        data-product-id="${variant.product_id}" 
                        data-variant-id="${variant.variant_id}"
                        data-price="${variant.price}"
                        data-stock="${variant.stock}"
                        data-color="${variant.color_id}"
                        data-size="${variant.size_id}"
                        data-img="${variant.images[0]}"
                        class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </button>
                    <button type="button" class="btn-sm btn-danger" data-id="${variant.variant_id}" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </td>
            </tr>
        `;
    });
    document.getElementById('table-body').innerHTML = html.join('');
}

$('#deleteModal').on('show.bs.modal', function(event) {
    const button = $(event.relatedTarget);
    const id = button.data('id');
    $('#delete-id').val(id);
});

$('#confirm-delete-btn').click(async function() {
    const id = $('#delete-id').val();
    $.ajax({
        url: `?controller=variant&action=delete_variant_item&variant_id=${id}`,
        method: 'GET',
        dataType: 'json',
        success: (res) => {
            showToast(res.message);
            $('#deleteModal').modal('hide');
            fetchListVariant();
        },
        error: (err) => {
            showToast('Xoá không thành công');
        }
    })
});

$('#update-btn').click((e) => {
    e.preventDefault();
    const files = $('#update-files')[0].files;
    const product = {};

    const form = $('#update-form');
    form.find('.update-form').each(function() {
        const name = $(this).attr('name');
        const value = $(this).val();
        product[name] = value;
    });

    if (product['img'] && files.length === 0) {
        $.ajax({
            url: '?controller=variant&action=update',
            method: 'POST',
            dataType: 'json',
            data: product,
            success: (res) => {
                $('#updateModal').modal('hide');
                showToast(res.message);
                fetchListVariant();
            },
            error: (err) => {
                $('#updateModal').modal('hide');
                showToast(error.responseText)
            }
        })
    } else {
        // Upload hình mới
        // Nếu form hợp lệ, tiếp tục xử lý upload ảnh và gửi dữ liệu
        const uploadPromises = Array.from(files).map(file => {
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "chovybe_present");

            return new Promise((resolve, reject) => {
                $.ajax({
                    url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        resolve(response);
                    },
                    error: (error) => {
                        reject(error);
                    }
                });
            });
        });

        Promise.all(uploadPromises)
            .then(results => {
                const images = results.map(file => file.secure_url)
                // Xử lý update biến thể
                $.ajax({
                    url: '?controller=variant&action=update',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        ...product,
                        images
                    },
                    success: (res) => {
                        $('#updateModal').modal('hide');
                        showToast(res.message)
                    },
                    error: (err) => {
                        $('#updateModal').modal('hide');
                        showToast(error.responseText)
                    }
                });
            })
            .catch(error => {
                console.error('Có lỗi trong quá trình upload:', error);
            });
    }
})

$('#add-btn').click(async (e) => {
    e.preventDefault();

    // Lấy tất cả giá trị từ form
    const files = $('#files')[0].files;
    const product = {};

    // Validate form
    const form = $('#add-form');
    let isValid = true;
    form.find('.error_span').text(''); // Clear previous error messages

    // Kiểm tra các input bắt buộc
    form.find('.add-form').each(function() {
        const name = $(this).attr('name');
        const value = $(this).val();

        // Nếu giá trị trống, thông báo lỗi
        if (value === '' || value === 'Chọn màu sắc' || value === 'Kích cỡ sản phẩm') {
            isValid = false;
            $(`div[name=${name}]`).text('Vui lòng chọn ' + name.replace('_', ' '));
        } else {
            // Thêm dữ liệu vào product nếu không có lỗi
            product[name] = value;
        }
    });

    // Kiểm tra nếu không có ảnh nào được chọn
    if (files.length === 0) {
        isValid = false;
        $('div[name="files"]').text('Vui lòng chọn hình ảnh');
    }

    // Nếu form không hợp lệ, dừng lại
    if (!isValid) {
        return;
    }

    // Nếu form hợp lệ, tiếp tục xử lý upload ảnh và gửi dữ liệu
    const uploadPromises = Array.from(files).map(file => {
        const formData = new FormData();
        formData.append("file", file);
        formData.append("upload_preset", "chovybe_present");

        return new Promise((resolve, reject) => {
            $.ajax({
                url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: (response) => {
                    resolve(response);
                },
                error: (error) => {
                    reject(error);
                }
            });
        });
    });

    Promise.all(uploadPromises)
        .then(results => {
            // Xử lý thêm biến thể
            $.ajax({
                url: '?controller=variant&action=add',
                method: 'POST',
                dataType: 'json',
                data: product,
                success: (response) => {
                    const imgs = results.map(file => file.secure_url);
                    $.ajax({
                        // Tạo variant hình ảnh
                        url: `?controller=variant&action=add_img`,
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            imgs,
                            variant_id: response.data
                        },
                        success: (response) => {
                            showToast(response.message);
                            $('#addModal').modal('hide');
                            form.find('.add-form').each(function() {
                                const name = $(this).attr('name');
                                if (name !== 'product_id' && name !==
                                    'product_name') {
                                    $(this).val('')
                                }
                            });
                            $('#files').val('')
                            fetchListVariant();
                        },
                        error: (error) => {
                            $('#addModal').modal('hide');
                            showToast(error.responseText)
                        }
                    });
                },
                error: (error) => {
                    $('#addModal').modal('hide');
                    showToast(error.responseText)
                }
            });
        })
        .catch(error => {
            console.error('Có lỗi trong quá trình upload:', error);
        });
});

$('#search_btn').click((e) => {
    e.preventDefault();
    const stock = $('#stock').val();
    const price = $('#price').val();
    const size_id = $('#size_id').val();
    const color_id = $('#color_id').val();
    console.log(stock, price, size_id, color_id);
    $.ajax({
        url: '?controller=variant&action=filter_variant',
        method: 'GET',
        dataType: 'json',
        data: {
            stock,
            price,
            size_id,
            color_id,
            product_id: <?php echo $product['product_id']; ?>
        },
        success: (res) => {
            console.log(res);
        },
        error: (error) => {
            console.log(error);
        }
    })
})

const fetchListVariant = () => {
    const page = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;

    const id = $('#product_id').val();
    $.ajax({
        url: `?controller=variant&action=get_all&product_id=${id}&page=${page}`,
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            renderList(response.data);
            renderPagination(page, response.pagination.total);
        },
        error: (error) => {
            console.log(error);
        }
    })
}

// Lắng nghe sự kiện mở modal update
$('#updateModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var variantId = button.data('variant-id');
    var price = button.data('price');
    var stock = button.data('stock');
    var color = button.data('color');
    var size = button.data('size');
    var img = button.data('img');
    var modal = $(this);
    modal.find('input[name="price"]').val(Number(price));
    modal.find('input[name="variant_id"]').val(variantId);
    modal.find('input[name="stock"]').val(stock);
    modal.find('select[name="color_id"]').val(color);
    modal.find('select[name="size_id"]').val(size);
    modal.find('input[name="img"]').val(img);
});

$(document).ready(() => {
    fetchListVariant();
})
</script>