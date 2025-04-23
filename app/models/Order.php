<?php
require_once '../app/configs/Database.php';

class Order extends Database {
    private $table = "orders"; 
    private $table_item = "order_items";
    public function add_order($total_amount, $user_id, $email, $address_id, $items, $voucher_id = 1) {
        //Check email
        $check_email_sql = "SELECT * FROM users WHERE email = ?";
        $user = $this->select($check_email_sql, [$email]); // true = lấy 1 dòng
        if (!$user || empty($user[0])) {
            return [
                'success' => false,
                'message' => 'Email không tồn tại trong hệ thống',
                'data' => null
            ];
        }
        $sql = "INSERT INTO {$this->table} ( user_id, address_id, voucher_id, total_amount, status)
                VALUES (?, ?, ?, ?, 0)";
        $response = $this->execute($sql, [$user_id, $address_id, $voucher_id, $total_amount]);
        if ($response) {
            $order_id = $this->lastInsertId();
            foreach ($items as $item) {
                $sql_item = "INSERT INTO order_items (order_id, quantity, price, variant_id) 
                             VALUES (?, ?, ?, ?)";
                $item_response = $this->execute($sql_item, [
                    $order_id, 
                    $item['quantity'], 
                    $item['price'],
                    $item['variant_id']
                ]);
    
                if (!$item_response) {
                    return [
                        'success' => false,
                        'message' => 'Thêm sản phẩm vào order_items thất bại',
                        'data' => null
                    ];
                }
            }
            $orderList = $_SESSION['order_list'];
            $cart = &$_SESSION['cart']; 
    
            foreach ($orderList as $orderItem) {
                $product_id = $orderItem['product_id'];
                $variant_id = $orderItem['variant_id'];
    
                if (isset($cart[$product_id])) {
                    foreach ($cart[$product_id] as $index => $cartItem) {
                        if ($cartItem['variant_id'] == $variant_id) {
                            unset($cart[$product_id][$index]);
                        }
                    }
    
                    if (empty($cart[$product_id])) {
                        unset($cart[$product_id]);
                    } else {
                        $cart[$product_id] = array_values($cart[$product_id]);
                    }
                }
            }
    
            // Query order data, including user, voucher, and address
            $order_sql = "SELECT o.*, 
                            u.*, 
                            v.*, 
                            a.*
                        FROM orders o
                        LEFT JOIN users u ON o.user_id = u.user_id
                        LEFT JOIN voucher v ON o.voucher_id = v.voucher_id
                        LEFT JOIN address a ON o.address_id = a.address_id
                        WHERE o.order_id = ?";
            $order = $this->select($order_sql, [$order_id]);
    
            // Kiểm tra xem order có dữ liệu không
            if (isset($order[0]) && isset($order[0]['order_id'])) {
                $order = $order[0]; // Lấy bản ghi đầu tiên nếu query trả về 1 dòng kết quả
            } else {
                return [
                    'success' => false,
                    'message' => 'Không tìm thấy đơn hàng',
                    'data' => null
                ];
            }
    
            // Gửi email thông báo
            require_once "PHPMailer-master/src/PHPMailer.php"; 
            require_once "PHPMailer-master/src/SMTP.php"; 
            require_once "PHPMailer-master/src/Exception.php";   
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();  
                $mail->CharSet  = "UTF-8";
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true; 
                $mail->Username = 'vanduyho717@gmail.com';  
                $mail->Password = 'xvgu ydcc dtzr gsap';
                $mail->SMTPSecure = 'ssl';    
                $mail->Port = 465;
    
                $mail->setFrom('vanduyho717@gmail.com', 'SPORTKING'); 
                $mail->addAddress($email);
                $mail->isHTML(true);  
                $mail->Subject = 'Thông tin đơn hàng của bạn';
                $mail->Body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9;">
            <div style="text-align: center;">
                <h2 style="color: #4a90e2;">🛒 Thông tin đơn hàng #' . $order['order_id'] . '</h2>
            </div>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Ngày và giờ đặt hàng</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['order_date'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Mã đơn hàng</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['order_id'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Người nhận</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['fullname'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Email</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['email'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Địa chỉ giao hàng</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['street'] . ', Phường ' .$order['ward']. ', Quận' .$order['district']. ', ' . $order['city'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Voucher</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . $order['code'] . '</td>
                </tr>
                <tr>
                    <td style="padding: 10px; font-size: 14px; color: #555;">Tổng giá trị đơn hàng</td>
                    <td style="padding: 10px; font-size: 14px; color: #555;">' . number_format($order['total_amount'], 0, ',', '.') . ' VND</td>
                </tr>
            </table>
            <hr style="margin: 20px 0;">
            <hr style="margin: 20px 0;">
            <p style="font-size: 14px; color: #888;">Cảm ơn bạn đã mua sắm tại SPORTKING!</p>
        </div>
    ';
                $mail->smtpConnect([
                    "ssl" => [
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    ]
                ]);
                $mail->send();
    
                return [
                    'success' => true,
                    'message' => 'Thêm đơn hàng và sản phẩm thành công',
                    'data' => ['order_id' => $order_id],
                ];
            } catch (Exception $e) {
                return [
                    'success' => false, 
                    'message' => 'Gửi thông tin đơn hàng thất bại: ' . $mail->ErrorInfo, 
                    'data' => null
                ];
            }
        } else {
            return [
                'success' => false,
                'message' => 'Thêm đơn hàng thất bại',
                'data' => null
            ];
        }
    }

    public function get_order_by_id($order_id) {
        $sql = "SELECT 
            o.*, 
            u.fullname AS fullname, u.email,
            a.city, a.district, a.ward, a.street,
            v.voucher_id, v.discount_value
        FROM orders o
        JOIN users u ON o.user_id = u.user_id
        JOIN address a ON o.address_id = a.address_id
        LEFT JOIN voucher v ON o.voucher_id = v.voucher_id
        WHERE o.order_id = ?";
        $order = $this->select($sql, [$order_id]);
        if ($order) {
            // Lấy các item của đơn hàng
            $sql_items = "
                SELECT oi.*, v.variant_id, s.size_name, c.color_name, p.thumbnail
                FROM order_items oi
                INNER JOIN product_variant v ON oi.variant_id = v.variant_id
                INNER JOIN product p ON p.product_id = v.product_id
                LEFT JOIN size s ON v.size_id = s.size_id
                LEFT JOIN color c ON v.color_id = c.color_id
                WHERE oi.order_id = ?
            ";
            $items = $this->select($sql_items, [$order_id]);
        
            return [
                'success' => true,
                'message' => 'Lấy đơn hàng thành công',
                'data' => [
                    'order' => $order,
                    'items' => $items
                ]
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Không tìm thấy đơn hàng',
                'data' => null
            ];
        }
    }
}
?>