<?php 
    require_once '../app/configs/Database.php';
    class Blog extends Database{
        private $table = "blogs";
        public function get_all_blogs() {
            $sql = "SELECT blogs.*, users.fullname 
                    FROM $this->table 
                    LEFT JOIN users ON blogs.author_id = users.user_id";
            $data = $this->select($sql);
            return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $data];
            
        }
        public function get_by_quantity($number=3){
            $sql = "SELECT blogs.*, users.fullname 
                    FROM $this->table 
                    LEFT JOIN users ON blogs.author_id = users.user_id
                    ORDER BY blog_id DESC LIMIT $number";
            $data = $this->select($sql);
            return ['success' => true, 'message' => 'Lấy dữ liệu therap', 'data' => $data];
        }
        public function add_blog($blog) {
            $index = 0;
            $params = [];
            $key_string = '(';
            $query_string = 'VALUES(';
            foreach($blog as $key => $value) {
                if($index < count($blog) - 1) {
                    $key_string .= $key . ',';
                    $query_string .= '?,';
                } else {
                    $key_string .= $key . ')';
                    $query_string .= '?)';
                }
                $index++; 
                $params[] = $value;
            }
            $sql = "INSERT INTO $this->table $key_string $query_string";
            $response = $this->execute($sql, $params);
            if($response) {
                return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
            }
        }
        public function get_by_quantity(){
            $sql = "SELECT blogs.*
                    FROM $this->table 
                    limit 4";
            $data = $this->select($sql);
            return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $data];
            
        }
        public function delete_blog($blog_id) {
            $sql = "DELETE FROM blogs WHERE blog_id = ?";
            $response = $this->execute($sql, [$blog_id]);
            if ($response){
                return ['success' => true, 'message' => 'xoá thành công', 'data' => null];

            }else{
                return ['success' => false, 'message' => 'xoá thất bại', 'data' => null];
            } 
        } 

        public function get_blog_by_id($id) {
            $sql = "SELECT blogs.*, users.fullname
                    FROM $this->table 
                    INNER JOIN users ON blogs.author_id = users.user_id
                    WHERE blog_id = ?";
            $result = $this->select($sql, [$id]);
            if ($result) {
                return ['success' => true, 'message' => 'Lấy bài viết thành công', 'data' => $result[0]];
            } else {
                return ['success' => false, 'message' => 'Lấy bài viết thất bại', 'data' => null];
            }
        }
        
        public function update_blog_by_id($id, $blog) {
            $index = 0;
            $params = [];
            $set_string = "SET ";
            foreach ($blog as $key => $value) {
                $set_string .= $key . ' = ?';
                $params[] = $value;
                if ($index < count($blog) - 1) {
                    $set_string .= ', ';
                }
                $index++;
            }
            $params[] = $id;
        
            $sql = "UPDATE $this->table $set_string WHERE blog_id = ?";
            $result = $this->execute($sql, $params);
        
            if ($result) {
                return ['success' => true, 'message' => 'Cập nhật bài viết thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Cập nhật bài viết thất bại', 'data' => null];
            }
        }
        
    }
?>