<?php
    require_once '../app/models/Users.php';

    class AuthController {
        private $userModel;
        public function __construct() {
            $this->userModel = new User();
        }
        public function index() {
            if(isset($_POST['login']) && $_POST['login']) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $data = $this->userModel->login($email, $password);
                if($data['success'] && is_array($data['data'])) {
                    $_SESSION['email'] = $data['data']['email'];
                }
                echo json_encode($data);
                exit;
            }
            $content = '../app/views/pages/user/login.php';
            include_once "../app/views/layouts/default.php";
        }

        public function register() {
            if(isset($_POST['register']) && $_POST['register']) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                $is_match = $password === $confirm_password;
                if (!$is_match) {
                    echo json_encode(['success' => false, 'message' => 'Mật khẩu không phù hợp', 'data' => null]);
                    exit;
                } 
                $response = $this->userModel->register($email, $password);
                if ($response) {
                    echo json_encode(['success' => true, 'message' => 'Đăng ký thành công', 'data' => null]);
                    exit;
                } else {
                    echo json_encode(['success' => false, 'message' => 'Đăng ký thất bại! Email đã tồn tại?', 'data' => null]);
                    exit;
                }
            }
            $content = '../app/views/pages/user/register.php';
            include_once "../app/views/layouts/default.php";
        }
    }
?>