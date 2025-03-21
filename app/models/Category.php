<?php 
require_once '../app/configs/Database.php';

class Category extends Database {
    private $table = "category";

    public function get_all_category() {
        $sql = "SELECT * FROM $this->table";
        return $this->select($sql);
    }

    public function check_name($category_name, $exclude_id = null) {
        $sql = "SELECT COUNT(*) AS count FROM category WHERE category_name = ?";
        $params = [$category_name];

        if ($exclude_id !== null) {
            $sql .= " AND category_id != ?";
            $params[] = $exclude_id;
        }

        $result = $this->select($sql, $params);
        return $result && $result[0]['count'] > 0;
    }

    public function add_category($category_name) {
        $sql = "INSERT INTO category (category_name, created_at, updated_at) VALUES (?, NOW(), NOW())";
        return $this->execute($sql, [$category_name]);
    }

    public function delete_category($category_id) {
        $sql = "DELETE FROM category WHERE category_id = ?";
        return $this->execute($sql, [$category_id]);
    }

    public function update_category($category_id, $new_category_name) {
        $sql = "UPDATE category SET category_name = ?, updated_at = NOW() WHERE category_id = ?";
        return $this->execute($sql, [$new_category_name, $category_id]);
    }
}
?>