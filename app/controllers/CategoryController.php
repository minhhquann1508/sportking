<?php
    require_once '../app/models/Category.php';
    class CategoryController {
        private $categoryModel;
        public function __construct() {
            $this->categoryModel = new Category();
        }
        public function index() {
            $category = $this->categoryModel->get_all_category();
            $content = '../app/views/pages/admin/category.php';
            include_once "../app/views/layouts/admin.php";

        }
    }
?>