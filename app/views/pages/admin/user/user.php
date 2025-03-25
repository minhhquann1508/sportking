<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h5>Thông tin người dùng</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
            Thêm quản trị viên
        </button>
    </div>
    <div class="mb-3">
        <form method="post" id="search-box" class="row">
            <div class="col-11 d-flex gap-2">
                <div class="flex-grow-1">
                    <label for="fullname">Họ tên</label>
                    <input type="text" class="form-control" id="fullname-search" name="fullname"
                        placeholder="Nhập họ tên">
                </div>
                <div class="flex-grow-1">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email-search" name="email" placeholder="Nhập email">
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone-search" name="phone"
                        placeholder="Nhập số điện thoại">
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
    </div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold">Id</th>
                <th scope="col" class="fw-bold">Email</th>
                <th scope="col" class="fw-bold">Họ và tên</th>
                <th scope="col" class="fw-bold">SĐT</th>
                <th scope="col" class="fw-bold text-center">Chức vụ</th>
                <th scope="col" class="fw-bold text-center">Tùy chọn</th>
            </tr>
        </thead>
        <tbody id="table-body"></tbody>
    </table>
    <div id="pagination" class="d-flex justify-content-center align-items-center"></div>
</div>

<div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm quản trị viên</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control" id="fullname" placeholder="Nhập tên người dùng">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                            placeholder="admin@gmail.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu của bạn">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" id="phone" placeholder="(84+) 123346645">
                    </div>
                    <div class="mb-3 text-end">
                        <button id="add-user-btn" type="submit" class="btn btn-primary">Thêm ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function renderUsers(users) {
    let userTableBody = document.querySelector("#table-body");
    userTableBody.innerHTML = "";
    users.forEach(user => {
        let content = `<tr>
            <td>${user.user_id}</td>
            <td>${user.email}</td>
            <td>${user.fullname ? user.fullname : "Chưa có"}</td>
            <td>${user.phone ? user.phone : "Chưa có"}</td>
            <td class="text-center">${user.role == 1 ? "Admin" : "Người dùng"}</td>
            <td class="text-center">
                <i style="font-size: 20px" class="fa-solid fa-circle-info"></i>
            </td>
        </tr>`;
        userTableBody.innerHTML += content;
    });
}
$(document).ready(function() {
    function loadUsers() {
        const page = parseInt(new URLSearchParams(window.location.search).get('page')) || 1;
        $.ajax({
            url: `?controller=user&ajax=true&page=${page}`,
            method: "GET",
            dataType: "json",
            success: function(response) {
                let content = "";
                $.each(response.data, function(key, user) {
                    content += `
                        <tr>
                            <td>${user.user_id}</td>
                            <td>${user.email}</td>
                            <td>${user.fullname ? user.fullname : "Chưa có"}</td>
                            <td>${user.phone ? user.phone : "Chưa có"}</td>
                            <td class="text-center">${user.role == 1 ? "Quản trị viên" : "Người dùng"}</td>
                            <td class="text-center">
                                <i style="font-size: 20px" class="fa-solid fa-circle-info"></i>
                            </td>
                        </tr>`;
                });
                $("#table-body").html(content);
                renderPagination(page, response.total);
            },
        });
    }
    loadUsers();
    $('#add-user-btn').click(function(e) {
        e.preventDefault();
        const emailInput = $('#email');


        const fullnameInput = $('#fullname');
        const passwordInput = $('#password');
        const phoneInput = $('#phone');
        $.ajax({
            url: '?controller=user&action=add_user_by_admin',
            method: "POST",
            data: {
                email: emailInput.val(),
                fullname: fullnameInput.val(),
                password: passwordInput.val(),
                phone: phoneInput.val()
            },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    emailInput.val('');
                    fullnameInput.val('');
                    passwordInput.val('');
                    phoneInput.val('');
                    loadUsers();
                    $('#add-user-modal').modal('hide');
                    showToast(response.message);
                } else {
                    $('#add-user-modal').modal('hide');
                    showToast(response.message);
                }
            },
            error: function(error) {
                showToast(response.responseText);
            }
        })
    })
    $('#search-box').submit(function(e) {
        e.preventDefault();
        const fullname = $('#fullname-search').val().trim();
        const email = $('#email-search').val().trim();
        const phone = $('#phone-search').val().trim();
        const createdAt = $('#created_at').val().trim();
        const updatedAt = $('#updated_at').val().trim();

        let searchParams = {};
        if (fullname) searchParams.fullname = fullname;
        if (email) searchParams.email = email;
        if (phone) searchParams.phone = phone;
        if (createdAt) searchParams.created_at = createdAt;
        if (updatedAt) searchParams.updated_at = updatedAt;

        $.ajax({
            url: '?controller=user&ajax=true',
            method: 'POST',
            data: searchParams,
            dataType: 'json',
            success: function(response) {
                renderUsers(response.data);
                renderPagination(1, response.total);
            }
        });
    });
});
</script>