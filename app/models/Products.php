<?php
require_once '../app/configs/Database.php';
    class Products extends Database{
        private $table = "product";
        public function get_all_products() {
            $sql = "SELECT * FROM $this->table";
            return $this->select($sql);
        }
    }
?>