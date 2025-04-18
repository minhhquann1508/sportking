<?php
    require_once '../app/models/Order.php';

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

        public function add_order() {
            $address_id = $_POST['address_id'];
            $total_amount = $_POST['total_amount'];
            $items = $_SESSION['order_list'];
            $user_id = $_SESSION['user']['user_id'];
            $response = $this->orderModel->add_order($total_amount, $user_id, $address_id, $items);
            if($response['success'] == true) {
                $_SESSION['order_list'] = [];
                echo json_encode($response);
                exit;
            } else {
                echo json_encode($response);
                exit;
            }
        }

    }
?>