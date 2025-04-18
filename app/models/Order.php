<?php
require_once '../app/configs/Database.php';

class Order extends Database {
    private $table = "orders"; // Tên bảng đúng là 'orders'
    private $table_item = "order_items";
    

    public function add_order($total_amount, $user_id, $address_id, $items) {
        $voucher_id = 1;
        // 1. Thêm đơn hàng
        $sql = "INSERT INTO {$this->table} (total_amount, user_id, address_id, voucher_id)
                VALUES (?, ?, ?,?)";
        
        $response = $this->execute($sql, [$total_amount, $user_id, $address_id, $voucher_id]);
        
        if ($response) {
            $order_id = $this->lastInsertId();

            // insert items vao order_items
            try {
                foreach ($items as $item) {
                    $sql_item = "INSERT INTO order_items (order_id, quantity, price, variant_id) 
                                 VALUES (?, ?, ?, ?)";
                    $item_response = $this->execute($sql_item, [
                        $order_id, 
                        $item['quantity'], 
                        $item['price'],
                        $item['id']
                    ]);
                
                    if (!$item_response) {
                        return [
                            'success' => false,
                            'message' => 'Thêm sản phẩm vào order_items thất bại',
                            'data' => null
                        ];
                    }
                }
                
                // ✅ Nếu toàn bộ item đều thành công
                return [
                    'success' => true,
                    'message' => 'Thêm đơn hàng và sản phẩm thành công',
                    'data' => ['order_id' => $order_id]
                ];
            } catch (PDOException $e) {
                die("Kết nối thất bại: " . $e->getMessage());
            }
            
        } else {
            return [
                'success' => false,
                'message' => 'Thêm đơn hàng thất bại',
                'data' => null
            ];
        }
    }
}
?>