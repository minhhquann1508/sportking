<?php
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
            'url' => '',
            'children' => [
                ['label' => 'Danh sách danh mục', 'url' => '?controller=category'],
                ['label' => 'Thêm danh mục', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý thương hiệu',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách danh mục', 'url' => '#'],
                ['label' => 'Thêm danh mục', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý sản phẩm',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách sản phẩm', 'url' => '#'],
                ['label' => 'Thêm sản phẩm', 'url' => '#'],
                ['label' => 'Biến thể sản phẩm', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý người dùng',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách người dùng', 'url' => '/?controller=user'],
            ]
        ],
        [
            'label' => 'Quản lý đơn hàng',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách đơn hàng', 'url' => '#'],
                ['label' => 'Thống kê đơn hàng', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý bài viết',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách bài viết', 'url' => '#'],
                ['label' => 'Thêm bài viết', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý bình luận',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách bình luận', 'url' => '#'],
                ['label' => 'Bình luận bị xóa', 'url' => '#']
            ]
        ],
        [
            'label' => 'Quản lý banner',
            'url' => '',
            'children' => [
                ['label' => 'Danh sách banner', 'url' => '?controller=banner'],
            ]
        ]
    ];
    
    $sidebar = '<ul class="accordion" id="accordionExample">';
    $index = 0;

    foreach ($items as $menu) {
        $collapseId = "collapse" . $index; 
        $sidebar .= '
            <li class="my-1">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">
                            ' . $menu['label'] . '
                        </button>
                    </h2>
                    <div id="' . $collapseId . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <ul class="list-group">';
        
        if (!empty($menu['children'])) {
            foreach ($menu['children'] as $item) {
                $sidebar .= '<li class="list-group-item p-3">
                                <a class="d-block w-100" href="' . $item['url'] . '">' . $item['label'] . '</a>
                            </li>';
            }
        }

        $sidebar .= '</ul>
                    </div>
                </div>
            </li>';
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
    <!-- Style.css -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

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
            <a href="" class="d-flex justify-content-center">
                <img width="150" src="./img/sportking-logo.png" alt="">
            </a>
            <?php echo $sidebar; ?>
        </article>
        <div class="flex-grow-1">
            <div class="w-100 border-bottom p-3 d-flex justify-content-end align-items-center">
                <div class="dropdown">
                    <span class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Minh Quân
                    </span>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
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