<?php
require_once '../app/models/Home.php';
require_once '../app/models/Users.php';
class HomeController
{
    private $homeModel;
    private $userModel;
    public function __construct() {
        $this->homeModel = new Home();
        $this->userModel = new User();
    }
    public function index()
    {
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home2.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function detail() {
        $content = '../app/views/pages/user/detail.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function blogdetail() {
        $content = '../app/views/pages/user/blogdetail.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function about()
    {
        $content = '../app/views/pages/user/about.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function product()
    {
        // Lấy các tham số từ GET
        $category = isset($_POST['category']) ? $_POST['category'] : '';
        $brand = isset($_POST['brand']) ? $_POST['brand'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : '';

        $productList = $this->homeModel->get_filtered_products($category, $brand, $price);
        $categories = $this->homeModel->get_all_categorys();
        $brands = $this->homeModel->get_all_brands();

        $content = '../app/views/pages/user/product.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function profile()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth");
            exit;
        }

        $email = $_GET['email'] ?? $_SESSION['user']['email'];
        $user_id = $_SESSION['user']['user_id'];

        $user = $this->homeModel->getUserByEmail($email);
        $orders = $this->homeModel->get_all_order_by_user_id($user_id);

        if (!$user) {
            echo 'Không tìm thấy người dùng với email này.';
            exit;
        }

        $orders_by_status = [
            'Chưa xác nhận' => [],
            'Đã xác nhận' => [],
            'Đang giao' => [],
            'Đã giao' => [],
            'Đã trả' => [],
            'Đã hủy' => [],
        ];

        if ($orders['success']) {
            $order_map = [];

            foreach ($orders['data'] as $row) {
                $order_id = $row['order_id'];

                if (!isset($order_map[$order_id])) {
                    $order_map[$order_id] = [
                        'order_id' => $row['order_id'],
                        'status' => $row['status'],
                        'order_date' => $row['order_date'],
                        'products' => [],
                    ];
                }

                $order_map[$order_id]['products'][] = [
                    'product_name' => $row['product_name'],
                    'price' => $row['price'],
                    'thumbnail' => $row['thumbnail'],
                    'quantity' => $row['quantity'],
                ];
            }

            foreach ($order_map as $order) {
                $orders_by_status[$order['status']][] = $order;
            }
        }

        $content = '../app/views/pages/user/profile/profile.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $fullname = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';

            $result = $this->homeModel->updateUser($fullname, $email, $phone);
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
    public function updateAddress()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $city = $_POST['city'] ?? '';
            $district = $_POST['district'] ?? '';
            $ward = $_POST['ward'] ?? '';
            $street = $_POST['street'] ?? '';
            $userId = $_SESSION['user']['user_id']; 

            $result = $this->homeModel->updateUserAddress($city, $district, $ward, $street, $userId);

            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }
    public function updatePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old_password = $_POST['old_password'] ?? '';
            $new_password = $_POST['new_password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $email = $_GET['email'] ?? $_SESSION['user']['email'];

            $user = $this->homeModel->getUserByEmail($email);

            if (!$user) {
                echo json_encode(['success' => false, 'message' => 'Tài khoản không tồn tại', 'data' => null]);
            } elseif (!password_verify($old_password, $user['password'])) {
                echo json_encode(['success' => false, 'message' => 'Mật khẩu cũ không đúng', 'data' => null]);
            } elseif ($new_password !== $confirm_password) {
                echo json_encode(['success' => false, 'message' => 'Mật khẩu xác nhận không khớp', 'data' => null]);
            } else {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $result = $this->homeModel->updateUserPassword($email, $hashed_password);

                header('Content-Type: application/json');
                echo json_encode($result);
            }
            exit;
        }
    }

    public function order()
    {
        $content = '../app/views/pages/user/order.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function checkout()
    {
        $content = '../app/views/pages/user/checkout.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }


    public function logout() {
        session_unset();
        session_destroy();

        if (isset($_COOKIE['remember_token'])) {
            setcookie('remember_token', '', time() - 3600, '/');
        }
        header("Location: ?controller=auth");
        exit;
    }
    public function blog()
    {
        $content = '../app/views/pages/user/blog.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function contact()
    {
        $content = '../app/views/pages/user/contact.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
}