<?php 
    require_once '../app/configs/Database.php';
    class Home extends Database{
        private $tableProduct = "product";
        private $tableCategory = "category";    
        private $tableBrand = "brands";
        public function get_all_products() {
            $sql = "SELECT p.*, pv.*, c.category_name, b.brand_name FROM $this->tableProduct p 
                    LEFT JOIN product_variant pv ON pv.product_id = p.product_id
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id";
            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
        }
        public function get_filtered_products($category, $brand, $price) {
            $sql = "SELECT p.*, pv.*, c.category_name, b.brand_name 
                    FROM $this->tableProduct p 
                    LEFT JOIN product_variant pv ON pv.product_id = p.product_id
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    WHERE 1=1";

            if ($category) {
                $sql .= " AND p.category_id = $category";
            }

            if ($brand) {
                $sql .= " AND p.brand_id = $brand";
            }

            if ($price) {
                if ($price == '1') {
                    $sql .= " AND pv.price < 1000000";
                } elseif ($price == '2') {
                    $sql .= " AND pv.price BETWEEN 1000000 AND 5000000";
                } elseif ($price == '3') {
                    $sql .= " AND pv.price BETWEEN 5000000 AND 10000000";
                } elseif ($price == '4') {
                    $sql .= " AND pv.price > 10000000";
                }
            }

            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
        }

        public function get_all_categorys() {
            $sql = "SELECT c.*FROM $this->tableCategory c";
            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
        }
        public function get_all_brands() {
            $sql = "SELECT b.*FROM $this->tableBrand b";
            $result = $this->select($sql);
            if($result) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
        }
    }
?>