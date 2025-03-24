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
        
            // Lấy tổng số người dùng (áp dụng điều kiện tìm kiếm nếu có)
            $sqlTotal = "SELECT COUNT(*) as total FROM $this->table $sql_where";
            $totalUsers = $this->select($sqlTotal, $params)[0]['total'];
        
            // Lấy danh sách người dùng (thêm LIMIT, OFFSET vào params)
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
            $sql = "SELECT * FROM $this->table WHERE id =?";
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
    }
?>