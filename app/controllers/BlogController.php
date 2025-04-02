<?php
    class BlogController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/user/blog.php';
            include_once "../app/views/layouts/default.php";
        }
    }
?>