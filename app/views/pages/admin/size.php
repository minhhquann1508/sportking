<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Thông tin Size</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-size-modal">
            <i class="fa-solid fa-plus"></i> Thêm Size
        </button>
    </div>

    <!-- filter -->
    <!-- <div class="mb-3">
        <form method="post" id="search-box" class="row">
            <div class="col-11 d-flex gap-2">
                <div class="flex-grow-1">
                    <label for="size_name">Tên size</label>
                    <input type="text" class="form-control" id="size_search" name="size_name"
                        placeholder="Nhập tên size">
                </div>
                <div class="flex-grow-1">
                    <label>Danh Mục</label>
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Ngày tạo</label>
                    <input type="date" class="form-control" name="created_at" id="created_at">
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Lần cuối chỉnh sửa</label>
                    <input type="date" class="form-control" name="phone" id="updated_at">
                </div>
            </div>
            <div class="col ps-0 text-end d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100"><span class="fw-bold">Tìm</span> <i
                        class="fa-solid fa-magnifying-glass" style="font-size: 12px;"></i></button>
            </div>
    </div> -->

    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên Size</th>
                    <th scope="col">Danh Mục</th>
                    <th scope="col">Tùy Chọn</th>
                </tr>
            </thead>
            <tbody id="size-table">
                <tr><td colspan="4" class="text-center text-muted"></td></tr>
            </tbody>
        </table>
    </div>
</div>
<!-- thêm -->
<div class="modal fade" id="add-size-modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="modalLabel">Thêm Size</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="size-form-add">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên Size</label>
                        <input type="text" class="form-control" id="size_name" placeholder="Nhập tên size" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Danh Mục</label>
                        <select class="form-select" id="category_id" required>
                            <option value="" disabled selected>Chọn danh mục</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- sửa size -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Cập nhật size</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-size-form">
                <input type="hidden" id="update_size_id">
                    <div class="mb-3">
                        <label>Tên size</label>
                        <input type="text" id="update_size_name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Chọn danh Mục</label>
                        <select class="form-select" aria-label="Default select example" id="updated_category">
                                <?php 
                                    foreach ($categories as $key => $category) {
                                        echo '<option '.($key == 1 ?? 'selected').' value="'.$category['category_id'].'">'.$category['category_name'].'</option>';
                                    }
                                ?>
                        </select>
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
<script>
    $(document).ready(function () {
    function loadSizes() {
        $.ajax({
            url: "?controller=size&ajax=true", 
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let content = "";
                    $.each(response.data, function (key, size) {
                        content += `
                            <tr class="">
                                <th scope="row">${key + 1}</th>
                                <td>${size.size_name}</td>
                                <td>${size.category_name}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary update-size" 
                                    data-id="${size.size_id}" data-bs-toggle="modal" data-bs-target="#updateModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <a href="javascript:void(0)" class="btn btn-danger delete-size" 
                                    data-id="${size.size_id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                            </tr>
                        `;
                    });
                    $("#size-table").html(content);
                } else {
                    $("#size-table").html("<tr><td colspan='5' class='text-center text-danger'>Không có dữ liệu</td></tr>");
                }
            },
        });
    }
    loadSizes();
    // thêm
    $('#size-form-add').submit(function(e) {
        e.preventDefault();
        const size_name = $('#size_name');
        const category_id = $('#category_id');
        $.ajax({
        url: "?controller=size&action=add_size_action",
        method: "POST",
        data: {
            size_name: size_name.val(),
            category_id: category_id.val(),
        },
            dataType: "json",
            success: function(response){
                if (response.success){
                    size_name.val('');
                    category_id.val('');
                    loadSizes();
                    $("#add-size-modal").modal('hide');
                    showToast(response.message);
                }
                else {
                    $("#add-size-modal").modal('hide');
                    showToast(response.message);
                }
            },
            error: function(error){
                showToast(response.responseText);
            }

        })
    })

    // xoá
    $(document).on('click', '.delete-size', function(){
        let size_id = $(this).data('id');
        $.get("?controller=size&action=delete_size", {size_id: size_id}, function(response){
            alert("Xoá thành công");
            loadSizes();
        });
    });

    // cập nhật
        // set update-blog
        $(document).on('click', '.update-size', function () {
        const sizeId = $(this).data('id');
        $.ajax({
            url: '?controller=size&action=get_size_by_id',
            method: 'GET',
            data: { id: sizeId },
            dataType: 'json',
            success: (res) => {
                if (res.success) {
                    const size = res.data;
                    $('#update_size_id').val(size.size_id);
                    $('#update_size_name').val(size.size_name);
                    $('#update_category').val(size.category_id);
                } else {
                    alert("Không lấy được dữ liệu bài viết");
                }
            }
        });
    });

    const updateSizeBtn = $('#update_btn');
    const updateSizeId = $('#update_size_id');
    const updateSizeName = $('#update_size_name');
    const updateCategory = $('#update_category');


        //cập nhật size
        updateSizeBtn.click(async () => {
        const size = {
        size_id: updateSizeId.val(),
        size_name: updateSizeName.val(),
        category_id: updateCategory.val(),
        };
        const id = updateSizeId.val();
        console.log("Size cần cập nhật:", size);
        $.ajax({
        url: '?controller=size&action=update_size_by_id',
        method: 'POST',
        data: {
                size_id: id,
                size 
            },
        dataType: 'json',
        success: (response) => {
            $('#updateModal').modal('hide');
            loadSizes();
            showToast(response.message);
        },
        error: (err) => {
            showToast(err.responseText);
            console.log(err.responseText);
        }
        });
            });
        });

</script>