<?php
    require_once '../app/models/Users.php';
    class UserController {
        private $userModel;
        public function __construct() {
            $this->userModel = new User();
        }
        public function index() {
            $data = $this->userModel->get_all_users();
            if(isset($_GET['ajax']) && $_GET['ajax'] == 'true') {
                echo json_encode($data);
                exit; 
            }
            $content = '../app/views/pages/admin/user/user.php';
            include_once "../app/views/layouts/admin.php";
        }
        public function add_user_by_admin() {
            $email = $_POST['email'];
            $fullname = $_POST['fullname'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $response = $this->userModel->add_user_by_admin($email, $fullname, $password, $phone);
            echo json_encode($response);
        }
    }
?>