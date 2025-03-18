<?php
    $arr = [
        'Thống kê' => [
            ['label' => 'Doanh thu', 'url' => '#'],
            ['label' => 'Sản phẩm bán chạy', 'url' => '#']
        ],
        'Quản lý danh mục' => [
            ['label' => 'Danh sách danh mục', 'url' => '#'],
            ['label' => 'Thêm danh mục', 'url' => '#']
        ],
        'Quản lý thương hiệu' => [
            ['label' => 'Danh sách danh mục', 'url' => '#'],
            ['label' => 'Thêm danh mục', 'url' => '#']
        ],
        'Quản lý sản phẩm' => [
            ['label' => 'Danh sách sản phẩm', 'url' => '#'],
            ['label' => 'Thêm sản phẩm', 'url' => '#'],
            ['label' => 'Biến thể sản phẩm', 'url' => '#']
        ],
        'Quản lý người dùng' => [
            ['label' => 'Danh sách sản phẩm', 'url' => '#'],
            ['label' => 'Thêm sản phẩm', 'url' => '#'],
            ['label' => 'Biến thể sản phẩm', 'url' => '#']
        ],
        'Quản lý đơn hàng' => [
            ['label' => 'Danh sách đơn hàng', 'url' => '#'],
            ['label' => 'Thống kê đơn hàng', 'url' => '#']
        ],
        'Quản lý bài viết' => [
            ['label' => 'Danh sách bài viết', 'url' => '#'],
            ['label' => 'Thêm bài viết', 'url' => '#']
        ],
        'Quản lý bình luận' => [
            ['label' => 'Danh sách bình luận', 'url' => '#'],
            ['label' => 'Bình luận bị xóa', 'url' => '#']
        ],
        'Quản lý banner' => [
            ['label' => 'Danh sách banner', 'url' => '#'],
            ['label' => 'Thêm banner', 'url' => '#']
        ],
        
    ];
    
    $sidebar = '<ul class="accordion" id="accordionExample">';
    $index = 0;
    foreach ($arr as $key => $value) {
        $collapseId = "collapse" . $index; // Tạo ID duy nhất cho mỗi accordion
        $sidebar .= '
            <li class="my-1">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#' . $collapseId . '" aria-expanded="false" aria-controls="' . $collapseId . '">
                            ' . $key . '
                        </button>
                    </h2>
                    <div id="' . $collapseId . '" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <ul class="list-group">';
        foreach ($value as $item) {
            $sidebar .= '<li class="list-group-item p-3"><a href="' . $item['url'] . '">' . $item['label'] . '</a></li>';
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
    <!-- Style.css -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Document</title>
</head>

<body>
    <div class="d-flex">
        <article class="border-end p-2" style=" width: 250px; height: 100vh">
            <a href="" class="d-flex justify-content-center">
                <img width="150" src="./img/sportking-logo.png" alt="">
            </a>
            <?php echo $sidebar; ?>
        </article>
        <div class="flex-grow-1">
            <div class="w-100 border-bottom p-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0">Trang thống kê</h6>
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
                <?php include_once $content ?>
            </main>
        </div>
    </div>

    <!-- BS5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>