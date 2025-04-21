<?php
require_once '../app/configs/Database.php';
    class Products extends Database{
        private $table = "product";
        public function get_all_products($page = 1, $limit = 10) {
            $offset = ($page - 1) * $limit;
            $countSql = "SELECT COUNT(*) as total FROM $this->table";
            $countResult = $this->select($countSql);
            $total = $countResult ? (int)$countResult[0]['total'] : 0;
        
            $sql = "SELECT p.*, c.category_name, b.brand_name 
                    FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    ORDER BY product_id DESC
                    LIMIT $limit OFFSET $offset";
        
            $result = $this->select($sql);
        
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Lấy danh sách thành công',
                    'data' => $result,
                    'pagination' => [
                        'current_page' => (int) $page,
                        'limit' => $limit,
                        'total' => $total,
                        'total_pages' => ceil($total / $limit)
                    ]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Lấy danh sách thất bại',
                    'data' => null,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => 0,
                        'total_pages' => 0
                    ]
                ];
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

        public function search_product($search_params, $page = 1, $limit = 10) {
            $product_name = $search_params['product_name'] ?? '';
            $brand_id = $search_params['brand_id'] ?? '';
            $category_id = $search_params['category_id'] ?? '';
        
            $where = [];
        
            if (!empty($product_name)) {
                $product_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $product_name);
                $where[] = "p.product_name LIKE '%$product_name%'";
            }
        
            if (!empty($brand_id)) {
                $where[] = "p.brand_id = " . (int)$brand_id;
            }
        
            if (!empty($category_id)) {
                $where[] = "p.category_id = " . (int)$category_id;
            }
        
            $where_sql = '';
            if (!empty($where)) {
                $where_sql = 'WHERE ' . implode(' AND ', $where);
            }
        
            $offset = ($page - 1) * $limit;
        
            // Truy vấn dữ liệu
            $sql = "SELECT p.*, c.category_name, b.brand_name 
                    FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    $where_sql
                    ORDER BY p.product_id DESC
                    LIMIT $limit OFFSET $offset";
        
            $result = $this->select($sql);
        
            // Truy vấn tổng số dòng
            $count_sql = "SELECT COUNT(*) as total
                          FROM $this->table p
                          INNER JOIN category c ON c.category_id = p.category_id
                          INNER JOIN brands b ON b.brand_id = p.brand_id
                          $where_sql";
        
            $count_result = $this->select($count_sql);
            $total = $count_result[0]['total'] ?? 0;
        
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Lấy danh sách thành công',
                    'data' => $result,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => (int)$total,
                        'total_pages' => ceil($total / $limit)
                    ]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Lấy danh sách thất bại',
                    'data' => null,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => 0,
                        'total_pages' => 0
                    ]
                ];
            }
        }
    }
?>