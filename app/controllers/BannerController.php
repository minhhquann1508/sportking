<?php
    require_once '../app/models/Banner.php';

    class BannerController {
        private $bannerModel;
        public function __construct() {
            $this->bannerModel = new Banner();
        }
        public function index() {
            $banners = $this->bannerModel->get_all_banners();
            $content = '../app/views/pages/admin/banner.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function create() {
            $content = '../app/views/pages/admin/add_banner.php';
            include_once "../app/views/layouts/admin.php";
        }
    }
?>