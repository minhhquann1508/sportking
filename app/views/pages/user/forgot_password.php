<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 450px;">
        <h4 class="text-center mb-4 text-primary">Quên Mật Khẩu</h4>
        <form id="forgot-password-form" method="post" action="">
            <div class="mb-3">
                <label for="login-email" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email_send" id="login-email"
                    placeholder="Nhập email của bạn" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Gửi mật khẩu</button>
            </div>

            <div class="text-center mt-3">
                <a href="?controller=auth" class="text-decoration-underline text-secondary">← Trở lại đăng
                    nhập</a>
            </div>
        </form>
    </div>
</div>
<script>
$('#forgot-password-form').on('submit', function(e) {
    e.preventDefault();

    let email = $('#login-email').val();

    $.ajax({
        url: '?controller=auth&action=forgotPassword',
        type: 'POST',
        data: {
            email_send: email
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showToast(response.message);
                setTimeout(() => {
                    window.location.href =
                        "?controller=home&action=logout";
                }, 1000);
            } else {
                showToast(response.message);
            }
        },
        error: function(xhr, status, error) {
            showToast("Có lỗi xảy ra. Vui lòng thử lại!");
        }
    });
});
</script>