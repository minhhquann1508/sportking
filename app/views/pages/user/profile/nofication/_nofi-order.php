<div class="container-lg mt-5 py-5">
    <div class="row profile-main">
        <aside class="col-12 col-md-4 col-lg-3 sidebar mb-4 mb-md-0" id="sidebar">
            <div class="infor-user">
                <div class="avatar-wrapper">
                    <img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/background_silver.png"
                        alt="<?= $user['fullname'] ?>" title="<?= $user['fullname'] ?>" class="avatar-img">
                </div>
                <h5 class="mt-3"><?= $user['fullname'] ?></h5>
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
                    <a href="#My-feedback" class="nav-link" data-bs-toggle="pill" role="tab">
                        <i class="fa-solid fa-comment"></i> Nhận xét của tôi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="?controller=home&action=logout" class="nav-link text-danger">
                        <i class="fa-solid fa-sign-out-alt"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </aside>

        <div class="col-12 col-md-8 col-lg-9 main-content">
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
                <section class="tab-pane fade" id="My-feedback" role="tabpanel">
                    <?php include 'feedback/feedback.php'?>
                </section>
            </div>
        </div>
    </div>
</div>
<style>
.infor-user {
    text-align: center;
    padding: 20px;
}

.avatar-wrapper {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    overflow: hidden;
    margin: auto;
    border: 3px solid #ddd;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.sidebar {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.nav-link {
    background-color: none;
    color: #333;
    display: flex;
    align-items: center;
    padding: 12px;
    font-size: 0.95rem;
}

.nav-link.active {
    background-color: none;
    color: #C92127;
    font-weight: bold;
}

.submenu .nav-link {
    font-size: 0.9rem;
    padding-left: 30px;
}

.tab-content .tab-pane {
    display: none;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.4s ease;
}

.tab-content .tab-pane.active.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

.fade-in-up {
    animation: fadeInUp 0.4s ease both;
}

@keyframes fadeInUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 767.98px) {
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 80%;
        background: white;
        z-index: 999;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }

    .sidebar.show {
        transform: translateX(0);
    }

    .menu-toggle {
        position: fixed;
        top: 10px;
        left: 10px;
        z-index: 1000;
        background: #C92127;
        color: #fff;
        border: none;
        padding: 10px 12px;
        border-radius: 6px;
    }

    .main-content {
        margin-top: 70px;
    }
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const triggerTabList = document.querySelectorAll('.nav-link[data-bs-toggle="pill"]');
    const currentHash = window.location.hash;
    if (currentHash) {
        const activeTabLink = document.querySelector(`.nav-link[href="${currentHash}"]`);
        if (activeTabLink) {
            const tab = new bootstrap.Tab(activeTabLink);
            tab.show();
            const tabTarget = document.querySelector(currentHash);
            if (tabTarget) {
                setTimeout(() => tabTarget.classList.add('fade-in-up'), 100);
            }
        }
    }

    triggerTabList.forEach(triggerEl => {
        triggerEl.addEventListener('click', function(e) {
            e.preventDefault();
            const targetSelector = triggerEl.getAttribute('href');
            history.pushState(null, '', targetSelector);
            const tab = new bootstrap.Tab(triggerEl);
            tab.show();
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove(
                'fade-in-up'));
            const tabTarget = document.querySelector(targetSelector);
            if (tabTarget) {
                setTimeout(() => tabTarget.classList.add('fade-in-up'), 100);
            }
            document.querySelector('#sidebar')?.classList.remove('show');
        });
    });

    const menuBtn = document.createElement('button');
    menuBtn.className = 'menu-toggle d-md-none';
    menuBtn.innerHTML = '<i class="fa fa-bars"></i>';
    document.body.appendChild(menuBtn);

    const sidebar = document.getElementById('sidebar');
    menuBtn.addEventListener('click', () => {
        sidebar.classList.toggle('show');
    });
});
</script>