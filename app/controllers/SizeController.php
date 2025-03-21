<?php
    require_once '../app/models/Size.php';
    class SizeController {
        private $sizeModel;
        public function __construct() {
            $this->sizeModel = new Size();
        }
        public function index() {
            $size = $this->sizeModel->get_all_size();
            $content = '../app/views/pages/admin/size/size.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>