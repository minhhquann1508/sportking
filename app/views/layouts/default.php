<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Style.css -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
    <title>Document</title>
</head>
<style>
    header {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: transparent;
        transition: background 0.3s ease-in-out, transform 0.3s ease-in-out;
        z-index: 1000;
    }

    .header-scroll {
        background: white;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
</style>

<body>
    <div id="toast" class="toast bg-white" style="position: fixed; top: 32px; right: 20px; z-index: 50;" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto">SportKing</strong>
            <!-- <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button> -->
        </div>
        <div class="toast-body" id="toast-mesage">
        </div>
    </div>
    <header class="">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="#">
                <img src="./img/logo.png" alt="Logo" width="150px">
            </a>

            <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <ul class="d-none d-lg-flex align-items-center gap-3 mb-0">
                <li class="nav-item dropdown">
                    <a class="  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Danh mục
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="  dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Thương hiệu
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a class=" " href="#">Giới thiệu</a></li>
                <li class="nav-item"><a class=" " href="#">Liên hệ</a></li>
            </ul>

            <div class="collapse navbar-collapse d-lg-none" id="navbarNav">
                <ul class="navbar-nav bg-white shadow rounded p-3">
                    <li class="nav-item"><a class=" " href="#">Danh mục</a></li>
                    <li class="nav-item"><a class=" " href="#">Thương hiệu</a></li>
                    <li class="nav-item"><a class=" " href="#">Giới thiệu</a></li>
                    <li class="nav-item"><a class=" " href="#">Liên hệ</a></li>
                </ul>
            </div>

            <div class="d-flex gap-3">
                <div class="">
                    <a href="#"><img src="./img/search.svg" width="20"></a>
                </div>

                <div class="">
                    <a href="#"><img src="./img/heart.svg" width="20"></a>
                </div>

                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown"><img src="./img/user.svg" width="20"></a>
                    <ul class="dropdown-menu text-center" style="left: 50%; transform: translateX(-50%); width: max-content;">
                        <?php
                        if (isset($_SESSION['email'])) {
                        ?>
                            <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                            <li><a class="dropdown-item" href="#">Quản lý đơn hàng</a></li>
                            <li><a class="dropdown-item text-danger" href="logout.php">Đăng xuất</a></li>
                        <?php
                        } else {
                        ?>
                            <li><a class="dropdown-item" href="login.php">Đăng nhập</a></li>
                            <li><a class="dropdown-item" href="register.php">Đăng kí</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>


                <div class=" position-relative">
                    <a href="#">
                        <img src="./img/cart.svg" width="20">
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                    </a>
                </div>
            </div>

        </nav>
    </header>

    <?php include_once $content ?>
    <footer>footer</footer>
    <!-- JS -->
    <script src="./js/main.js"></script>
    <!-- BS5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let lastScrollY = window.scrollY;
        const header = document.querySelector("header");

        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                header.classList.add("header-scroll");
            } else {
                header.classList.remove("header-scroll");
            }

            if (window.scrollY > lastScrollY) {
                header.classList.add("header-hidden"); // Ẩn header khi cuộn xuống
            } else {
                header.classList.remove("header-hidden");
            }
            lastScrollY = window.scrollY;
        });
    </script>
</body>

</html>