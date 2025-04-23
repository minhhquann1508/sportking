<?php
    require_once '../app/models/Address.php';
    class AdressController {
        private $addressModel;
        public function __construct() {
            $this->addressModel = new Address();
        }
        public function add_address () {
            $ward = $_POST['ward'] ?? '';
            $district = $_POST['district'] ?? '';
            $city = $_POST['city'] ?? '';
            $street = $_POST['street'] ?? '';
            $user_id = $_POST['user_id'];
            $response = $this->addressModel->add($ward, $district, $city, $street, $user_id);
            echo json_encode($response);
            exit;
        } 
    }
?>