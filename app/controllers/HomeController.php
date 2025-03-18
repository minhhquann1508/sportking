<?php 
    class HomeController {
        public function index() {
            $content = '../app/views/pages/user/home.php';
            include_once "../app/views/layouts/default.php";
        }
        public function about() {
            $content = '../app/views/pages/user/about.php';
            include_once "../app/views/layouts/default.php";
        }
    }
?>