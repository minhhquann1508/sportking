<?php
    require_once '../app/configs/Database.php';
    class Brands extends Database{
        private $table = "brands";
        public function all_brand(){
            $sql = "SELECT * FROM $this->table";
            return $this -> select ($sql);
        }
    }

?>