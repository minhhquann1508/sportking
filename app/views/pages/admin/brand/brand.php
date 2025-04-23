<style>
    .form-label {
        font-weight: 600;
    }

    #brand-form,
    #update-brand-form {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    #brand-form h5 {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    #brand-table img {
        object-fit: contain;
        border-radius: 6px;
    }

    #filter_btn {
        font-weight: 600;
        letter-spacing: 1px;
    }

    .btn-info {
        color: white;
    }

    .modal-title {
        font-weight: 600;
    }
</style>

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
             <div class="mb-3 row">
                <div class="col-4">
                    <label for="filter_category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="filter_brand_name" placeholder="Nhập tên danh mục">
                </div>
                <div class="col-4">
                    <label for="filter_created_date" class="form-label">Ngày tạo</label>
                    <input type="date" class="form-control" id="filter_created_date">
                </div>
                <div class="col-4">
                    <label for="filter_updated_date" class="form-label">Cập nhật lần cuối</label>
                    <input type="date" class="form-control" id="filter_updated_date">
                </div>
                <button id="filter_btn" class="btn btn-primary mb-3 mt-3 w-100">
                    tìm
                </button>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên thương hiệu</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Cập nhật lần cuối</th>
                        <th scope="col">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody id="brand-table">
                   
                </tbody>

                <div id="pagination" class="d-flex justify-content-center align-items-center"></div>
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


<script>
    const renderBrand = (brands) => {
        let content = "";
                brands.forEach(brand => {
                    content += `
                        <tr>
                            <td>${brand.brand_id}</td>
                            <td>${brand.brand_name}</td>
                            <td><img src="${brand.thumbnail}" width="100"></td>
                            <td>${formatDate(brand.created_at)}</td>
                            <td>${formatDate(brand.updated_at)}</td>
                            <td>
                                <button class="btn btn-info update-brand" 
                                    data-id="${brand.brand_id}" 
                                    data-name="${brand.brand_name}" 
                                    data-thumbnail="${brand.thumbnail}">Sửa</button>
                                <button class="btn btn-danger delete-brand" data-id="${brand.brand_id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                });
                
                document.getElementById("brand-table").innerHTML = content;
    }
    function formatDate(dateString) {
        if (!dateString) return "N/A";
        const date = new Date(dateString);
        return date.toLocaleDateString("vi-VN",{
            year: "numeric", 
            month: "2-digit", 
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit"
        });
    }
$(document).ready(function() {
    function loadBrands() {
        $.ajax({
            url: "?controller=brand&ajax=true",
            method: "GET",
            dataType: "json",
            success: function(data) {
                
                let content = "";
                $.each(data, function(key, brand) {
                    content += `
                        <tr>
                            <td>${brand.brand_id}</td>
                            <td>${brand.brand_name}</td>
                            <td><img src="${brand.thumbnail}" width="100"></td>
                            <td>${formatDate(brand.created_at)}</td>
                            <td>${formatDate(brand.updated_at)}</td>
                            <td>
                                <button class="btn btn-info update-brand" 
                                    data-id="${brand.brand_id}" 
                                    data-name="${brand.brand_name}" 
                                    data-thumbnail="${brand.thumbnail}">Sửa</button>
                                <button class="btn btn-danger delete-brand" data-id="${brand.brand_id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                });
                $("#brand-table").html(content);
            }
        });
    }
    
    loadBrands();

    // Thêm thương hiệu
    // $('#brand-form').submit(function(e) {
    //     e.preventDefault();
    //     let name = $('#brand_name').val();
    //     let thumbnail = $('#brand_thumbnail').val();

    //     $.ajax({
    //         url:"?controller=brand&action=add_brand",
    //         method: "POST",
    //         data: {
    //             brand_name: name,
    //             thumbnail: thumbnail
    //         },
    //         dataType: "json",
    //         success: function(response){
    //             if (response.success){
    //                 loadBrands();
    //                 showToast(response.message);               
    //             } else{
    //                 showToast(response.message);
    //             }
    //         },
    //         error: function(response){
    //             showToast(response.responseText);
    //         } 
    //     })
    // });

    $('#brand-form').submit(function(e) {
    e.preventDefault();

    let name = $('#brand_name').val().trim();
    let thumbnail = $('#brand_thumbnail').val().trim();

    if (name === '' || thumbnail === '') {
        alert("Vui lòng nhập đầy đủ thông tin.");
        return;
    }

    $.ajax({
        url: "?controller=brand&action=add_brand",
        method: "POST",
        data: {
            brand_name: name,
            thumbnail: thumbnail
        },
        dataType: "json",
        success: function(response){
            if (response.success){
                loadBrands();
                showToast(response.message);
                $('#brand-form')[0].reset(); // reset form sau khi thêm
            } else{
                showToast(response.message);
            }
        },
        error: function(response){
            showToast(response.responseText);
        } 
    });
});

    // Xóa thương hiệu
    $(document).on('click', '.delete-brand', function() {
        let brandId = $(this).data('id');

        $.get("?controller=brand&action=deleteBrand", { brand_id: brandId }, function(response) {
            alert("Xóa thành công!");
            loadBrands();
        });
    });

    // Mở Modal cập nhật thương hiệu
    $(document).on('click', '.update-brand', function() {
        let brandId = $(this).data('id');
        let brandName = $(this).data('name');
        let brandThumbnail = $(this).data('thumbnail');

        $('#update_brand_id').val(brandId);
        $('#update_brand_name').val(brandName);
        $('#update_brand_thumbnail').val(brandThumbnail);

        $('#updateBrandModal').modal('show');
    });

    // Cập nhật thương hiệu
    // $('#update-brand-form').submit(function(e) {
    //     e.preventDefault();

    //     let id = $('#update_brand_id').val();
    //     let name = $('#update_brand_name').val();
    //     let thumbnail = $('#update_brand_thumbnail').val();

    //     $.post("?controller=brand&action=updateBrand", { brand_id: id, brand_name: name, thumbnail: thumbnail }, function(response) {
    //         alert("Cập nhật thành công!");
    //         $('#updateBrandModal').modal('hide');
    //         loadBrands();
    //     });
    // });
    $('#update-brand-form').submit(function(e) {
    e.preventDefault();

    let id = $('#update_brand_id').val();
    let name = $('#update_brand_name').val().trim();
    let thumbnail = $('#update_brand_thumbnail').val().trim();

    if (name === '' || thumbnail === '') {
        alert("Vui lòng nhập đầy đủ thông tin.");
        return;
    }

    $.post("?controller=brand&action=updateBrand", { 
        brand_id: id, 
        brand_name: name, 
        thumbnail: thumbnail 
    }, function(response) {
        alert("Cập nhật thành công!");
        $('#updateBrandModal').modal('hide');
        loadBrands();
    });
});



    $('#filter_btn').click(function(e){
       let brandName = $('#filter_brand_name').val();
        $.ajax({
            url: "?controller=brand&ajax=true",
            method: "POST",
            dataType: "json",
            data: {
                brand_name: brandName,
                filter: true
            },
            success:function(res){
                console.log(res.data)
                renderBrand(res.data);
            },
            error: function(response) {
                showToast(response.responseText);
            }
        })
    })
});

</script>


