<?php
    require_once '../app/models/Order.php';

    class OrderController {
        private $orderModel;
        public function __construct() {
            $this->orderModel = new Order();
        }
        public function index() {
            echo '<div>Đây là trang danh sách địa chỉ</div>';
        }

        public function add_order() {
            $address_id = $_POST['address_id'];
            $total_amount = $_POST['total_amount'];
            $items = $_SESSION['order_list'];
            $user_id = $_SESSION['user']['user_id'];
            $email = $_SESSION['user']['email'];
            $response = $this->orderModel->add_order(
                $total_amount, 
                $user_id,
                $email,
                $address_id,
                $items
            );
            if($response['success'] == true) {
                $_SESSION['order_list'] = [];
                echo json_encode($response);
                exit;
            } else {
                echo json_encode($response);
                exit;
            }
        }

        public function get_detail_order() {
            $order_id = $_GET['order_id'];
            $response = $this->orderModel->get_order_by_id($order_id);
            echo json_encode($response);
            exit;
        }
    }
?>