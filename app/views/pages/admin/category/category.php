<div class="w-100">
    <div class="row">
        <div class="col-4">
            <h5 class="mb-3">Form nhập danh mục</h5>
            <form id="category-form" method="post">
                <div class="mb-3">
                    <label for="category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                        placeholder="Nhập tên danh mục tại đây">
                </div>
                <div class="mb-3 text-end">
                    <button type="submit" class="btn btn-primary">Thêm ngay</button>
                </div>
            </form>
        </div>

        <div class="col-8">
            <div class="mb-3 row">
                <div class="col-4">
                    <label for="filter_category_name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="filter_category_name" placeholder="Nhập tên danh mục">
                </div>
                <div class="col-4">
                    <label for="filter_created_date" class="form-label">Ngày tạo</label>
                    <input type="date" class="form-control" id="filter_created_date">
                </div>
                <div class="col-4">
                    <label for="filter_updated_date" class="form-label">Cập nhật lần cuối</label>
                    <input type="date" class="form-control" id="filter_updated_date">
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Ngày tạo</th>
                        <th scope="col">Cập nhật lần cuối</th>
                        <th scope="col">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody id="category-table">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="updateCategoryModal" tabindex="-1" aria-labelledby="updateCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateCategoryModalLabel">Cập nhật danh mục</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="update-category-form">
                    <input type="hidden" id="update_category_id">
                    <div class="mb-3">
                        <label for="update_category_name" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="update_category_name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../app/views/pages/admin/category/category.js"></script>
<script src="../app/views/pages/admin/category/fill.js"></script>
<script>
$(document).on("click", ".update-category", function() {
    let category_id = $(this).data("id");
    let category_name = $(this).data("name");
    $("#update_category_id").val(category_id);
    $("#update_category_name").val(category_name);
    $("#updateCategoryModal").modal("show");
});
</script>