<?php
    require_once '../app/models/Products.php';
    class ProductController {
        private $productModel;
        public function __construct() {
            $this->productModel = new Products();
        }
        public function index() {
            $products = $this->productModel->get_all_products();
            print_r($products);
            echo '<div>Đây là trang sản phẩm</div>';
        }
        public function detail() {
            echo '<div>Đây là trang chi tiết sản phẩm</div>';
        }
    }
?>