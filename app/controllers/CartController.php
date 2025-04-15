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
            // // if (isset($_SESSION['cart']) || !empty($_SESSION['cart'])) {
            // //     $_SESSION['cart'] = [
            // //         7 => [
            // //             [
            // //                 'variant_id' => 1001,
            // //                 'product_name' => 'Áo thi đấu Manchester United 2022/2023',
            // //                 'color_name' => 'Đỏ',
            // //                 'size_name' => 'Size 1',
            // //                 'thumbnail' => 'https://res.cloudinary.com/dtdkm7cjl/image/upload/v1744629983/chovybe/xicu3kixjsosifhsvcgy.jpg',
            // //                 'price' => 2000000,
            // //                 'quantity' => 1
            // //             ],
            // //             [
            // //                 'variant_id' => 1002,
            // //                 'product_name' => 'Áo thi đấu Manchester United 2022/2023',
            // //                 'color_name' => 'Đỏ',
            // //                 'size_name' => 'Size 2',
            // //                 'thumbnail' => 'https://res.cloudinary.com/dtdkm7cjl/image/upload/v1744629983/chovybe/rkogaygxfinakbcx0rke.avif',
            // //                 'price' => 2000000,
            // //                 'quantity' => 2
            // //             ]
            // //             ],
            // //             8 => [
            // //                 [
            // //                     'variant_id' => 1001,
            // //                     'product_name' => 'Áo thi đấu Manchester United 2022/2023',
            // //                     'color_name' => 'Đỏ',
            // //                     'size_name' => 'Size 1',
            // //                     'thumbnail' => 'https://res.cloudinary.com/dtdkm7cjl/image/upload/v1744629983/chovybe/xicu3kixjsosifhsvcgy.jpg',
            // //                     'price' => 2000000,
            // //                     'quantity' => 1
            // //                 ],
            // //                 [
            // //                     'variant_id' => 1002,
            // //                     'product_name' => 'Áo thi đấu Manchester United 2022/2023',
            // //                     'color_name' => 'Đỏ',
            // //                     'size_name' => 'Size 2',
            // //                     'thumbnail' => 'https://res.cloudinary.com/dtdkm7cjl/image/upload/v1744629983/chovybe/rkogaygxfinakbcx0rke.avif',
            // //                     'price' => 2000000,
            // //                     'quantity' => 2
            // //                 ]
            // //             ]
            // //     ];
            // //     echo json_encode($_SESSION['cart']);
            // //     exit;
            // } 
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
    }
?>