<?php
    class BannerController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/admin/banner.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function create() {
            $content = '../app/views/pages/admin/add_banner.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>