<?php
    class CartController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/user/cart.php';
            $header = '../app/views/layouts/_header.php';
            $footer = '../app/views/layouts/_footer.php';
            include_once "../app/views/layouts/default2.php";
        }

        public function get_cart() {
            if(!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
            echo json_encode($_SESSION['cart']);
            exit;
        }

        public function add() {
            if (!isset($_POST['variant'], $_POST['product_id'])) return;
        
            $variant = $_POST['variant'];
            $product_id = $_POST['product_id'];
        
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
        
            // Nếu chưa có sản phẩm này trong giỏ thì thêm mới
            if (!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [$variant];
            } else {
                $variant_exists = false;
        
                // Kiểm tra xem variant_id đã tồn tại trong danh sách chưa
                foreach ($_SESSION['cart'][$product_id] as &$item) {
                    if ($item['variant_id'] == $variant['variant_id']) {
                        $item['quantity'] += $variant['quantity'];
                        $variant_exists = true;
                        break;
                    }
                }
        
                // Nếu chưa tồn tại thì thêm mới
                if (!$variant_exists) {
                    $_SESSION['cart'][$product_id][] = $variant;
                }
            }
        
            // Trả về JSON để client xử lý tiếp nếu cần
            echo json_encode([
                'success' => true,
                'message' => 'Thêm sản phẩm vào giỏ thành công',
                'cart' => $_SESSION['cart']
            ]);
        }

        public function remove_product() {
            $product_id = $_POST['product_id'];
            if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) unset($_SESSION['cart'][$product_id]);
        }

        public function remove_variant() {
            $variant_id = $_POST['variant_id'];
            $product_id = $_POST['product_id'];
        
            if (isset($_SESSION['cart'][$product_id])) {
                foreach ($_SESSION['cart'][$product_id] as $key => $item) {
                    if ($item['variant_id'] == $variant_id) {
                        unset($_SESSION['cart'][$product_id][$key]);
                        break;
                    }
                }
        
                // Nếu vẫn còn item thì reindex lại array
                if (!empty($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id] = array_values($_SESSION['cart'][$product_id]);
                } else {
                    unset($_SESSION['cart'][$product_id]);
                }
            }
        
            echo json_encode($_SESSION['cart']);
            exit;
        }

        public function remove_all() {
            unset($_SESSION['cart']);
            echo json_encode([]); 
            exit;
        }

        public function add_to_order() {
            $_SESSION['order_list'] = $_POST['items'];
            echo json_encode($_SESSION['order_list']); 
            exit;
        }
    }
?>