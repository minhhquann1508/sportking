<?php
    class VariantController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/admin/variant/variant.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>