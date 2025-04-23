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
require_once '../app/models/Address.php';
require_once '../app/models/Voucher.php';

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
    private $addressModel;
    private $voucherModel;
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
        $this->addressModel = new Address();
        $this->voucherModel = new Voucher();
    }
    public function index()
    {
        $categories = $this->homeModel->get_all_categorys();
        $brands = $this->homeModel->get_all_brands();
        $variant_list = $this->variantModel->get_variant_list();


        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/home2.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function get_variant()
    {
        if (isset($_POST['color_id']) && isset($_POST['size_id'])) {
            $color_id = $_POST['color_id'];
            $size_id = $_POST['size_id'];

            $variant = $this->variantModel->get_variant_by_color_size($color_id, $size_id);
            echo json_encode($variant);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu tham số color_id hoặc size_id',
                'data' => null
            ]);
        }
    }
    public function product_detail()
    {
        $variant_id = $_GET['variant_id'] ?? null;
        $product_id = $_GET['product_id'] ?? null;
        $variant_detail = $this->variantModel->get_all_variant_by_id($variant_id);
        $variant_detail_list = $this->productModel->get_all_variants_by_product_id($product_id);
        $variant_list = $this->variantModel->get_variant_list();
        $header = '../app/views/layouts/_header.php';
        $content = '../app/views/pages/user/detail.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }
    public function quickview()
    {
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];

            // $product = $this->productModel->get_product_by_id($product_id);
            $variant = $this->variantModel->get_all_variant_by_product_id($product_id);

            $data = [
                // 'product' => $product['data'],
                'variant' => $variant['data'][0] ?? []
            ];
        } else {
            echo "<p>Không tìm thấy sản phẩm.</p>";
        }
        require_once '../app/views/layouts/quickview.php';
    }

    // public function blog()
    // {
    //     $categories = $this->homeModel->get_all_categorys();
    //     $blogList = $this->blogModel->get_all_blogs();
    //     $blogRelated = $this->blogModel->get_by_quantity();
    //     $content = '../app/views/pages/user/blog.php';
    //     $header = '../app/views/layouts/_header.php';
    //     $footer = '../app/views/layouts/_footer.php';
    //     include_once "../app/views/layouts/default2.php";
    // }
    public function blogdetail()
    {
        $id = $_GET['id'];
        $productList = $this->homeModel->get_all_products();
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

    public function payment_by_zalo_pay($total_amount,$items) {
        // echo "<pre>";
        // print_r(json_encode($items));
        // echo "</pre>";

        try {
            $config = [
                "app_id" => 2553,
                "key1" => "PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL",
                "key2" => "kLtgPl8HHhfvMuDHPwKfgfsY4Ydm9eIz",
                "endpoint" => "https://sb-openapi.zalopay.vn/v2/create"
            ];
            $ngrok_port = "https://abec-183-80-10-41.ngrok-free.app";
            
            $embeddata = json_encode(['redirecturl' => $ngrok_port.'/sportking/public/?controller=home&action=checkout']);
            $items = json_encode($items); 
            // $items = json_decode($items);
            // echo $items;
            $transID = rand(0,1000000);
            $order = [
                "app_id" => $config["app_id"],
                "app_time" => round(microtime(true) * 1000),
                "app_trans_id" => date("ymd") . "_" . $transID,
                "app_user" => "user123",
                "item" => $items,
                "embed_data" => $embeddata,
                "amount" => $total_amount,
                "description" => "Lazada - Payment for the order #$transID",
                "bank_code" => "",
                "callback_url" => $ngrok_port."/callback.php", 
            ];
            
            
            $data = $order["app_id"] . "|" . $order["app_trans_id"] . "|" . $order["app_user"] . "|" . $order["amount"]
                . "|" . $order["app_time"] . "|" . $order["embed_data"] . "|" . $order["item"];
            $order["mac"] = hash_hmac("sha256", $data, $config["key1"]);
            
            $context = stream_context_create([
                "http" => [
                    "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                    "method" => "POST",
                    "content" => http_build_query($order)
                ]
            ]);
            
            $resp = file_get_contents($config["endpoint"], false, $context);
            $result = json_decode($resp, true);
            
            if($result['return_code'] == 1){
                // Instead of redirecting directly, return the URL to the calling function
                // This helps avoid CORS issues
                $result['success'] = true;
                return $result;
            }
            
            $result['success'] = false;
            return $result;
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }

    public function payment(){
        $rawData = file_get_contents("php://input");
        $postData = json_decode($rawData, true);
        
        $total_amount = $postData['total_amount'];
        $items = $postData['items'];
        $_SESSION['orderItems'] = $_SESSION['order_list'];
        
        $result = $this->payment_by_zalo_pay($total_amount,$items);

        
        if(isset($result['success']) && $result['success'] === true) {
            $response = [
                'status' => 'success',
                'redirect_url' => $result['order_url']
            ];
        } else {
            $response = [
                'status' => 'error',
                'data' => $result
            ];
        }
        
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
        
        echo json_encode($response);
        exit;
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
        $tong_tien = $this->homeModel->total_money_by_user_id($user_id);
        $feedback = $this->homeModel->get_all_comment_by_order_id($user_id);
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
                    'quantity' => $item['quantity'],
                    'color' => $item['color_name'],
                    'size' => $item['size_name']
                ];
            }
        }
        $content = '../app/views/pages/user/profile/profile.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function feedback()
    {
        $user_id = $_SESSION['user']['user_id'];
        $feedback = $this->homeModel->get_all_comment_by_order_id($user_id);
        $content = '../app/views/pages/user/profile/feedback/feedback.php';
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

    public function search_product() {
        $search = $_GET['search'] ?? '';
        $category_id = $_GET['category_id'] ?? '';
        $brand_id = $_GET['brand_id'] ?? '';
        $price_range = $_GET['price_range'] ?? '';
    
        $price_filter = null;
        switch ($price_range) {
            case '3': 
                $price_filter = [0, 499999];
                break;
            case '4': 
                $price_filter = [500000, 1000000];
                break;
            default:
                $price_filter = null;
        }
    
        $categories = $this->categoryModel->get_all_category();
        $brands = $this->brandModel->get_all_brands();
    
        $variants = $this->variantModel->search_variant(
            $search,
            $category_id,
            $brand_id,
            $price_filter,
            $price_range 
        );
    
        $content = '../app/views/pages/user/search_product.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
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

    public function order2()
    {
        $id = $_SESSION['user']['user_id'];
        $voucher = $this->voucherModel->getVouchers();
        $address = $this->addressModel->get_address_by_user_id($_SESSION['user']['user_id'])['data'];
        $content = '../app/views/pages/user/order2.php';
        $header = '../app/views/layouts/_header.php';
        $footer = '../app/views/layouts/_footer.php';
        include_once "../app/views/layouts/default2.php";
    }

    public function add_orders()
    {

        $rawData = file_get_contents("php://input");
        $postData = json_decode($rawData, true);

        // Lấy thông tin
        $total_amount = $postData['total_amount'];
        $user_id = $postData['user_id'];
        $address_id = $postData['address_id'];
        $items = $postData['items'];
        $voucher_id = !empty($postData['voucher_id']) ? (int)$postData['voucher_id'] : null;

        // Gọi model để thêm đơn hàng
        $response = $this->orderModel->add_order(
            $total_amount,
            $user_id,
            $address_id,
            $items
        );
        echo json_encode($response);
        exit;
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