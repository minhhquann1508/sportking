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

        public function get_all_users($limit = 20, $offset = 0) {
            $sql = "SELECT user_id, email, fullname, phone, role, created_at, updated_at FROM $this->table LIMIT ? OFFSET ?";
            $users = $this->select($sql, [$limit, $offset]);
            return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $users];
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
    }
?>