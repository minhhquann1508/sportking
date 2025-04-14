<?php
    require_once '../app/models/Size.php';
    require_once '../app/models/Category.php';
    class SizeController {
        private $sizeModel;
        private $categoryModel;

        public function __construct() {
            $this->sizeModel = new Size();
            $this->categoryModel = new Category();
        }
        public function index() {
            $categories = $this->categoryModel->get_all_category();
            $data = $this->sizeModel->get_all_sizes();
            if (isset($_GET['ajax']) && $_GET['ajax'] == true){
                // $data = array_merge($data, ['categories' => $categories]);
                echo json_encode($data);
                exit;
            }
            $content = '../app/views/pages/admin/size.php';
            include_once "../app/views/layouts/admin.php";
        }

        
        public function add_size_action(){
            $size_name = $_POST['size_name'];
            $category_id = $_POST['category_id'];
            $response = $this->sizeModel->add_size($size_name, $category_id);
            echo json_encode($response);
        }

        public function update_size_action(){
            $size_id= $_POST['size_id'] ;
            $size_name = $_POST['size_name'] ;
            $category_id = $_POST['category_id'] ;
            $response = $this->sizeModel->update_size($size_id, $size_name, $category_id);
            if ($size_id && $size_name && $category_id) {
               
                echo json_encode($response);
            } else {
                echo json_encode($response);
            }
            exit;
        }

        public function get_size_by_category() {
            $category_id = $_GET['category_id'];
            $response = $this->sizeModel->get_size_by_category($category_id );
            echo json_encode($response);
            exit;
        }

        public function delete_size(){
            $size_id = $_GET['size_id'];
            $result = $this->sizeModel->delete_size($size_id);
            if ($size_id) {
                echo json_encode($result);
            } else {
                echo json_encode($result);
            }
            exit;
        }
    }
?>