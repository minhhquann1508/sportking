<?php
    $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
    $result = $this->categoryModel->delete_category($category_id);
    if ($result === "Danh mục không tồn tại!") {
        echo $result; 
    } elseif ($result) {
        header('Location: index.php?controller=category');
        exit();
    } else {
        echo "Xóa danh mục thất bại!";
    }
?>