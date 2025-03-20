<style>
.form-content {
    width: 850px;
    height: 550px;
    box-shadow: 0 0 2px 0 rgba(0, 0, 0, 0.2);
    border-radius: 24px;
    overflow: hidden;
}
</style>

<main class="d-flex justify-content-center align-items-center py-5">
    <div class="form-content row align-items-center">
        <div class="col">
            <form id="register-form" class="px-4" method="post">
                <h3 class="text-center mb-3">Đăng ký</h3>
                <div class="mb-3">
                    <label for="email" class="form-label">Địa chỉ email</label>
                    <input name="email" type="email" class="form-control" placeholder="abc@gmail.com" id="email"
                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input name="password" type="password" class="form-control" placeholder="Nhập vào mật khẩu của bạn"
                        id="password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" name="confirm_password" class="form-control"
                        placeholder="Nhập lại mật khẩu của bạn" id="confirm_password">
                </div>
                <?php if (!empty($error)): ?>
                <div id="server-error" class="text-danger mb-3"><?php echo $error; ?></div>
                <?php endif; ?>
                <input type="button" id="register-btn" value="Đăng ký ngay" class="btn btn-primary w-100">
                <div id="server-message" class="text-success mt-2"></div>
                <div id="server-error" class="text-danger mt-2"></div>
            </form>
        </div>
        <div class="col bg-dark d-flex justify-content-center align-items-center"
            style="height: 100%; border-top-left-radius: 80px;border-bottom-left-radius: 80px;">
            <div class="text-white text-center">
                <h5>Chào mừng bạn đến với KingSport</h5>
                <p>Bạn đã có tài khoản ?</p>
                <button class="btn btn-primary"><a class="text-white" href="?controller=auth">Đăng nhập
                        ngay</a></button>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    var toast = $('#toast');
    toast.hide();
    $("#register-btn").click(function() {
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirm_password").val();
        var toastMess = $('#toast-mesage');
        if (password !== confirmPassword) {
            toast.show();
            toastMess.text('Mật khẩu không trùng khớp');
            return;
        }
        $.ajax({
            url: "?controller=auth&action=register",
            type: "POST",
            data: {
                email: email,
                password: password,
                confirm_password: confirmPassword,
                register: true
            },
            success: function(response) {
                if (response.success === true) {
                    $("#email").val('');
                    $("#password").val('');
                    $("#confirm_password").val('')
                    toast.show();
                    toastMess.text(response.message);
                    setTimeout(() => {
                        window.location.href = "?controller=auth";
                    }, 1000);
                } else {
                    toast.show();
                    toastMess.text(response.responseText);
                }
            },
            error: function(response) {
                toast.show();
                toastMess.text(response.responseText);
            }
        });
    });
});
</script>