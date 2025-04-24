<?php
    require_once '../app/models/Banner.php';

    class BannerController {
        private $bannerModel;
        public function __construct() {
            $this->bannerModel = new Banner();
        }
        public function index() {
            // $banners = $this->bannerModel->get_all_banners();
            $content = '../app/views/pages/admin/banner.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function get_all() {
            $response = $this->bannerModel->get_all_banners();
            echo json_encode($response);
            exit;
        }

        public function add() {
            $user_id = $_SESSION['user']['user_id'];
            $response = $this->bannerModel->create_banner(
            $_POST['url'],  
            $_POST['img_url'],  
            $user_id,  
            );
            echo json_encode($response);
            exit;
        }

        public function delete() {
            $banner_id = $_POST['banner_id'];
            $response = $this->bannerModel->delete_banner($banner_id);
            echo json_encode($response);
            exit;
;        }
    }
?>