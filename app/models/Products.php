<?php
require_once '../app/configs/Database.php';
    class Products extends Database{
        private $table = "product";
        public function get_all_products() {
            $sql = "SELECT * FROM $this->table";
            return $this->select($sql);
        }
        public function add_product($product) {
            $index = 0;
            $params = [];
            $key_string = '(';
            $query_string = 'VALUES(';
            foreach($product as $key => $value) {
                if($index < count($product) - 1) {
                    $key_string .= $key . ',';
                    $query_string .= '?,';
                } else {
                    $key_string .= $key . ')';
                    $query_string .= '?)';
                }
                $index++; 
                $params[] = $value;
            }
            $sql = "INSERT INTO $this->table $key_string $query_string";
            $response = $this->execute($sql, $params);
            if($response) {
                return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
            }
        }
    }
?>