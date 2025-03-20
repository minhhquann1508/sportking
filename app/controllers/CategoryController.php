<?php
    require_once '../app/models/Category.php';
    class CategoryController {
        private $categoryModel;
        public function __construct() {
            $this->categoryModel = new Category();
        }
        public function index() {
            $category = $this->categoryModel->get_all_category();
            $content = '../app/views/pages/admin/category/category.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function addCategory() {
            $content = '../app/views/pages/admin/category/add_category.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function deleteCategory() {
            $content = '../app/views/pages/admin/category/delete_category.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function updateCategory() {
            $content = '../app/views/pages/admin/category/update_category.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>