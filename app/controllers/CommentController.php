<?php
require_once '../app/models/Comment.php';
    class CommentController {
        private $commentModel;
        public function __construct() {
            $this->commentModel = new Comment();
        }

        public function index() {
            if (isset($_GET['ajax'])) {
                header('Content-Type: application/json');
                $comments = $this->commentModel->get_all_comments();  // Đúng tên hàm trong Model
                echo json_encode($comments);
                exit;
            }
            $content = '../app/views/pages/admin/comment/comment.php';
            include_once "../app/views/layouts/admin.php";
        }
    
        // Xóa bình luận
        public function delete_comment() {
            $comment_id = $_POST['comment_id'];
            $result = $this->commentModel->delete_comment($comment_id);
            echo json_encode($result);
            exit;
        }
    
        // Lọc bình luận
        public function filter_comments() {
            $user_id = $_POST['user_id'] ?? null;
            $product_id = $_POST['product_id'] ?? null;
    
            $result = $this->commentModel->filter_comments($user_id, $product_id);
            echo json_encode($result);
            exit;
        }
    }
    
?>