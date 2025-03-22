<?php
require_once __DIR__ . '/../models/Brand.php';

class BrandController {
    private $brandModel;

    public function __construct() {
        $this->brandModel = new Brand();
    }

    public function index() {
        if (isset($_GET['ajax'])) {
            $brands = $this->brandModel->getAllBrands();
            echo json_encode($brands);
        }
    }

    public function addBrand() {
        $name = $_POST['brand_name'] ?? null;
        $thumbnail = $_POST['thumbnail'] ?? null;

        if ($name && $thumbnail) {
            $this->brandModel->addBrand($name, $thumbnail);
            echo json_encode(["success" => true, "message" => "Thêm thương hiệu thành công"]);
        } else {
            echo json_encode(["success" => false, "message" => "Thiếu dữ liệu"]);
        }
    }

    public function deleteBrand() {
        $id = $_GET['brand_id'] ?? null;

        if ($id) {
            $this->brandModel->deleteBrand($id);
            echo json_encode(["success" => true, "message" => "Xóa thương hiệu thành công"]);
        } else {
            echo json_encode(["success" => false, "message" => "Không tìm thấy ID"]);
        }
    }

    public function updateBrand() {
        $id = $_POST['brand_id'] ?? null;
        $name = $_POST['brand_name'] ?? null;
        $thumbnail = $_POST['thumbnail'] ?? null;

        if ($id && $name && $thumbnail) {
            $this->brandModel->updateBrand($id, $name, $thumbnail);
            echo json_encode(["success" => true, "message" => "Cập nhật thương hiệu thành công"]);
        } else {
            echo json_encode(["success" => false, "message" => "Thiếu dữ liệu"]);
        }
    }
}
