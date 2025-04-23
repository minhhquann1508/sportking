<?php
    require_once '../app/models/Products.php';
    require_once '../app/models/Size.php';
    require_once '../app/models/Color.php';
    require_once '../app/models/Variant.php';

    class VariantController {
        private $productModel;
        private $sizeModel;
        private $colorModel;
        private $variantModel;
        public function __construct() {
            $this->productModel = new Products();
            $this->sizeModel = new Size();
            $this->colorModel = new Color();
            $this->variantModel = new Variant();
        }
        public function index() {
            $product_id = $_GET['product_id'] ?? null;
            $product = $this->productModel->get_product_by_id($product_id)['data'][0];
            $sizes = $this->sizeModel->get_size_by_category($product['category_id']);
            $colors = $this->colorModel->get_all();
            $content = '../app/views/pages/admin/variant/variant.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function add () {
            $response = $this->variantModel->add(
                $_POST['price'],
                $_POST['stock'],
                $_POST['product_id'],
                $_POST['size_id'],
                $_POST['color_id']
            );
            echo json_encode($response);
        }

        public function add_img() {
            $response = $this->variantModel->add_img(
                $_POST['variant_id'],
                $_POST['imgs']
            );
            echo json_encode($response);
        }

        public function get_all() {
            $response = $this->variantModel->get_all(
                $_GET['product_id'],
                $_GET['page']
            );
            echo json_encode($response);
            exit;
        }

        public function get_variant_item() {
            $result = $this->variantModel->find_variant(
                $_POST['product_id'],
                $_POST['color_id'],
                $_POST['size_id'],
            );
            echo json_encode($result);
            exit;
        }

        public function delete_variant_item() {
            $response = $this->variantModel->delete_variant(
                $_GET['variant_id']
            );
            echo json_encode($response);
            exit;
        }

        public function update() {
            $update_product = $_POST;
            $response = $this->variantModel->update_variant_by_id($update_product);
            echo json_encode($response);
            exit;
        }

        // public function get_variant_by_search() {
        //     $search = $_GET['search'] ?? '';
        //     $category_id = $_GET['category_id'] ?? '';
        //     $brand_id = $_GET['brand_id'] ?? '';
        //     $price_range = $_GET['price_range'] ?? '';
        //     $price_filter = null;
        
        //     // Xử lý lọc giá theo khoảng
        //     switch ($price_range) {
        //         case '3':
        //             $price_filter = [0, 499999]; // Dưới 500k
        //             break;
        //         case '4':
        //             $price_filter = [500000, 1000000]; // Từ 500k đến 1 triệu
        //             break;
        //         default:
        //             $price_filter = null; // Không lọc theo khoảng
        //     }
        
        //     // Gọi model, truyền thêm price_range để xử lý sắp xếp
        //     $response = $this->variantModel->search_variant($search, $category_id, $brand_id, $price_filter, $price_range);
        //     echo json_encode($response);
        //     exit;
        // }
    }
?>