<?php
require_once '../app/configs/Database.php';
    class Products extends Database{
        private $table = "product";
        public function get_all_products() {
            $sql = "SELECT p.*, c.category_name, b.brand_name FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id";
            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
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

        public function get_product_by_id($id) {
            $sql = "SELECT p.*, c.category_name, b.brand_name FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    WHERE product_id = ?";
            $result = $this->select($sql, [$id]);
            if($result) {
                return ['success' => true, 'message' => 'Lấy sản phẩm thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy sản phẩm thất bại', 'data' => null];
            }
        }

        public function update_product_by_id($id, $product) {
            $index = 0;
            $params = [];
            $key_string = "SET ";
            foreach ($product as $key => $value) {
                if($index < (count($product) - 1)) {
                    $key_string .= $key. '= ?,';
                } else {
                    $key_string .= $key.'= ?';
                }
                $index++;
                $params[] = $value;
            }
            $params[] = $id;
            $sql = "UPDATE $this->table $key_string WHERE product_id = ?";
            $result = $this->execute($sql, $params);
            if($result) {
                return ['success' => true, 'message' => 'Cập nhật sản phẩm thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Cập nhật sản phẩm thất bại', 'data' => null];
            }
        }

        public function delete_product($id) {
            $sql = "DELETE FROM $this->table WHERE product_id = ?";
            $result = $this->execute($sql, [$id]);
            if($result) {
                return ['success' => true, 'message' => 'Xoá sản phẩm thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Xoá sản phẩm thất bại', 'data' => null];
            }
        }
    }
?>