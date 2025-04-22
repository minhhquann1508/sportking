<?php
require_once '../app/configs/Database.php';
class Home extends Database
{
    private $tableProduct = "product";
    private $tableCategory = "category";
    private $tableBrand = "brands";
    private $tableUser = "users";
    private $tableComment = "comments";

    public function getUserByEmail($email)
    {
        $sql = "SELECT u.*, a.* FROM $this->tableUser u 
            LEFT JOIN address a ON a.user_id = u.user_id
            WHERE u.email = ?";
        $data = $this->select($sql, [$email]);
        if (!empty($data)) {
            return $data[0];
        }
        return null;
    }

    public function get_all_products()
    {
        $sql = "SELECT p.*, c.category_name, b.brand_name FROM product p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id";
        $result = $this->select($sql);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }
    public function updateUser($fullname, $email, $phone)
    {
        $sql = "UPDATE $this->tableUser SET fullname = ?, phone = ?, updated_at = NOW() WHERE email = ?";
        $result = $this->execute($sql, [$fullname, $phone, $email]);
        if ($result) {
            return ['success' => true, 'message' => 'Cap nhat thanh cong', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Cap nhat that bai', 'data' => null];
        }
    }
    public function checkAddressExists($userId)
    {
        $sql = "SELECT * FROM address WHERE user_id = ?";
        $result = $this->select($sql, [$userId]);
        return !empty($result);
    }

    public function updateUserAddress($city, $district, $ward, $street, $userId)
    {
        $check = $this->checkAddressExists($userId);
        if ($check) {
            $sql = "UPDATE address 
                        SET city = ?, district = ?, ward = ?, street = ?
                        WHERE user_id = ?";
            $result = $this->execute($sql, [$city, $district, $ward, $street, $userId]);
        } else {
            $sql = "INSERT INTO address (city, district, ward, street, user_id)
                        VALUES (?, ?, ?, ?, ?)";
            $result = $this->execute($sql, [$city, $district, $ward, $street, $userId]);
        }

        if ($result !== false) {
            return ['success' => true, 'message' => 'Cập nhật địa chỉ thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Cập nhật thất bại', 'data' => null];
        }
    }


    public function updateUserPassword($email, $new_password)
    {
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $result = $this->execute($sql, [$new_password, $email]);
        if ($result) {
            return ['success' => true, 'message' => 'Cap nhat thanh cong', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Cap nhat that bai', 'data' => null];
        }
    }

    public function get_all_order_by_user_id($user_id)
    {
        $sql = "SELECT o.*, p.*, oi.*, pv.*, sz.*, cl.* FROM orders o 
                    JOIN order_items oi ON oi.order_id = o.order_id
                    JOIN product_variant pv ON pv.variant_id = oi.variant_id 
                    JOIN size sz ON sz.size_id = pv.size_id
                    JOIN color cl ON cl.color_id = pv.color_id
                    JOIN product p ON p.product_id = pv.product_id
            WHERE o.user_id = ?";
        $result = $this->select($sql, [$user_id]);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }
    public function get_product_by_id($product_id)
    {
        $sql = "SELECT p.*, c.category_name, b.brand_name FROM $this->tableProduct p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    WHERE product_id = ?";
        $result = $this->select($sql, [$product_id]);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy sản phẩm thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy sản phẩm thất bại', 'data' => null];
        }
    }
    public function get_all_comment_by_product_id($product_id)
    {
        $sql = "SELECT cmt.*, cmt.create_at AS ngay_binh_luan, u.fullname, u.user_id, p.* FROM $this->tableComment cmt
                    JOIN $this->tableUser u ON u.user_id = cmt.user_id
                    JOIN $this->tableProduct p ON p.product_id = cmt.product_id
                    WHERE cmt.product_id = ?";
        $result = $this->select($sql, [$product_id]);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thất bại', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }
    public function get_filtered_products($category, $brand, $price)
    {
        $sql = "SELECT p.*, pv.*, c.category_name, b.brand_name 
                    FROM $this->tableProduct p 
                    LEFT JOIN product_variant pv ON pv.product_id = p.product_id
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    WHERE 1=1";

        if ($category) {
            $sql .= " AND p.category_id = $category";
        }

        if ($brand) {
            $sql .= " AND p.brand_id = $brand";
        }

        if ($price) {
            if ($price == '1') {
                $sql .= " AND pv.price < 1000000";
            } elseif ($price == '2') {
                $sql .= " AND pv.price BETWEEN 1000000 AND 5000000";
            } elseif ($price == '3') {
                $sql .= " AND pv.price BETWEEN 5000000 AND 10000000";
            } elseif ($price == '4') {
                $sql .= " AND pv.price > 10000000";
            }
        }

        $result = $this->select($sql);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }

    public function get_all_categorys()
    {
        $sql = "SELECT c.*FROM $this->tableCategory c";
        $result = $this->select($sql);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }
    public function get_all_brands()
    {
        $sql = "SELECT b.*FROM $this->tableBrand b";
        $result = $this->select($sql);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách thất bại', 'data' => null];
        }
    }
}