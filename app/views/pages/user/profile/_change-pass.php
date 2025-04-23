<div class="wrapper-password">
    <h3>Đổi mật khẩu</h3>
    <form class="form-password" method="post" id="password-form">
        <div class="form-group row">
            <label for="example-old_password-input" class="col-sm-2 col-form-label">Mật khẩu cũ</label>
            <div class="col-sm-10">
                <input type="password" name="old_password" class="form-control" id="example-old_password-input"
                    placeholder="Mật khẩu cũ">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-new_password-input" class="col-sm-2 col-form-label">Mật khẩu mới</label>
            <div class="col-sm-10">
                <input type="password" name="new_password" class="form-control" id="example-new_password-input"
                    placeholder="Mật khẩu mới">
            </div>
        </div>
        <div class="form-group row">
            <label for="example-confirm_new_password-input" class="col-sm-2 col-form-label">Xác nhận mật khẩu
                mới</label>
            <div class="col-sm-10">
                <input type="password" name="confirm_password" class="form-control"
                    id="example-confirm_new_password-input" placeholder="Xác nhận mật khẩu mới">
            </div>
        </div>

        <div id="password-error" class="text-danger">
            <?php if (!empty($err)): ?>
            <div class="error-message" style="color:red">
                <?= $err; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="?controller=auth&action=forgotPassword" class="text-decoration-underline text-secondary">Quên
                    mật khẩu?</a>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" name="update-password" class=" btn btn-primary">Cập nhật</button>
            </div>
        </div>
    </form>
</div>
<script>
$('#password-form').submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
        url: 'index.php?controller=home&action=updatePassword',
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showToast(response.message);
                setTimeout(() => {
                    window.location.href = "?controller=home&action=profile";
                }, 1000);
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
.wrapper-password {
    display: flex;
    flex-direction: column;
    gap: 20px;
    padding: 10px 40px;
    background-color: #fff;
    border-radius: 10px;
}

.wrapper-password .form-password {
    padding: 20px;

}

.wrapper-password h3 {
    font-size: 1.5rem;
    margin: 20px;
    color: gray;
}

.form-password .form-group {
    margin-bottom: 15px;
}

.form-password .form-control {
    border-radius: 5px;
    padding: 15px;
}


.form-password .form-check-label {
    margin-right: 15px;
}

.form-password .form-check-input {
    margin-right: 5px;
    padding: 10px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>