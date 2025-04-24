<?php
    if(!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
        header('Location: ?controller=home');
    }
    $items = [
        [
            'label' => 'Thống kê',
            'url' => '',
            'children' => [
                ['label' => 'Doanh thu', 'url' => ''],
                ['label' => 'Sản phẩm bán chạy', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý danh mục',
            'url' => '?controller=category',
        ],
        [
            'label' => 'Quản lý thương hiệu',
            'url' => '?controller=brand',
        ],
        [
            'label' => 'Quản lý sản phẩm',
            'url' => '?controller=product',
            'children' => [
                ['label' => 'Danh sách sản phẩm', 'url' => '?controller=product'],
                ['label' => 'Quản lý size', 'url' => '?controller=size'],
                ['label' => 'Quản lý màu sắc', 'url' => '?controller=color'],
            ]
        ],
        [
            'label' => 'Quản lý người dùng',
            'url' => '?controller=user',
        ],
        [
            'label' => 'Quản lý đơn hàng',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách đơn hàng', 'url' => '?controller=order'],
                ['label' => 'Thống kê đơn hàng', 'url' => '?controller=order&action=test']
            ]
        ],
        [
            'label' => 'Quản lý bài viết',
            'url' => '?controller=blog',
        ],
        [
            'label' => 'Quản lý bình luận',
            'url' => '?controller=comment',
        ],
        [
            'label' => 'Quản lý banner',
            'url' => '?controller=banner',
            
        ],
        [
            'label' => 'Quản lý voucher',
            'url' => '?controller=voucher',
            
        ]
    ];
    
    $sidebar = '<ul class="accordion" id="accordionExample">';
    $index = 0;

    foreach ($items as $menu) {
        $collapseId = "collapse" . $index;

        if (!empty($menu['children'])) {
            // Accordion with children
            $sidebar .= '
            <li class="my-1">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '"
                            >
                            ' . $menu['label'] . '
                        </button>
                    </div>
                    <div id="' . $collapseId . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <ul class="list-group">';
            foreach ($menu['children'] as $item) {
                $sidebar .= '<li class="list-group-item p-3">
                                <a class="d-block w-100" style="font-weight: normal" href="' . $item['url'] . '">' . $item['label'] . '</a>
                            </li>';
            }
            $sidebar .= '</ul>
                    </div>
                </div>
            </li>';
        } else {
            // Just a direct link
            $sidebar .= '
            <li class="my-1">
                <a class="btn w-100 text-start border p-3" href="' . $menu['url'] . '">' . $menu['label'] . '</a>
            </li>';
        }

        $index++;
    }
    $sidebar .= '</ul>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BS5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- CKEDITOR -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/froala-editor/js/froala_editor.pkgd.min.js"></script>
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Chart JS-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Style.css -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>
<style>
.modal-dialog {
    max-width: 900px;
}

.modal-dialog .modal-content {
    padding: 10px 20px;
    background-color: #f2f2f2;
}

.modal-dialog .form-label {
    color: black;
    font-weight: 900;
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
    <div class="d-flex">
        <article class="border-end p-2" style=" width: 250px; height: 100vh">
            <a href="?controller=home" class="d-flex justify-content-center mt-3 mb-3">
                <img width="150" src="./img/logo.png" alt="">
            </a>
            <?php echo $sidebar; ?>
        </article>
        <div class="flex-grow-1">
            <div class="w-100 border-bottom p-3 d-flex justify-content-end align-items-center">
                <div class="dropdown">
                    <span>
                        Xin chào, <?= $_SESSION['user']['email'] ?>, <a href="?controller=home&action=logout">Đăng
                            xuất</a>
                    </span>
                    <!-- <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul> -->
                </div>
            </div>
            <main class="p-3">
                <?php include_once $content; ?>
            </main>
        </div>
    </div>
    <!-- JS -->
    <script src="./js/main.js"></script>
    <script src="./js/category.js"></script>
    <!-- CKEDITOR -->
    <script>
    new FroalaEditor('#editor');
    new FroalaEditor('#updated_editor');
    </script>
    <!-- BS5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>