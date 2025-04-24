<?php 
    require_once '../app/configs/Database.php';
    class User extends Database{
        private $table = "users";
        public function register($email, $password) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO $this->table (email, password)
                    VALUES (?, ?)";
            return $this->execute($sql, [$email, $hashed_password]);
        }
        public function login($email, $password) {
            $sql = "SELECT * FROM $this->table WHERE email = ?";
            $data= $this->select($sql, [$email]);
            if (!is_array($data) || empty($data)) {
                return ['success' => false, 'message' => 'Email này không tồn tại', 'data' => null];
            }
            $user = $data[0];
            if(password_verify($password, $user['password'])) {
                return ['success' => true, 'message' => 'Đăng nhập thành công', 'data' => $user];
            } else {
                return ['success' => false, 'message' => 'Mật khẩu hoặc email không đúng', 'data' => null];
            }
        }

        public function get_all_users($page, $queries) {
            $limit = 10;
            $offset = ($page - 1) * $limit;
            $sql_where = "";
            $params = [];
        
            if (!empty($queries)) {
                $conditions = [];
                foreach ($queries as $key => $value) {
                    $conditions[] = "$key LIKE ?";
                    $params[] = "%$value%";
                }
                $sql_where = " WHERE " . implode(" AND ", $conditions);
            }
        
            $sqlTotal = "SELECT COUNT(*) as total FROM $this->table $sql_where";
            $totalUsers = $this->select($sqlTotal, $params)[0]['total'];
        
            $sqlUsers = "SELECT user_id, email, fullname, phone, role, created_at, updated_at 
                         FROM $this->table $sql_where LIMIT ? OFFSET ?";
            
            array_push($params, $limit, $offset);
            $users = $this->select($sqlUsers, $params);
        
            return [
                'success' => true,
                'message' => 'Lấy dữ liệu thành công',
                'data' => $users,
                'total' => $totalUsers
            ];
        }

        public function get_user_by_id($id) {
            $sql = "SELECT u.*, a.* FROM $this->table u
            LEFT JOIN address a ON a.user_id = u.user_id
            WHERE u.user_id =?";
            return $this->select($sql, [$id]);
        }

        public function update_user($id, $data) {
            // $fields = array_keys($data);
            // $setClause = implode(" = ?, ", $fields) . " = ?";
            $setClause = set_fields($data);
            $values = array_values($data);
            $values[] = $id; 
            $sql = "UPDATE $this->table SET $setClause WHERE id = ?";
            return $this->execute($sql, $values);
        }
        public function add_user_by_admin($email, $fullname, $password, $phone) {
            $check_email_sql = "SELECT COUNT(*) FROM $this->table WHERE email = ?";
            $check_email_result = $this->select($check_email_sql, [$email]);
            if($check_email_result && $check_email_result[0]['COUNT(*)'] > 0) {
                return ['success' => false, 'message' => 'Email này đã tồn tại', 'data' => null];
            }
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(email, fullname, password, phone, role)
                    VALUES (?, ?, ?, ?, ?)";
            $response = $this->execute($sql, [$email, $fullname, $hashed_password, $phone, 1]);
            if($response) {
                return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
            }
        }

        public function CheckEmail($emailSend) {
            $sql = "SELECT COUNT(*) as dem FROM $this->table WHERE email = ?";
            $result = $this->select($sql, [$emailSend]);
        
            if ($result && isset($result[0]['dem'])) {
                return $result[0]['dem'] > 0 ? 10 : 0;
            }
        
            return 0;
        }
        public function CapNhatPassMoi($emailSend, $pass_moi) {
            $hashedPass = password_hash($pass_moi, PASSWORD_DEFAULT);
            $sql = "UPDATE $this->table SET password = ? WHERE email = ?";
            $result = $this->execute($sql, [$hashedPass, $emailSend]);
        
            if ($result) {
                return [
                    'success' => true,'message' => 'Cập nhật mật khẩu thành công','data' => null];
            } else {
                return [
                    'success' => false,'message' => 'Cập nhật mật khẩu thất bại','data' => null];
            }
        }        
        public function GuiMailPassMoi($emailSend, $pass_moi) {
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
                $mail->addAddress($emailSend);
        
                $mail->isHTML(true);  
                $mail->Subject = 'SPORTKING gửi mật khẩu mới';
                $mail->Body = '
                        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: auto; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #f9f9f9;">
                            <div style="text-align: center;">
                                <h2 style="color: #4a90e2;">🔐 Yêu cầu đặt lại mật khẩu</h2>
                            </div>
                            <p style="font-size: 16px; color: #333;">Xin chào,</p>
                            <p style="font-size: 16px; color: #333;">Bạn đã yêu cầu khôi phục mật khẩu cho tài khoản của mình. Dưới đây là mật khẩu mới của bạn:</p>
                            <div style="text-align: center; margin: 30px 0;">
                                <span style="display: inline-block; background-color: #4a90e2; color: white; padding: 12px 20px; border-radius: 6px; font-size: 18px; font-weight: bold;">
                                    ' . htmlspecialchars($pass_moi) . '
                                </span>
                            </div>
                            <p style="font-size: 16px; color: #333;">Hãy đăng nhập bằng mật khẩu này và đổi lại mật khẩu sau khi đăng nhập để bảo mật tài khoản của bạn.</p>
                            <p style="font-size: 14px; color: #888;">Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
                            <hr style="margin: 20px 0;">
                            <p style="font-size: 13px; color: #aaa; text-align: center;">© 2025 SPORTKING Team - Mọi quyền được bảo lưu.</p>
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
                    'success' => true,'message' => 'Gửi mật khẩu mới thành công','data' => null];
            } catch (Exception $e) {
                return [
                    'success' => false,'message' => 'Gửi mật khẩu mới thất bại: ' . $mail->ErrorInfo,'data' => null];
            }
        }        
        
    }
?>