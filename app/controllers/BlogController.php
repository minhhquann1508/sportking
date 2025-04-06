<?php
require_once '../app/models/Blog.php';
    class BlogController {
        private $blogModel;
        public function __construct() {
            $this->blogModel = new Blog();
        }
        public function index() {
            $blogs = $this->blogModel->get_all_blogs();
            $data = $this->blogModel->get_all_blogs();
            if (isset($_GET['ajax']) && $_GET['ajax'] == true){
                // $data = array_merge($data, ['categories' => $categories]);
                echo json_encode($data);
                exit;
            }
            $content = '../app/views/pages/admin/blog/blog.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function get_list_blogs() {
            $response = $this->blogModel->get_all_blogs();
            echo json_encode($response);
        }

        public function add_blog_action() {
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $blog = $_POST;
                $response = $this->blogModel->add_blog($blog);
                echo json_encode($response);
                exit;   
            } 
    }

    public function delete_blog(){
        $blog_id = $_GET['blog_id'];
        $result = $this->blogModel->delete_blog($blog_id);
        if ($blog_id) {
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
        exit;
    }

    public function get_blog_by_id() {
        if (isset($_GET['id']) && $_GET['id']) {
            $blog_id = (int) $_GET['id'];
            $response = $this->blogModel->get_blog_by_id($blog_id);
            echo json_encode($response);
            exit;
        }
    }

    public function update_blog_by_id() {
        if (isset($_POST['blog_id']) && $_POST['blog_id']) {
            $blog_id = $_POST['blog_id'];
    
            // Lấy dữ liệu từng trường
            $blog = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'thumbnail' => $_POST['thumbnail'] ?? '',
                'is_public' => $_POST['is_public'] ?? 0
            ];
    
            $response = $this->blogModel->update_blog_by_id($blog_id, $blog);
            echo json_encode($response);
            exit;
        }
    }
    
}
?>