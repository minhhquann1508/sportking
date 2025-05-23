<?php
require_once '../app/models/Category.php';

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    public function index() {
        $filterName = isset($_GET['filterName']) ? trim($_GET['filterName']) : "";
        $filterCreated = isset($_GET['filterCreated']) ? trim($_GET['filterCreated']) : "";
        $filterUpdated = isset($_GET['filterUpdated']) ? trim($_GET['filterUpdated']) : "";
    
        $categories = $this->categoryModel->get_all_category($filterName, $filterCreated, $filterUpdated);
    
        if (isset($_GET['ajax']) && $_GET['ajax']) {
            echo json_encode($categories);
            exit;
        }
    
        $content = '../app/views/pages/admin/category.php';
        include_once "../app/views/layouts/admin.php";
    }
    

    public function addCategory() {
        if (isset($_POST['category_name'])) {
            $category_name = trim($_POST['category_name']);

            if ($this->categoryModel->check_name($category_name)) {
                echo json_encode(['success' => false, 'message' => 'Danh mục đã tồn tại!', 'data' => null]);
                exit;
            }

            if ($this->categoryModel->add_category($category_name)) {
                echo json_encode(['success' => true, 'message' => 'Thêm thành công!', 'data' => null]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm thất bại!', 'data' => null]);
            }
            exit;
        }
    }

    public function deleteCategory() {
        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];

            if ($this->categoryModel->delete_category($category_id)) {
                echo json_encode(['success' => true, 'message' => 'Xóa thành công!', 'data' => null]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Lỗi khi xóa danh mục!', 'data' => null]);
            }
            exit;
        }
    }

    public function updateCategory() {
        if (isset($_POST['category_id']) && isset($_POST['category_name'])) {
            $category_id = $_POST['category_id'];
            $category_name = trim($_POST['category_name']);

            if ($this->categoryModel->check_name($category_name, $category_id)) {
                echo json_encode(['success' => false, 'message' => 'Danh mục đã tồn tại!', 'data' => null]);
                exit;
            }

            if ($this->categoryModel->update_category($category_id, $category_name)) {
                echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!', 'data' => null]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Cập nhật không thành công!', 'data' => null]);
            }
            exit;
        }
    }
}
?>