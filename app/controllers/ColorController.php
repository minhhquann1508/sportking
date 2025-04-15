<?php
    require_once '../app/models/Color.php';

    class ColorController {
        private $colorModel;
        public function __construct() {
            $this->colorModel = new Color();
        }
        public function index() {
            $content = '../app/views/pages/admin/color/color.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function add() {
            $color_hex = $_POST['color_hex'];
            $color_name = $_POST['color_name'];
            $response = $this->colorModel->create($color_name, $color_hex);
            echo json_encode($response);
            exit;
        }

        public function get_all() {
            $reponse = $this->colorModel->get_all();
            echo json_encode($reponse);
            exit;
        }

        public function delete_by_id() {
            $color_id = $_POST['color_id'];
            $response = $this->colorModel->delete((int) $color_id);
            echo json_encode($response);
            exit;
        }
    }
?>