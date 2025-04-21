<?php
    require_once '../app/models/Products.php';
    require_once '../app/models/Brand.php';
    require_once '../app/models/Category.php';
    class ProductController {
        private $productModel;
        private $brandModel;
        private $categoryModel;
        public function __construct() {
            $this->productModel = new Products();
            $this->brandModel = new Brand();
            $this->categoryModel = new Category();
        }
        public function index() {
            $brands = $this->brandModel->get_all_brands();
            $categories = $this->categoryModel->get_all_category();
            $content = '../app/views/pages/admin/product/product.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function get_list_products() {
            $page = $_GET['page'];
            $response = $this->productModel->get_all_products($page);
            echo json_encode($response);
        }

        public function detail() {
            echo '<div>Đây là trang chi tiết sản phẩm</div>';
        }

        public function add_product() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $product = $_POST;
                $response = $this->productModel->add_product($product);
                echo json_encode($response);
                exit;   
            } 
        }

        public function get_product_by_id() {
            if(isset($_GET['id']) && $_GET['id']) {
                $product_id =  (int) $_GET['id'];
                $response = $this->productModel->get_product_by_id($product_id);
                echo json_encode($response);
                exit;
            }
        }

        public function update_product_by_id() {
            if(isset($_POST['product_id']) && $_POST['product_id']) {
                $product_id = $_POST['product_id'];
                $product = $_POST['product'];
                $response = $this->productModel->update_product_by_id($product_id, $product);
                echo json_encode($response);
                exit;
            }
        }

        public function delete_product() {
            if(isset($_GET['id']) && $_GET['id']) {
                $product_id =  (int) $_GET['id'];
                $response = $this->productModel->delete_product($product_id);
                echo json_encode($response);
                exit;
            }
        }

        public function search_product() {
            $search_params = $_GET['search_params'];
            $response = $this->productModel->search_product($search_params);
            echo json_encode($response);
            exit;
        }
    }
?>