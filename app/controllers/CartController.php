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
            if (!isset($_POST['variant_id'], $_POST['product_id'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Thiếu dữ liệu',
                    'data' => null
                ]);
                return;
            }
        
            $variant = [
                'variant_id'   => $_POST['variant_id'],
                'price'        => (float) $_POST['price'],
                'stock'        => (int) $_POST['stock'],
                'size_id'      => $_POST['size_id'],
                'color_id'     => $_POST['color_id'],
                'thumbnail'    => $_POST['thumbnail'],
                'product_name' => $_POST['product_name'],
                'product_id'   => $_POST['product_id'],
                'color_name'   => $_POST['color_name'],
                'size_name'    => $_POST['size_name'],
                'quantity'     => (int) $_POST['quantity'],
            ];
        
            $product_id = $_POST['product_id'];
        
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
        
            // Nếu sản phẩm này chưa có trong giỏ -> thêm mới
            if (!isset($_SESSION['cart'][$product_id])) {
                // Chỉ thêm nếu số lượng hợp lệ
                if ($variant['quantity'] <= $variant['stock']) {
                    $_SESSION['cart'][$product_id] = [$variant];
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Số lượng vượt quá tồn kho',
                        'cart' => $_SESSION['cart']
                    ]);
                    return;
                }
            } else {
                $variant_exists = false;
        
                // Kiểm tra xem variant_id đã tồn tại chưa
                foreach ($_SESSION['cart'][$product_id] as &$item) {
                    if ($item['variant_id'] == $variant['variant_id']) {
                        $total_quantity = $item['quantity'] + $variant['quantity'];
                        if ($total_quantity > $variant['stock']) {
                            echo json_encode([
                                'success' => false,
                                'message' => 'Số lượng vượt quá tồn kho',
                                'cart' => $_SESSION['cart']
                            ]);
                            return;
                        }
                        $item['quantity'] = $total_quantity; // tăng số lượng nếu hợp lệ
                        $variant_exists = true;
                        break;
                    }
                }
        
                // Nếu chưa có variant này thì thêm mới
                if (!$variant_exists) {
                    if ($variant['quantity'] <= $variant['stock']) {
                        $_SESSION['cart'][$product_id][] = $variant;
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Số lượng vượt quá tồn kho',
                            'cart' => $_SESSION['cart']
                        ]);
                        return;
                    }
                }
            }
        
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

        public function update_quantity()
        {
            if (!isset($_POST['variant_id'], $_POST['product_id'], $_POST['quantity'])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Thiếu dữ liệu',
                    'data' => null
                ]);
                return;
            }

            $variant_id = $_POST['variant_id'];
            $product_id = $_POST['product_id'];
            $quantity = (int) $_POST['quantity'];

            if (!isset($_SESSION['cart'][$product_id])) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Sản phẩm không tồn tại trong giỏ hàng',
                    'data' => null
                ]);
                return;
            }

            foreach ($_SESSION['cart'][$product_id] as &$item) {
                if ($item['variant_id'] == $variant_id) {
                    if ($quantity > $item['stock']) {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Số lượng vượt quá tồn kho',
                            'data' => null
                        ]);
                        return;
                    }

                    $item['quantity'] = $quantity;

                    echo json_encode([
                        'success' => true,
                        'message' => 'Cập nhật số lượng thành công',
                        'data' => $_SESSION['cart']
                    ]);
                    return;
                }
            }

            echo json_encode([
                'success' => false,
                'message' => 'Không tìm thấy biến thể',
                'data' => null
            ]);
        }
    }
?>