<?php
require_once '../app/models/Brand.php';

class BrandController {
    private $brandModel;

    public function __construct() {
        $this->brandModel = new Brand();
    }

    public function index() {
        
        if (isset($_GET['ajax'])) {
            if(isset($_POST["filter"])){
                if(isset($_POST["brand_name"])){
                    $brand_name = $_POST["brand_name"];
                    $result = $this->brandModel->filter_brand($brand_name);
                    echo json_encode($result);
                    exit;
                }
            } else {
                $brands = $this->brandModel->get_all_brands();
                echo json_encode($brands);
                exit;
            }
        }
        
        $content = '../app/views/pages/admin/brand/brand.php';
        include_once "../app/views/layouts/admin.php";
    }

    public function add_brand() {
            $name = $_POST['brand_name'] ;
            $hinh_anh = $_POST['thumbnail'] ;
            $result = $this->brandModel->add_brand($name, $hinh_anh);
            echo json_encode($result);
            exit;
    }

    public function deleteBrand() {
        $id = $_GET['brand_id'] ;
        $result = $this->brandModel->delete_brand($id);
        if ($id) {
           
            echo json_encode($result);
        } else {
            echo json_encode( $result);
        }
        exit;
    }

    public function updateBrand() {
        $id = $_POST['brand_id'] ;
        $name = $_POST['brand_name'] ;
        $hinh_anh = $_POST['thumbnail'] ;
        $result = $this->brandModel->update_brand($id, $name, $hinh_anh);
        if ($id && $name && $hinh_anh) { 
            echo json_encode($result);
        } else {
            echo json_encode($result);
        }
        exit;
    }
    public function filter_brand(){
        

    }
}
