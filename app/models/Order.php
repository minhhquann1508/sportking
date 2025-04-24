<?php
require_once '../app/configs/Database.php';

class Order extends Database
{
    private $table = "orders";
    private $table_item = "order_items";
    public function orders_list()
    {
        $sql = "SELECT * FROM orders";
        $response = $this->select($sql);
        if ($response) {
            return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response];
        } else {
            return ['success' => false, 'message' => 'Lấy không thành công', 'data' => null];
        }
    }

    public function get_all_orders($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $countSql = "SELECT COUNT(*) as total FROM $this->table";
        $countResult = $this->select($countSql);
        $total = $countResult ? (int)$countResult[0]['total'] : 0;

        $sql = "SELECT o.*, i.* 
                    FROM order_items i
                    INNER JOIN orders o ON o.order_id = i.order_id
                    WHERE 1
                    ORDER BY o.order_id ASC
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

    public function orders_items_list()
    {
        $sql = "  SELECT o.*, i.* 
                    FROM order_items i
                    INNER JOIN orders o ON o.order_id = i.order_id
                    WHERE 1
                    ORDER BY o.order_id ASC";
        $response = $this->select($sql);
        if ($response) {
            return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response];
        } else {
            return ['success' => false, 'message' => 'Lấy không thành công', 'data' => null];
        }
    }
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
        $sql = "INSERT INTO {$this->table} (user_id, address_id, voucher_id, total_amount, status)
                VALUES (?, ?, ?, ?, 0)";
        $response = $this->execute($sql, [$user_id, $address_id, $voucher_id, $total_amount]);

        if ($response) {
            $order_id = $this->lastInsertId();

            // Duyệt qua các sản phẩm và thêm vào bảng order_items
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

                // Giảm số lượng stock của variant
                $update_stock_sql = "UPDATE product_variant 
                                     SET stock = stock - ? 
                                     WHERE variant_id = ?";
                $update_stock_response = $this->execute($update_stock_sql, [
                    $item['quantity'],
                    $item['variant_id']
                ]);

                if (!$update_stock_response) {
                    return [
                        'success' => false,
                        'message' => 'Cập nhật stock của variant thất bại',
                        'data' => null
                    ];
                }
            }

            // Xử lý giảm cart và gửi email thông báo như bình thường

            // Truy vấn order data, bao gồm thông tin người dùng, voucher và địa chỉ
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
                $mail->Body = '...'; // Nội dung email như đã có

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

    public function get_order_by_id($order_id)
    {
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

    public function get_total()
    {
        $sql = "SELECT SUM(total_amount) AS total FROM orders WHERE status = 4";
        $result = $this->select($sql);
        return $result[0]['total'] ?? 0;
    }

    public function get_total_orders() {
        $sql = "SELECT COUNT(*) AS total_orders FROM orders";
        $result = $this->select($sql); 
        return $result[0]['total_orders'] ?? 0;
    }

    public function get_user_by_order() {
        $sql = "SELECT a.city, COUNT(DISTINCT o.user_id) AS user_count
            FROM orders o
            JOIN address a ON o.address_id = a.address_id
            GROUP BY a.city";
        $res = $this->select($sql);
        return $res;
    }

    public function getRevenueByDay() {
        $sql = "SELECT SUM(total_amount) AS revenue
            FROM orders
            WHERE status = '4'
            AND DATE(order_date) = CURDATE()";
        return $this->select($sql);
    }

    public function getRevenueByWeek() {
        $sql = "SELECT SUM(total_amount) AS revenue 
            FROM orders 
            WHERE YEARWEEK(order_date, 1) = YEARWEEK(CURDATE(), 1)
            AND status = '4'";
        return $this->select($sql);
    }

    public function getRevenueByMonth() {
        $sql = "SELECT SUM(total_amount) AS revenue 
                FROM orders 
                WHERE MONTH(order_date) = MONTH(CURDATE()) 
                AND YEAR(order_date) = YEAR(CURDATE())
                AND status = '4'";
        return $this->select($sql);
    }
}
