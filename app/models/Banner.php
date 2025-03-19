<?php 
    require_once '../app/configs/Database.php';
    class Banner extends Database{
        private $table = "banners";
        public function get_all_banners() {
            $sql = "SELECT * FROM $this->table";
            return $this->select($sql);
        }

        public function create_banner($url, $img_url, $user_id) {
            $sql = "INSERT INTO $this->table (url, img_url, user_id) 
                    VALUES (?, ?, ?)";
            return $this->execute($sql, [$url, $img_url, $user_id]);
        }
    }
?>