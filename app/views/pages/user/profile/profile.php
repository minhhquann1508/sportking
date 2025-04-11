<div class="container-lg mt-5 py-5">
    <div class="profile-main d-flex gap-3">
        <aside class="col-12 col-md-3 sidebar">
            <div class="infor-user">
                <div class="avatar-wrapper">
                    <img src="https://cdn0918.cdn4s1.com/media/blog-images/hinh-con-cho-meme/hinh-con-cho-meme-1.jpg"
                        alt="<?= $user['fullname'] ?>" title="<?= $user['fullname'] ?>" class="avatar-img">
                </div>
                <h5 class="mt-3"><?= $user['fullname'] ?></h5>
                <div class="level-user">
                    <p class="text-muted mb-0">
                        <i class="fa-solid fa-medal"></i> Thành viên bạc
                    </p>
                </div>
            </div>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" id="tab-profile" data-bs-toggle="pill" href="#personal-info" role="tab">
                        <i class="fa-regular fa-user"></i> Thông tin tài khoản
                    </a>
                    <ul class="nav nav-pills flex-column submenu ps-3">
                        <li>
                            <a href="#personal-info" class="nav-link active" data-bs-toggle="pill" role="tab">
                                <i class="fa-solid fa-user-circle"></i> Hồ sơ cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#address-book" class="nav-link" data-bs-toggle="pill" role="tab">
                                <i class="fa-solid fa-address-book"></i> Sổ địa chỉ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#change-password" data-bs-toggle="pill" role="tab" class="nav-link">
                                <i class="fa-solid fa-key"></i> Đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#order-history" class="nav-link" data-bs-toggle="pill" role="tab">
                        <i class="fa-solid fa-box"></i> Đơn hàng
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#nofication" class="nav-link" data-bs-toggle="pill" role="tab">
                        <i class="fa-solid fa-bell"></i> Thông báo
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#My-feedback" class="nav-link" data-bs-toggle="pill" role="tab">
                        <i class="fa-solid fa-comment"></i> Nhận xét của tôi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#account-settings" class="nav-link" data-bs-toggle="pill" role="tab">
                        <i class="fa-solid fa-cogs"></i> Cài đặt tài khoản
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?controller=home&action=logout" class="nav-link text-danger">
                        <i class="fa-solid fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </aside>

        <div class="main-content">
            <div class="tab-content">
                <section class="tab-pane fade show active" id="personal-info" role="tabpanel">
                    <?php include '_statistical-data.php' ?>
                </section>
                <section class="tab-pane fade" id="address-book" role="tabpanel">
                    <?php include '_address-profile.php' ?>
                </section>
                <section class="tab-pane fade" id="change-password" role="tabpanel">
                    <?php include '_change-pass.php' ?>
                </section>
                <section class="tab-pane fade" id="order-history" role="tabpanel">
                    <?php include 'orders/orders-profile.php' ?>
                </section>
                <section class="tab-pane fade" id="nofication" role="tabpanel">
                    <?php include 'nofication/nofication-profile.php' ?>
                </section>
                <section class="tab-pane fade" id="My-feedback" role="tabpanel">
                    <p>Bạn chưa có nhận xét nào.</p>
                </section>
                <section class="tab-pane fade" id="account-settings" role="tabpanel">
                    <h2 class="h5">Cài đặt tài khoản</h2>
                    <p>Chỉnh sửa thông tin tài khoản và mật khẩu tại đây.</p>
                </section>
            </div>
        </div>
    </div>
</div>
<style>
.infor-user {
    max-width: 300px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
}

.avatar-wrapper {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #ddd;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
    margin: auto;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* fit kiểu cover */
    display: block;
}

.infor-user h5 {
    font-size: 1.25rem;
    color: #333;
    margin-top: 15px;
    font-weight: 600;
}

.infor-user .level-user {
    width: 80%;
    font-size: 0.9rem;
    color: #888;
    margin: auto;
    background-color: #ccc;
    padding: 10px;
    border-radius: 50px;
}

.nav-link {
    color: #333;
    padding: 10px 15px;
    cursor: pointer;
}

.nav-link:hover {
    color: #C92127;
    background-color: transparent;
}

.nav-link.active {
    color: #C92127 !important;
    background-color: transparent !important;
    font-weight: bold;
}

.nav-pills .nav-link {
    border-radius: 0;
}

.sidebar {
    width: 25%;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

.profile-main {
    width: 100%;
    display: flex;
    justify-content: space-around;
    margin: 20px 5px;
}

.main-content {
    width: 75%;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const triggerTabList = document.querySelectorAll('.nav-link[data-bs-toggle="pill"]');
    triggerTabList.forEach(function(triggerEl) {
        triggerEl.addEventListener('click', function(e) {
            e.preventDefault();
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
        });
    });
});
</script>