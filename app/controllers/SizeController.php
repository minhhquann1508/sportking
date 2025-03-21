<?php
    require_once '../app/models/Size.php';
    class SizeController {
        private $sizeModel;
        public function __construct() {
            $this->sizeModel = new Size();
        }
        public function index() {
            $content = '../app/views/pages/admin/size/size.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function get_all_sizes() {
            header('Content-Type: application/json'); // Đảm bảo trả về JSON
            $sizes = $this->sizeModel->get_all_sizes();
            if ($sizes) {
            echo json_encode(['success' => true, 'data' => $sizes]);
            } else {
            echo json_encode(['success' => false, 'message' => 'Không có dữ liệu']);
            }
            exit;
            $content = '../app/views/pages/admin/size/size.php';
            include_once "../app/views/layouts/admin.php";
        }
        
    }
?>