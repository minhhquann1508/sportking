<?php
    class AboutController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/user/about.php';
            include_once "../app/views/layouts/default.php";
        }
    }
?>