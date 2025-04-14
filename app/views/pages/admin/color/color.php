<div class="container mt-5">
    <div class="row">
        <!-- Form thêm thương hiệu -->
        <div class="col-4">
            <form id="brand-form" method="POST">
                <h5>Thêm màu sắc</h5>
                <div class="mb-3">
                    <label>Tên màu sắc:</label>
                    <input type="text" id="color_name" class="form-control" placeholder="Nhập tên màu">
                </div>
                <div class="mb-3">
                    <label for="exampleColorInput" class="form-label">Chọn màu:</label>
                    <input type="color" class="form-control form-control-color" id="color" value="#563d7c"
                        title="Choose your color">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary" id="add-btn">Thêm ngay</button>
                </div>
            </form>
        </div>

        <!-- Bảng hiển thị thương hiệu -->
        <div class="col-8">
            <h5>Danh sách màu sắc</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Tên màu</th>
                        <th scope="col">Màu</th>
                        <th scope="col">Mã màu</th>
                        <th scope="col">Tùy chọn</th>
                    </tr>
                </thead>
                <tbody id="color-table">

                </tbody>

                <div id="pagination" class="d-flex justify-content-center align-items-center"></div>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fs-5" id="exampleModalLabel">Xác nhận xoá màu sắc này?</h6>
                <input type="hidden" id="color_id">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                <button type="button" class="btn btn-primary" id="delete-btn">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<script>
const setColorId = (id) => {
    document.getElementById('color_id').value = id;
}

const renderTableBody = (colors) => {
    const html = colors.map(color => {
        return `
                <tr>
                    <td>${color.color_id}</td>
                    <td>${color.color_name}</td>
                    <td>
                        <div style="width: 30px; height: 30px; background-color: ${color.color_hex}"></div>
                    </td>
                    <td>${color.color_hex}</td>
                    <td>
                        <button type="button" class="btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal"><i class="fa-regular fa-pen-to-square"></i></button>
                        <button type="button" class="btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="setColorId('${color.color_id}')">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            `;
    })
    document.getElementById('color-table').innerHTML = html.join('');
}

$(document).ready(() => {
    const fetchList = () => {
        $.ajax({
            url: '?controller=color&action=get_all',
            method: 'GET',
            dataType: 'json',
            success: (response) => {
                renderTableBody(response.data);
            },
            error: (error) => {
                console.log('error');
            }
        });
    }

    fetchList();

    $('#add-btn').click((e) => {
        e.preventDefault();
        const colorHex = $('#color').val();
        const colorName = $('#color_name').val();
        $.ajax({
            url: '?controller=color&action=add',
            method: 'POST',
            dataType: 'json',
            data: {
                color_hex: colorHex,
                color_name: colorName
            },
            success: (response) => {
                $('#color').val('#ccc')
                $('#color_name').val('')
                fetchList();
                showToast(response.message);
            },
            error: (error) => {
                showToast(error.responseText);
            }
        })
    })

    $('#delete-btn').click(() => {
        const id = $('#color_id').val();
        $.ajax({
            url: '?controller=color&action=delete_by_id',
            method: 'POST',
            data: {
                color_id: id
            },
            dataType: 'json',
            success: (response) => {
                $('#color_id').val('');
                fetchList();
                $('#deleteModal').modal('hide');
                showToast(response.message);
            },
            error: (error) => {
                showToast(error.responseText);
            }
        })
    })
})
</script>