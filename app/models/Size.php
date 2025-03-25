<?php 
    require_once '../app/configs/Database.php';
    class Size extends Database{
        private $table = "size";
        public function get_all_sizes() {
            $sql = "SELECT size.*, category.category_name 
                    FROM $this->table 
                    LEFT JOIN category ON size.category_id = category.category_id";
            $data = $this->select($sql);
            return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $data];
            
        }

        public function add_size($size_name, $category_id) {
            $check_size_sql = "SELECT COUNT(*) FROM $this->table WHERE size_name = ?";
            $check_size_result = $this->select($check_size_sql, [$size_name]);
            if ($check_size_result && $check_size_result[0]['COUNT(*)'] > 0){
                return ['success' => false, 'message' => 'Size đã tồn tại', 'data' => null];
            }
            $sql = "INSERT INTO size(size_name, category_id) VALUES (?, ?)";
            $response = $this->execute($sql, [$size_name, $category_id]);
            if($response) {
                return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
            }
        }

        public function update_size($size_id, $size_name , $category_id) {
            $sql = "UPDATE  $this->table SET size_name = ?, category_id = ? WHERE size_id = ?";
            $response = $this->execute($sql, [ $size_id, $size_name , $category_id]);
            if($response){
                return ['success' => true, 'message' => 'Sửa size thành công', 'data' => null];
            }else{
                return ['success' => false, 'message' => 'Sửa size thất baị', 'data' => null];
            }
        }

        public function delete_size($size_id) {
            $sql = "DELETE FROM size WHERE size_id = ?";
            $response = $this->execute($sql, [$size_id]);
            if ($response){
                return ['success' => true, 'message' => 'xoá thành công', 'data' => null];

            }else{
                return ['success' => false, 'message' => 'xoá thất bại', 'data' => null];
            } 
        } 
    }




?>