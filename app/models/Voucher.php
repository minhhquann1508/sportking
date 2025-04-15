<?php 
require_once '../app/configs/Database.php';

class Voucher extends Database {
    private $table = "voucher";

    public function getVouchers(){
        $query = "SELECT * FROM $this->table ORDER BY voucher_id DESC";
        return $this->select($query);
    }

    public function getById($voucherId){
        $query = "SELECT * FROM $this->table WHERE voucher_id = ?";
        return $this->selectOne($query, [$voucherId]);
    }

    public function create($code, $discount_type, $discount_value, $quantity, $expired, $status = 'inactive'){
        // Kiểm tra mã voucher đã tồn tại chưa
        if ($this->isCodeExists($code)) {
            return false;
        }
        
        $query = "INSERT INTO $this->table (code, discount_type, discount_value, quantity, expired, status) VALUES (?, ?, ?, ?, ?, ?)";
        return $this->execute($query, [$code, $discount_type, $discount_value, $quantity, $expired, $status]);
    }

    public function update($voucher_id, $code, $discount_type, $discount_value, $quantity, $expired, $status){
        // Kiểm tra mã voucher (trừ voucher hiện tại)
        if ($this->isCodeExists($code, $voucher_id)) {
            return false;
        }
        
        $query = "UPDATE $this->table SET code = ?, discount_type = ?, discount_value = ?, quantity = ?, expired = ?, status = ? WHERE voucher_id = ?";
        return $this->execute($query, [$code, $discount_type, $discount_value, $quantity, $expired, $status, $voucher_id]);
    }

    public function delete($voucher_id){
        $query = "DELETE FROM $this->table WHERE voucher_id = ?";
        return $this->execute($query, [$voucher_id]);
    }

    private function isCodeExists($code, $exclude_id = null) {
        $query = "SELECT voucher_id FROM $this->table WHERE code = ?";
        $params = [$code];
        
        if ($exclude_id !== null) {
            $query .= " AND voucher_id != ?";
            $params[] = $exclude_id;
        }
        
        $result = $this->selectOne($query, $params);
        return !empty($result);
    }
}
?>