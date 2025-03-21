<?php
    require_once '../app/configs/Database.php';
    class Brand extends Database{
        private $table = "brands";

        // Lấy tất cả thương hiệu
        public function get_all_brands() {
            $query = "SELECT * FROM $this->table ORDER BY brand_id DESC";
            return $this->select($query);
        }

        // Thêm thương hiệu mới
        public function add_brand($name_brand , $hinh_anh) {
            $query = "INSERT INTO  $this->table (brand_name, thumbnail) VALUES (?, ?)";
            $this->execute($query, [$name_brand , $hinh_anh]);
        }

        // Cập nhật thương hiệu
        public function update_brand($brand_id, $name_brand , $hinh_anh) {
            $query = "UPDATE  $this->table SET brand_name = ?, thumbnail = ? WHERE brand_id = ?";
            $this->execute($query, [$name_brand , $hinh_anh, $brand_id]);
        }

        // Xóa thương hiệu
        public function delete_brand($brand_id) {
            $query = "DELETE FROM  $this->table WHERE brand_id = ?";
            $this->execute($query, [$brand_id]);
        }
    }

?>