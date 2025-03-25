
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
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tên thương hiệu</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody id="brand-table">
                   
                </tbody>

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
    console.log(123);
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
    $('#brand-form').submit(function(e) {
        e.preventDefault();
        let name = $('#brand_name').val();
        let thumbnail = $('#brand_thumbnail').val();

        $.ajax({
            url:"?controller=brand&action=add_brand",
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
                } else{
                    showToast(response.message);
                }
            },
            error: function(response){
                showToast(response.responseText);
            } 
        })
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
    $('#update-brand-form').submit(function(e) {
        e.preventDefault();

        let id = $('#update_brand_id').val();
        let name = $('#update_brand_name').val();
        let thumbnail = $('#update_brand_thumbnail').val();

        $.post("?controller=brand&action=updateBrand", { brand_id: id, brand_name: name, thumbnail: thumbnail }, function(response) {
            alert("Cập nhật thành công!");
            $('#updateBrandModal').modal('hide');
            loadBrands();
        });
    });
});

</script>