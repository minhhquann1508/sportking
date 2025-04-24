<?php

require_once '../app/models/Comment.php';
class CommentController {
    private $commentModel;
    public function __construct() {
        $this->commentModel = new Comment();
    }

    public function index() {
        $content = '../app/views/pages/admin/comment/comment.php';
        include_once "../app/views/layouts/admin.php";
    }
    
    public function get_comments() {
        $comments = $this->commentModel->get_all_comments();
        echo json_encode($comments);
        exit;
    }

    public function delete_comment() {
        $comment_id = $_POST['comment_id'];
        $result = $this->commentModel->delete_comment($comment_id);
        echo json_encode($result);
        exit;
    }

    public function filter_comments() {
        $user_id = $_POST['user_id'] ?? null;
        $product_id = $_POST['product_id'] ?? null;

        $result = $this->commentModel->filter_comments($user_id, $product_id);
        echo json_encode($result);
        exit;
    }

    public function toggle_status() {
        $comment_id = $_POST['comment_id'] ?? null;
        $new_status = $_POST['new_status'] ?? null;
    
        if ($comment_id === null || $new_status === null) {
            echo json_encode([
                'success' => false,
                'message' => 'Thiếu dữ liệu.'
            ]);
            return;
        }
    
        $result = $this->commentModel->updateStatus($comment_id, $new_status);
    
        echo json_encode([
            'success' => $result,
            'message' => $result ? 'Trạng thái bình luận đã được cập nhật.' : 'Cập nhật thất bại.'
        ]);
    }
}
?>