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
    }
?>