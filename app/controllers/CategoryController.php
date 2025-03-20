<?php
    require_once '../app/models/Category.php';
    class CategoryController {
        private $categoryModel;
        public function __construct() {
            $this->categoryModel = new Category();
        }
        public function index() {
            $category = $this->categoryModel->get_all_category();
            if(isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
                echo json_encode($category);
                exit; 
            }
            $content = '../app/views/pages/admin/category/category.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function addCategory() {
            if (isset($_POST['category_name'])) {
                $category_name = $_POST['category_name'];
                $this->categoryModel->add_category($category_name);
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
        }
        public function deleteCategory() {
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
        
                if ($this->categoryModel->delete_category($category_id)) {
                    echo json_encode(["status" => "success", "message" => "Xóa thành công!"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Lỗi khi xóa danh mục"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Thiếu ID danh mục"]);
            }
            exit;
        }
        
        public function updateCategory() {
            if (isset($_POST['category_id'])) {
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                $this->categoryModel->update_category($category_id, $category_name);
                echo json_encode(["status" => "success"]);
            } else {
                echo json_encode(["status" => "error"]);
            }
            // $content = '../app/views/pages/admin/category/update_category.php';
            // include_once "../app/views/layouts/admin.php";
        }
    }
?>