<?php
    class OrderController {
        private $orderModel;
        public function __construct() {
            $this->orderModel = new Order();
        }
        public function index() {
            echo '<div>Đây là trang danh sách địa chỉ</div>';

            // $content = '../app/views/pages/user/order.php';
            // $header = '../app/views/layouts/_header.php';
            // $footer = '../app/views/layouts/_footer.php';
            // include_once "../app/views/layouts/default2.php";

        }
    }
?>