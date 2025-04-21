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
                $_GET['product_id'],
                $_GET['color_id'],
                $_GET['size_id'],
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
    }
?>