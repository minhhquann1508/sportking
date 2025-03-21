<?php 
    require_once '../app/configs/Database.php';
    class Size extends Database{
        private $table = "size";
        public function get_all_size() {
            $sql = "SELECT size.*, category.category_name 
                    FROM $this->table 
                    LEFT JOIN category ON size.category_id = category.category_id";
            return $this->select($sql);
        }

        public function add_size($size_name){
            $check_sql = "SELECT COUNT(*) FROM size WHERE size_name = ?";
            $check_result = $this->select($check_sql, [$size_name]);
            if ($check_result && $check_result[0]['COUNT(*)'] > 0) {
                return "Size đã tồn tại!";
            }
            $sql = "INSERT INTO size (size_name, created_at, updated_at) 
                    VALUES (?, NOW(), NOW())";
            return $this->execute($sql, [$size_name]);          
        }
    }




?>