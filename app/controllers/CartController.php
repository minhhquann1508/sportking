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
        public function add() {
            if (!isset($_POST['variant'], $_POST['product_id'])) return;

            $variant = $_POST['variant'];
            $product_id = $_POST['product_id'];

            if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
            
            if(!isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id] = [$variant];
            } else {
                $variant_exists = false;
                foreach ($_SESSION['cart'][$product_id] as &$item) {
                    if($item['variant_id'] == $variant['variant_id']) {
                        $item['quantity'] += $variant['quantity'];
                        $variant_exists = true;
                        break;
                    }
                }

                if(!$variant_exists) {
                    $_SESSION['cart'][$product_id][] = $variant;
                }
            }
        }

        public function remove_product() {
            $product_id = $_POST['product_id'];
            if(isset($_SESSION['cart']) && isset($_SESSION['cart'][$product_id])) unset($_SESSION['cart'][$product_id]);
        }

        public function remove_variant() {
            $variant_id = $_POST['variant_id'];
            $product_id = $_POST['product_id'];
            if (isset($_SESSION['cart'][$product_id])) {
                foreach ($_SESSION['cart'][$product_id] as $key => $cart_item) {
                    if ($cart_item['variant_id'] == $variant_id) {
                        unset($_SESSION['cart'][$product_id][$key]);
                        break;
                    }
                }
                if (empty($_SESSION['cart'][$product_id])) {
                    unset($_SESSION['cart'][$product_id]);
                }
            }
        }

        public function remove_all() {
            if(isset($_SESSION['cart'])) unset($_SESSION['cart']);
        }
    }
?>