<?php
    require_once '../app/models/Users.php';
    require_once '../app/models/Products.php';
    require_once '../app/models/Order.php';

    class DashboardController {
        private $productModel;
        private $userModel;
        private $orderModel;
        public function __construct() {
            $this->productModel = new Products();
            $this->userModel = new User();
            $this->orderModel = new Order();
        }
        public function index() {
            $total_products = $this->productModel->total_products();
            $total_users = $this->userModel->total_users();
            $total_amount = $this->orderModel->get_total();
            $top_5_products = $this->productModel->top_5();
            $content = '../app/views/pages/admin/dashboard.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>