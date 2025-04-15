<?php 
    require_once '../app/configs/Database.php';
    class Color extends Database{
        private $table = "color";
        
        public function create($color_name, $color_hex) {
            $sql = "INSERT INTO $this->table (color_name, color_hex)
                    VALUES(?, ?)";
            $response = $this->execute($sql, [$color_name, $color_hex]);
            if($response) {
                return ['success' => true, 'message' => 'Thêm thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm thất bại', 'data' => null];
            }
        }

        public function get_all() {
            $sql = "SELECT * FROM $this->table";
            $response = $this->select($sql);
            if($response) {
                return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $response];
            } else {
                return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
            }
        }

        public function delete($id) {
            $sql = "DELETE FROM $this->table WHERE color_id = ?";
            $response = $this->execute($sql, [$id]);
            if($response) {
                return ['success' => true, 'message' => 'Xoá thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Xoá thất bại', 'data' => null];
            }
        }
    }
?>