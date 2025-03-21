<div class="w-100">
    <div class="row">
        <div class="col-4">
            <h5 class="mb-3">Form nhập size</h5>
            <form id="size-form">
            <div class="mb-3">
                <label for="size_name" class="form-label">Tên size</label>
                <input type="text" class="form-control" id="size_name"
                    placeholder="Nhập tên size tại đây">
            </div>
            <div class="mb-3">
                <label for="category_name" class="form-label">Tên danh mục</label>
                <select class="form-control" id="category_name">
                    <option value="">Chọn danh mục</option>
                    <option value="1">Danh mục 1</option>
                    <option value="2">Danh mục 2</option>
                    <option value="3">Danh mục 3</option>
                </select>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary" id="add_size">Thêm ngay</button>
            </div>
            </form>
        </div>

        <div class="col-8">
            <table class="table">
                <thead>
                    <tr class="text-center">
                        <th scope="col">Id size</th>
                        <th scope="col">Tên size</th>
                        <th scope="col">Tên danh mục</th>
                    </tr>
                </thead>
                <tbody id="size-table">
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../app/views/pages/admin/size/size.js"></script>