<?php 
    require_once '../app/configs/Database.php';
    class Category extends Database{
        private $table = "category";
        public function get_all_category() {
            $sql = "SELECT * FROM $this->table";
            return $this->select($sql);
        }

        public function add_category($url, $img_url, $user_id) {
            $sql = "INSERT INTO $this->table (url, img_url, user_id) 
                    VALUES (?, ?, ?)";
            return $this->execute($sql, [$url, $img_url, $user_id]);
        }
    }
?>