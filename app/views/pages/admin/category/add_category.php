<?php
ob_start(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['category_name'])) {
        $category_name = trim($_POST['category_name']);
        if (!empty($category_name)) {
            $result = $this->categoryModel->add_category($category_name);
            if ($result) {
                header('Location: index.php?controller=category');
                exit();
            } else {
                echo "Thêm danh mục thất bại!";
            }
        } else {
            echo "Tên danh mục không được để trống!";
        }
    } else {
        echo "Dữ liệu không hợp lệ!";
    }
}

ob_end_flush(); 
?>