<?php
    require_once '../app/models/Category.php';
    class CategoryController {
        private $categoryModel;
        public function __construct() {
            $this->categoryModel = new Category();
        }
        public function index() {
            $category = $this->categoryModel->get_all_category();
            if(isset($_GET['ajax']) && $_GET['ajax']) {
                echo json_encode($category);
                exit; 
            }
            $content = '../app/views/pages/admin/category/category.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function addCategory() {
            if (isset($_POST['category_name'])) {
                $category_name = $_POST['category_name'];
                // Kiểm tra xem danh mục đã tồn tại chưa
                if ($this->categoryModel->check_name($category_name)) {
                    echo json_encode(['success' => false, 'message' => 'Danh mục đã tồn tại', 'data' => null]);
                    exit;
                }else{
                    if ($this->categoryModel->add_category($category_name)) {
                        echo json_encode(['success' => true, 'message' => 'Thêm thành công!', 'data' => null]);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'message' => 'Thêm thất bại, danh mục đã tồn tại', 'data' => null]);
                        exit;
                    }
                }
            }
        }
        public function deleteCategory() {
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];
        
                if ($this->categoryModel->delete_category($category_id)) {
                    echo json_encode(['success' => true, 'message' => 'Xóa thành công!', 'data' => null]);
                    exit;
                } else {
                    echo json_encode(['success' => true, 'message' => 'Lỗi khi xóa danh mục!', 'data' => null]);
                    exit;
                }
            }
            exit;
        }
        
        public function updateCategory() {
            if (isset($_POST['category_id'])) {
                $category_id = $_POST['category_id'];
                $category_name = $_POST['category_name'];
                if ($this->categoryModel->update_category($category_id, $category_name)) {
                    echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!', 'data' => null]);
                    exit;
                } else {
                    echo json_encode(['success' => true, 'message' => 'Cập nhật không thành công!!', 'data' => null]);
                    exit;
                }
            }
            exit;
        }

        
    }
?>