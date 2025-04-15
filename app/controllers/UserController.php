<?php
    require_once '../app/models/Users.php';
    class UserController {
        private $userModel;
        public function __construct() {
            $this->userModel = new User();
        }
        public function index() {
            $queries = [];
            if (isset($_POST['email']) && $_POST['email']) {
                $queries['email'] = $_POST['email']; 
            }
            if (isset($_POST['fullname']) && $_POST['fullname']) {
                $queries['fullname'] = $_POST['fullname']; 
            }
            if (isset($_POST['phone']) && $_POST['phone']) {
                $queries['phone'] = $_POST['phone']; 
            }
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $data = $this->userModel->get_all_users($page, $queries);
            if (isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
                echo json_encode($data);
                exit;
            } 
            else {
                $content = '../app/views/pages/admin/user/user.php';
                include_once "../app/views/layouts/admin.php";
            }
        }
        public function add_user_by_admin() {
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $response = $this->userModel->add_user_by_admin($email, $fullname, $password, $phone);
            echo json_encode($response);
        }

        // 
    }
?>