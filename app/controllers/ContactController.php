<?php
    class ContactController {
        // private $productModel;
        // public function __construct() {
        //     $this->productModel = new Products();
        // }
        public function index() {
            $content = '../app/views/pages/user/contact.php';
            include_once "../app/views/layouts/default.php";
        }
    }
?>