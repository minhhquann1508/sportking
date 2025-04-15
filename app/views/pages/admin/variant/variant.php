<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Danh sách biến thể</h5>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        Thêm biến thể
    </button>
</div>
<div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold">Tên sản phẩm</th>
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
                                <input type="number" value="0" class="form-control add-form" name="price"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                        <div class="col-6">
                            <div>
                                <label class="form-label">Số lượng</label>
                                <input type="number" value="0" class="form-control add-form" name="stock"
                                    aria-describedby="emailHelp">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <div>
                                <label class="form-label">Màu sắc</label>
                                <select class="form-select add-form" name="color_id"
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
                                <select class="form-select add-form" name="size_id" aria-label="Default select example">
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
                        <input class="form-control" type="file" id="files" multiple>
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


<script>
const inputs = document.getElementById('add-form').querySelectorAll('.add-form');
const renderList = (variants) => {
    const html = variants.map(variant => {
        const imgs = variant.images.map(img =>
            `<img src="${img}" alt="Ảnh sản phẩm" style="width: 50px; height: 50px; object-fit: cover; margin-right: 5px;" />`
        ).join('');

        return `
            <tr>
                <td>${variant.product_name}</td>
                <td>${imgs}</td>
                <td class="text-center">${Number(variant.price).toLocaleString()}</td>
                <td class="text-center">${variant.stock}</td>
                <td class="text-center">${variant.color_name}</td>
                <td class="text-center">${variant.size_name}</td>
                <td class="text-center">
                </td>
            </tr>
        `;
    });

    document.getElementById('table-body').innerHTML = html.join('');
}

$('#add-btn').click(async (e) => {
    e.preventDefault();
    const files = $('#files')[0].files;
    const product = {};
    for (let input of inputs) {
        const {
            name,
            value
        } = input;
        product[name] = value;
    }

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
                            fetchListVariant();
                        },
                        error: (error) => {
                            console.log(error.responseText);
                        }
                    })
                },
                error: (error) => {
                    console.log(error.responseText);
                }
            });
        })
        .catch(error => {
            console.error('Có lỗi trong quá trình upload:', error);
        });
})

const fetchListVariant = () => {
    $.ajax({
        url: '?controller=variant&action=get_all',
        method: 'GET',
        dataType: 'json',
        success: (response) => {
            console.log(response.data);
            renderList(response.data);
        },
        error: (error) => {
            console.log(error);
        }
    })
}

$(document).ready(() => {
    fetchListVariant();
})
</script>