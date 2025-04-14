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
            $check_size_sql = "SELECT COUNT(*) as count FROM size WHERE size_name = ?";
            $check_size_result = $this->select($check_size_sql, [$size_name]);
        
            if ($check_size_result[0]['count'] > 0) {
                return ['success' => false, 'message' => 'Size đã tồn tại'];
            }
        
            $sql = "INSERT INTO size (size_name, category_id) VALUES (?, ?)";
            $response = $this->execute($sql, [$size_name, $category_id]);
        
            return $response ? ['success' => true, 'message' => 'Thêm mới thành công'] 
                             : ['success' => false, 'message' => 'Thêm mới thất bại'];
        }
        public function get_size_by_id($id): array {
            $sql = "
                SELECT size_id, size_name, category_id
                FROM $this->table
                WHERE size_id = ?
            ";
        
            $result = $this->select(query: $sql, params: [$id]);
        
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Lấy size thành công',
                    'data' => $result[0]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Lấy size thất bại',
                    'data' => null
                ];
            }
        }
        
        

        public function update_size_by_id($id, $size) {
            $index = 0;
            $params = [];
            $set_string = "SET ";
            foreach ($size as $key => $value) {
                $set_string .= $key . ' = ?';
                $params[] = $value;
                if ($index < count($size) - 1) {
                    $set_string .= ', ';
                }
                $index++;
            }
            $params[] = $id;
            $sql = "UPDATE  $this->table $set_string WHERE size_id = ?";
            $result = $this->execute($sql, $params);
            if($result){
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