<?php 
    require_once '../app/configs/Database.php';
    class Banner extends Database{
        private $table = "banners";
        public function get_all_banners() {
            $sql = "SELECT * FROM $this->table";
            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh thất bại', 'data' => null];
            }
        }

        public function create_banner($url, $img_url, $user_id) {
            $sql = "INSERT INTO $this->table (url, img_url, user_id) 
                    VALUES (?, ?, ?)";
            $result = $this->execute($sql, [$url, $img_url, $user_id]);
            if($result) {
                return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
            }
        }
    }
?>