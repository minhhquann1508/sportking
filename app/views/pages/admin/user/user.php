<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-3">Thông tin người dùng</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
            Thêm quản trị viên
        </button>
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
</div>

<div class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm quản trị viên</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="user-form">
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
                        <button type="submit" class="btn btn-primary">Thêm ngay</button>
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
        $.ajax({
            url: "?controller=user&ajax=true",
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
                            <td class="text-center">${user.role == 1 ? "Admin" : "Người dùng"}</td>
                            <td class="text-center">
                                <i style="font-size: 20px" class="fa-solid fa-circle-info"></i>
                            </td>
                        </tr>`;
                });
                $("#table-body").html(content);
            },
        });
    }
    loadUsers();
    $('#user-form').submit(function(e) {
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
                    alert("Thêm danh mục thất bại");
                    $('#add-user-modal').modal('hide');
                    showToast(response.message);
                }
            },
            error: function(error) {
                showToast(response.responseText);
            }
        })
    })
});
</script>