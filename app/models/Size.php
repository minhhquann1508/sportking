<?php 
    require_once '../app/configs/Database.php';
    class Size extends Database{
        private $table = "size";
        public function get_all_sizes() {
            $sql = "SELECT size.*, category.category_name 
                    FROM $this->table 
                    LEFT JOIN category ON size.category_id = category.category_id";
            return $this->select($sql);
        }
    }




?>