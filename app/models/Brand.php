<?php
    require_once '../app/configs/Database.php';
    class Brand extends Database{
        private $table = "brands";

        // Lấy tất cả thương hiệu
        public function get_all_brands() {
            $query = "SELECT * FROM $this->table ORDER BY brand_id DESC";
            return $this->select($query);
        }

        // Thêm thương hiệu mới
        public function add_brand($name_brand , $hinh_anh) {
            $query = "INSERT INTO  $this->table (brand_name, thumbnail) VALUES (?, ?)";

            $result =  $this->execute($query, [$name_brand , $hinh_anh]);

            if($result){
                return ['success' => true, 'message' => 'Thêm thương hiệu thành công', 'data' => null];
            }else{
                return ['error' => false, 'message' => 'Thêm thương hiệu thất baị', 'data' => null];
            }
        }

        public function check_name($name_brand,$hinh_anh = null) {
            $query = "SELECT COUNT(*) AS count FROM category WHERE category_name = ?";
            $params = [$category_name];
    
            if ($exclude_id !== null) {
                $sql .= " AND category_id != ?";
                $params[] = $exclude_id;
            }
    
            $result = $this->select($sql, $params);
            return $result && $result[0]['count'] > 0;
        }

        // Cập nhật thương hiệu
        public function update_brand($brand_id, $name_brand , $hinh_anh) {
            $query = "UPDATE  $this->table SET brand_name = ?, thumbnail = ? WHERE brand_id = ?";
            $result = $this->execute($query, [$name_brand , $hinh_anh, $brand_id]);
            if($result){
                return ['success' => true, 'message' => 'Thêm thương hiệu thành công', 'data' => null];
            }else{
                return ['error' => false, 'message' => 'Thêm thương hiệu thất baị', 'data' => null];
            }
        }

        // Xóa thương hiệu
        public function delete_brand($brand_id) {
            $query = "DELETE FROM  $this->table WHERE brand_id = ?";
            $result = $this->execute($query, [$brand_id]);
            if($result){
                return ['success' => true, 'message' => 'Thêm thương hiệu thành công', 'data' => null];
            }else{
                return ['error' => false, 'message' => 'Thêm thương hiệu thất baị', 'data' => null];
            }
        }

        public function filter_brand($brand_name){
            if($brand_name != ""){
                $query = "SELECT * FROM $this->table WHERE brand_name LIKE ?";
                $params = "%$brand_name%";
                $result = $this->select($query, [$params]);
                if($result){
                    return ['success' => true, 'message' => 'Success', 'data' => $result];
                }else{
                    return ['error' => false, 'message' => 'Not found', 'data' => null];
                }
            }
        }
    }

?>