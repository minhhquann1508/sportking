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
    max-width: 1200px;
    margin: 30px auto;
    padding: 30px;
    background: #fdfdfd;
    border-radius: 12px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
}

.wrapper-password h3 {
    font-size: 24px;
    font-weight: 600;
    color: #333;
    margin-bottom: 30px;
    text-align: left;
}

.form-password .form-group {
    margin-bottom: 20px;
}

.form-password label {
    font-weight: 500;
    color: #555;
    margin-bottom: 6px;
    display: inline-block;
}

.form-password .form-control {
    border-radius: 8px;
    padding: 12px 15px;
    border: 1px solid #ccc;
    transition: all 0.3s ease-in-out;
    font-size: 16px;
}

.form-password .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.3);
    outline: none;
}

#password-error .error-message {
    color: #d9534f;
    font-size: 14px;
    margin-top: 10px;
}

.form-password a.text-decoration-underline {
    font-size: 14px;
    color: #6c757d;
}

.form-password .btn {
    padding: 12px 25px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 500;
}

@media (max-width: 768px) {
    .wrapper-password {
        padding: 20px;
    }

    .form-group.row {
        display: flex;
        flex-direction: column;
    }

    .form-group.row label {
        margin-bottom: 6px;
    }

    .form-group.row .col-sm-10,
    .form-group.row .col-sm-2 {
        width: 100%;
    }

    .form-group.row .col-sm-10.offset-sm-2 {
        margin-left: 0;
    }

    .form-password .btn {
        width: 100%;
    }

    .form-password .form-check-input {
        margin-right: 8px;
    }

    .form-password a.text-decoration-underline {
        display: inline-block;
        margin-top: 10px;
    }
}
</style>