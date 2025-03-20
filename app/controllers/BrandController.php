<?php
 require_once '../app/models/Brand.php';
    class BrandController {
        private $brandModel;
        public function __construct() {
            $this->brandModel = new Brands();
        }
        public function index() {
            $brands = $this -> brandModel -> all_brand();
            $content = '../app/views/pages/admin/brand.php';
            include_once "../app/views/layouts/admin.php";
            
        }

    }

?>