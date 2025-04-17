<!-- Models -->
<?php
    require_once '../app/configs/Database.php';
    class Comment extends Database{
        private $table = "comments";

    //     public function get_all_comments() {
    //         // Sử dụng alias để tránh xung đột tên cột
    //         $query = "SELECT 
    //                     c.comment_id,
    //                     c.content,
    //                     c.status,
    //                     u.fullname
    //                   FROM $this->table c
    //                   LEFT JOIN users u ON c.user_id = u.user_id
    //                   LEFT JOIN product p ON c.product_id = p.product_id
    //                   ORDER BY c.comment_id DESC";
        
    //         $result = $this->select($query);
        
    //         // Kiểm tra kết quả trả về
    //         if ($result !== false && is_array($result) && !empty($result)) {
    //             return [
    //                 'success' => true,
    //                 'message' => 'Lấy danh sách bình luận thành công',
    //                 'data' => $result
    //             ];
    //         } else {
    //             return [
    //                 'success' => false,
    //                 'message' => 'Không có bình luận nào',
    //                 'data' => []
    //             ];
    //     }
    // }


        // lấy tất cả các comment 
        public function get_all_comments(){
            $query = "SELECT * FROM $this->table ORDER BY comment_id DESC";
            $result = $this->select($query);
            if($result){
                return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $result];
            }else{
                return ['success' => false, 'message' => 'Lấy dữ liệu thất bại', 'data' => null];
            }
        }
        
        // lấy bình luận từ id của bình luận đó 
        public function get_comment_by_id($comment_id){
            $query = "SELECT * FROM $this->table WHERE comment_id = ?";
            $result = $this->execute($query, [$comment_id]);
            if($result){
                return ['success' => true, 'message' => 'Lấy dữ liệu thành công', 'data' => $result];
            }else{
                return ['success' => false, 'message' => 'Dữ liệu hiện chưa cập nhật', 'data' => null];
            }
        }
        // thêm bình luận mới 
        public function add_comment($user_id,$product_id,$content,$rating){
            $query ="INSERT INTO $this->table (user_id ,product_id, content,rating, created_at)
                                     VALUES (?,?,?,?,NOW())";
            $result = $this->execute($query,[$user_id,$product_id,$content,$rating]);  
            if($result){
                return ['success' => true, 'message' => 'Thêm thương hiệu thành công', 'data' => null];
            }else{
                return ['success' => false, 'message' => 'Thêm thương hiệu thất baị', 'data' => null];
            }                
        }
        // Xoá bình luận
        // public function delete_comment($comment_id){
        //     $query = "DELETE $this->table WHERE comment_id = :comment_id";
        //     $result = &this->execute($query,['comment_id' => $comment_id]);
        //     if($result){
        //         return ['success' => true, 'message' => 'Thêm thương hiệu thành công', 'data' => null];
        //     }else{
        //         return ['success' => false, 'message' => 'Thêm thương hiệu thất baị', 'data' => null];
        //     }
        //     // Kiểm tra kết quả trả về
        //     if ($result !== false && is_array($result) && !empty($result)) {
        //         return [
        //             'success' => true,
        //             'message' => 'Lấy danh sách bình luận thành công',
        //             'data' => $result
        //         ];
        //     } else {
        //         return [
        //             'success' => false,
        //             'message' => 'Không có bình luận nào',
        //             'data' => []
        //         ];
        //     }
        // }
        public function delete_comment($comment_id) {
            $query = "DELETE FROM $this->table WHERE comment_id = ?";
            return $this->execute($query, [$comment_id]);
        }


        public function filter_comments($user_id = null, $product_id = null) {
            $query = "SELECT c.*, u.username FROM $this->table c
                      JOIN users u ON c.user_id = u.user_id WHERE 1=1";
            $params = [];
    
            if ($user_id) {
                $query .= " AND c.user_id = ?";
                $params[] = $user_id;
            }
    
            if ($product_id) {
                $query .= " AND c.product_id = ?";
                $params[] = $product_id;
            }
    
            return $this->select($query, $params);
        }
    }


?>