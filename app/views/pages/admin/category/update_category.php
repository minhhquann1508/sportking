<?php
     if (isset($_POST['updateCategory'])) {
    $category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
    $new_category_name = $_POST['new_category_name'];
    $result =  $this->categoryModel->update_category($category_id, $new_category_name);
    if ($result === "Danh mục không tồn tại!") {
        echo $result; 
    } elseif ($result === "Tên danh mục đã tồn tại!") {
        echo $result; 
    } elseif ($result) {
        header('Location: index.php?controller=category');
    } else {
        echo "Cập nhật danh mục thất bại!";
    }
}
?>

<form method="POST">
    <input type="hidden" name="category_id" value="1">
    <div class="mb-3">
        <label for="new_category_name" class="form-label">Tên danh mục mới</label>
        <input type="text" class="form-control" id="new_category_name" name="new_category_name"
            placeholder="Nhập tên danh mục mới">
    </div>
    <div class="mb-3 text-end">
        <button type="submit" name="updateCategory" class="btn btn-primary">Cập nhật</button>
    </div>
</form