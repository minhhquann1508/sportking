<div class="wrapper-statiscal">
    <div class="up-statiscal">
        <div class="img-row-card">
            <img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/background_silver.png" alt="user"
                class="img-fluid">
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1 item-box">
                    <div class="card-body">
                        <div class="ml-3">
                            <div class="card-box">
                                <h6 class="mb-0">F-Point hiện có</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-primary mb-0">2,300</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1 item-box">
                    <div class="card-body">
                        <div class="ml-3">
                            <div class="card-box">
                                <h6 class="mb-0">Đơn hàng</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-danger mb-0">0 đơn hàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1 item-box">
                    <div class="card-body">
                        <div class="ml-3">
                            <div class="card-box">
                                <h6 class="mb-0">Đã thanh toán</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-success mb-0">0 đ</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1 item-box">
                    <div class="card-body">
                        <div class="ml-3">
                            <div class="card-box">
                                <h6 class="mb-0">Free ship hiện có</h6>
                            </div>
                            <div class="card-body">
                                <p class="text-warning mb-0">0 lần</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="profile-statiscal">
        <h3>Hồ sơ cá nhân</h3>
        <form id="update-form">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tên đăng nhập</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="fullname" id="user_fullname"
                        value="<?= isset($user['fullname']) ? $user['fullname'] : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="user_email"
                        value="<?= isset($user['email']) ? $user['email'] : ''; ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" id="user_phone"
                        value="<?= isset($user['phone']) ? $user['phone'] : ''; ?>">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
            <div id="update-result" style="margin-top: 10px;"></div>
        </form>
    </div>

</div>
<script>
$("#update-form").submit(function(e) {
    e.preventDefault();

    let fullname = $("#user_fullname").val().trim();
    let email = $("#user_email").val().trim();
    let phone = $("#user_phone").val().trim();

    $.ajax({
        url: "?controller=home&action=updateProfile",
        method: "POST",
        data: {
            fullname: fullname,
            email: email,
            phone: phone
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function(xhr, status, error) {
            showToast(error.message);
        }
    });
});
</script>

<style>
.wrapper-statiscal {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.wrapper-statiscal .up-statiscal {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 0;
    border-radius: 10px;
    background-color: #fff;
}

.wrapper-statiscal .up-statiscal .row {
    padding: 20px;
}

.wrapper-statiscal .up-statiscal .item-box {
    background-color: #F2F4F5;
    border: none;
    border-radius: 12px;
}

.wrapper-statiscal .profile-statiscal {
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
}

.profile-statiscal h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #333;
}

.profile-statiscal .form-group {
    margin-bottom: 15px;
}

.profile-statiscal .form-control {
    border-radius: 5px;
    padding: 155px;
}


.profile-statiscal .form-check-label {
    margin-right: 15px;
}

.profile-statiscal .form-check-input {
    margin-right: 5px;
    padding: 10px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>