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

        $.post("?controller=brand&action=addBrand", { brand_name: name, thumbnail: thumbnail }, function(response) {
            alert("Thêm thành công!");

            loadBrands();
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
