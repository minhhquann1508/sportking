<?php 
    require_once '../app/configs/Database.php';
    class Category extends Database{
        private $table = "category";
        public function get_all_category() {
            $sql = "SELECT * FROM $this->table";
            return $this->select($sql);
        }

        public function add_category($category_name) {
            $check_sql = "SELECT COUNT(*) FROM category WHERE category_name = ?";
            $check_result = $this->select($check_sql, [$category_name]);
            if ($check_result && $check_result[0]['COUNT(*)'] > 0) {
                return "Danh mục đã tồn tại!";
            }
            $sql = "INSERT INTO category (category_name, created_at, updated_at) 
                    VALUES (?, NOW(), NOW())";
            return $this->execute($sql, [$category_name]);
        }

        public function delete_category($category_id) {
            $check_sql = "SELECT COUNT(*) FROM category WHERE category_id = ?";
            $check_result = $this->select($check_sql, [$category_id]);
            if ($check_result && $check_result[0]['COUNT(*)'] == 0) {
                return "Danh mục không tồn tại!";
            }
            $sql = "DELETE FROM category WHERE category_id = ?";
            return $this->execute($sql, [$category_id]);
        }

        public function update_category($category_id, $new_category_name) {
            $check_sql = "SELECT COUNT(*) FROM category WHERE category_id = ?";
            $check_result = $this->select($check_sql, [$category_id]);
            if ($check_result && $check_result[0]['COUNT(*)'] == 0) {
                return "Danh mục không tồn tại!";
            }
            $duplicate_sql = "SELECT COUNT(*) FROM category WHERE category_name = ? AND category_id != ?";
            $duplicate_result = $this->select($duplicate_sql, [$new_category_name, $category_id]);
            if ($duplicate_result && $duplicate_result[0]['COUNT(*)'] > 0) {
                return "Tên danh mục đã tồn tại!";
            }
            $sql = "UPDATE category SET category_name = ?, updated_at = NOW() WHERE category_id = ?";
            return $this->execute($sql, [$new_category_name, $category_id]);
        }
    }
?>