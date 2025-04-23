<?php 
    require_once '../app/configs/Database.php';
    class Address extends Database{
        private $table = "address";
        
        public function get_address_by_user_id($id) {
            $sql = "SELECT * FROM $this->table WHERE user_id = ?";
            $response = $this->select($sql, [$id]);
            if($response){
                return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response];
            }else{
                return ['success' => false, 'message' => 'Lấy thất bại', 'data' => null];
            }
        }

        public function add($ward, $district, $city, $street, $user_id) {
            $sql = "INSERT INTO address (ward, district, city, street, user_id) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $response = $this->execute($sql, [$ward, $district, $city, $street, $user_id]);
        
            if ($response) {
                return [
                    'success' => true,
                    'message' => 'Thêm địa chỉ thành công',
                    'data' => ['id' => $this->lastInsertId()]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Thêm địa chỉ thất bại',
                    'data' => null
                ];
            }
        }
    }
?>