<?php
require_once '../app/models/Home.php';
require_once '../app/models/Products.php';
require_once '../app/models/Brand.php';
require_once '../app/models/Order.php';
require_once '../app/models/Category.php';
require_once '../app/models/Users.php';
require_once '../app/models/Blog.php';
require_once '../app/models/Size.php';
require_once '../app/models/Color.php';
require_once '../app/models/Variant.php';
class HomeController
{
    private $productModel;
    private $brandModel;
    private $categoryModel;
    private $blogModel;
    private $homeModel;
    private $userModel;
    private $orderModel;
    private $sizeModel;
    private $colorModel;
    private $variantModel;
    public function __construct()
    {
        $this->homeModel = new Home();
        $this->productModel = new Products();
        $this->brandModel = new Brand();
        $this->blogModel = new Blog();
        $this->categoryModel = new Category();
        $this->userModel = new User();
        $this->orderModel = new Order();
        $this->variantModel = new Variant();
        $this->userModel = new User();
        $this->sizeModel = new Size();
        $this->colorModel = new Color();
    }
    public function index()
    {
        $categories = $this->homeModel->get_all_categorys();
        $brands = $this->homeModel->get_all_brands();
        $productList = $this->homeModel->get_all_products();

        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home2.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function product_detail()
    {
        $product_id = $_GET['product_id'] ?? null;
        $product = $this->productModel->get_product_by_id($product_id);
        $variant = $this->variantModel->get_all_variant_by_product_id($product_id);
        $productList = $this->homeModel->get_all_products();
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/detail.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function blog()
    {
        $categories = $this->homeModel->get_all_categorys();
        $blogList = $this->blogModel->get_all_blogs();
        $blogRelated = $this->blogModel->get_by_quantity();
        $content = '../app/views/pages/user/blog.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function blogdetail()
    {
        $id = $_GET['id'];
        $categories = $this->homeModel->get_all_categorys();
        $blogResult = $this->blogModel->get_blog_by_id($id);
        $blogDetail = $blogResult['data'];
        $blogRelated = $this->blogModel->get_by_quantity();
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

        $user_id = $_SESSION['user']['user_id'];
        $email = $_GET['email'] ?? $_SESSION['user']['email'];

        $user = $this->homeModel->getUserByEmail($email);
        $orders = $this->homeModel->get_all_order_by_user_id($user_id);

        if (!$user) {
            echo 'Không tìm thấy người dùng.';
            exit;
        }

        $orders_by_status = [];

        if ($orders['success']) {
            foreach ($orders['data'] as $item) {
                $id = $item['order_id'];
                $status = $item['status'];

                if (!isset($orders_by_status[$status][$id])) {
                    $orders_by_status[$status][$id] = [
                        'order_id' => $id,
                        'order_date' => $item['order_date'],
                        'status' => $status,
                        'products' => []
                    ];
                }

                $orders_by_status[$status][$id]['products'][] = [
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'thumbnail' => $item['thumbnail'],
                    'quantity' => $item['quantity']
                ];
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

    public function add_orders() {
       
        // Lấy thông tin
        $total_amount = $_POST['total_amount'];
        $user_id = $_POST['user_id'];
        $address_id = $_POST['address_id']; // sửa đúng chính tả
        $items = $_POST['items'];
        // Gọi model để thêm đơn hàng
        $response = $this->orderModel->add_order($total_amount, $user_id, $address_id, $items);
        echo json_encode($response);
        exit;
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

    public function test()
    {
        $content = '../app/views/pages/user/test.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function logout()
    {
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
        $categories = $this->homeModel->get_all_categorys();
        $blogList = $this->blogModel->get_all_blogs();
        $blogRelated = $this->blogModel->get_by_quantity();
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
