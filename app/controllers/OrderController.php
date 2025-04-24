<?php
require_once '../app/models/Order.php';

class OrderController
{
    private $orderModel;
    public function __construct()
    {
        $this->orderModel = new Order();
    }
    public function index()
    {
        $orders_list = $this->orderModel->orders_list();
        $order_items_list = $this->orderModel->orders_items_list();
        $content = '../app/views/pages/admin/order/order.php';
        include_once "../app/views/layouts/admin.php";
    }

    public function get_list_orders()
    {
        $page = $_GET['page'];
        $response = $this->orderModel->get_all_orders($page);
        echo json_encode($response);
    }

    public function get_order_by_id()
    {
        if (isset($_GET['id']) && $_GET['id']) {
            $product_id =  (int) $_GET['id'];
            $response = $this->orderModel->get_order_by_id($product_id);
            echo json_encode($response);
            exit;
        }
    }

    public function add_order()
    {
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
        if ($response['success'] == true) {
            $_SESSION['order_list'] = [];
            echo json_encode($response);
            exit;
        } else {
            echo json_encode($response);
            exit;
        }
    }

    public function get_detail_order()
    {
        $order_id = $_GET['order_id'];
        $response = $this->orderModel->get_order_by_id($order_id);
        echo json_encode($response);
        exit;
    }
}
