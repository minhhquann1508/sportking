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
            <form class="px-4">
                <h3 class="text-center mb-3">Đăng nhập</h3>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Địa chỉ email</label>
                    <input type="email" class="form-control" placeholder="abc@gmail.com" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" placeholder="Nhập vào mật khẩu của bạn"
                        id="exampleInputPassword1">
                </div>
                <div class="mb-3 d-flex justify-content-between" style="font-size: 13px;">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Ghi nhớ tài khoản</label>
                    </div>
                    <a href="">Quên mật khẩu</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập ngay</button>
            </form>
        </div>
        <div class="col bg-dark d-flex justify-content-center align-items-center"
            style="height: 100%; border-top-left-radius: 80px;border-bottom-left-radius: 80px;">
            <div class="text-white text-center">
                <h5>Chào mừng bạn đến với KingSport</h5>
                <p>Bạn chưa có tài khoản ?</p>
                <button class="btn btn-primary"><a class="text-white" href="?controller=auth&action=register">Đăng ký
                        ngay</a></button>
            </div>
        </div>
    </div>
</main>