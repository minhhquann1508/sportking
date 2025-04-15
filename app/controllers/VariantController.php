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
            $response = $this->variantModel->get_all();
            echo json_encode($response);
            exit;
        }
    }
?>