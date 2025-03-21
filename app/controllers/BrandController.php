<?php
   require_once '../app/models/Brand.php';

    class BrandController {
        // public function __construct() {
        //     $this->productModel = new Products();
        private $brandModel;
        public function __construct() {
            $this->brandModel = new Brand();
        }
        // }
        public function index() {
            // Lấy tất cả thương hiệu
            $brands = $this->brandModel->get_all_brands();
            $content = '../app/views/pages/admin/brand.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function add_brand(){
            if(isset ($_POST["add_brand"]) ){
                $name_brand = $_POST['name_brand'];
                $hinh_anh = $_POST['hinh_anh'];
                if($name_brand === "" || $hinh_anh === ""){
                    echo ` <script>
                                aler('vui lòng điền đủ từ ')
                            </script>`;
                }else{
                    $brandModel->$this->brandModel->add_brand( $name_brand, $hinh_anh);
                }
            }
            
            // Thêm một thương hiệu mới
            
            $content = '../app/views/pages/admin/brand.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function update_brand(){
            // Cập nhật thương hiệu
            $brandModel->$this->brandModel->update_brand(1, "Nike", "nike_updated.jpg");
            $content = '../app/views/pages/admin/brand.php';
            include_once "../app/views/layouts/admin.php";
        }

        public function delete_brand($id){
            // Xóa thương hiệu
            $brandModel->$this->brandModel->delete_brand(3);
            $content = '../app/views/pages/admin/brand.php';
            include_once "../app/views/layouts/admin.php";
        }       

    }

?>

 

