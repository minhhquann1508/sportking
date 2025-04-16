<?php
require_once '../app/configs/Database.php';
class Variant extends Database
{
    private $table = "product_variant";

    public function get_variant_by_product_id($product_id)
    {
        $sql = "SELECT * FROM $this->table
                Where product_id = ?";
        $response = $this->select($sql, [$product_id]);
        if ($response) {
            return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response];
        } else {
            return ['success' => false, 'message' => 'Lấy không thành công', 'data' => null];
        }
    }

    public function get_all_variant_by_product_id($product_id)
    {
        $sql = "SELECT 
                v.variant_id,
                v.price,
                v.stock,
                p.product_name,
                c.category_name,
                b.brand_name,
                co.color_id,
                co.color_name,
                co.color_hex,
                s.size_id,
                s.size_name,
                i.image_url
                FROM product_variant v
                INNER JOIN product p ON p.product_id = v.product_id
                INNER JOIN category c ON c.category_id = p.category_id
                INNER JOIN brands b ON b.brand_id = p.brand_id
                INNER JOIN color co ON co.color_id = v.color_id
                INNER JOIN size s ON s.size_id = v.size_id
                LEFT JOIN variant_image i ON i.variant_id = v.variant_id
                WHERE p.product_id = ?
                AND v.variant_id IS NOT NULL 
                ";
        $response = $this->select($sql, [$product_id]);
        if ($response) {
            return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response];
        } else {
            return ['success' => false, 'message' => 'Lấy không thành công', 'data' => null];
        }
    }

    public function add($price, $stock, $product_id, $size_id, $color_id)
    {
        $sql = "INSERT INTO $this->table (price, stock, product_id, size_id, color_id)
                    VALUES (?, ?, ?, ?, ?)";
        $response = $this->execute($sql, [$price, $stock, $product_id, $size_id, $color_id]);
        if ($response) {
            $lastId = $this->lastInsertId();
            return ['success' => true, 'message' => 'Thêm thành công', 'data' => $lastId];
        } else {
            return ['success' => false, 'message' => 'Thêm không thành công', 'data' => null];
        }
    }

    public function add_img($id, $imgs)
    {
        $values_string = '';
        $params = [];

        foreach ($imgs as $img) {
            $values_string .= '(?, ?),';
            $params[] = $img;
            $params[] = $id;
        }

        $values_string = rtrim($values_string, ',');

        $sql = "INSERT INTO variant_image (image_url, variant_id) VALUES $values_string";

        $response = $this->execute($sql, $params);

        if ($response) {
            return ['success' => true, 'message' => 'Thêm thành công', 'data' => null];
        } else {
            return ['success' => false, 'message' => 'Thêm không thành công', 'data' => null];
        }
    }

    public function get_all()
    {
        $sql = "SELECT 
                v.variant_id,
                v.price,
                v.stock,
                p.product_name,
                c.category_name,
                b.brand_name,
                co.color_name,
                co.color_hex,
                s.size_name,
                i.image_url
            FROM $this->table v
            INNER JOIN product p ON p.product_id = v.product_id
            INNER JOIN category c ON c.category_id = p.category_id
            INNER JOIN brands b ON b.brand_id = p.brand_id
            INNER JOIN color co ON co.color_id = v.color_id
            INNER JOIN size s ON s.size_id = v.size_id
            LEFT JOIN variant_image i ON i.variant_id = v.variant_id";
        $response = $this->select($sql);
        if ($response) {
            $variants = [];
            foreach ($response as $row) {
                $id = $row['variant_id'];
                if (!isset($variants[$id])) {
                    $variants[$id] = [
                        'variant_id' => $id,
                        'price' => $row['price'],
                        'stock' => $row['stock'],
                        'product_name' => $row['product_name'],
                        'category_name' => $row['category_name'],
                        'brand_name' => $row['brand_name'],
                        'color_name' => $row['color_name'],
                        'color_hex' => $row['color_hex'],
                        'size_name' => $row['size_name'],
                        'images' => [],
                    ];
                }
                if (!empty($row['image_url'])) {
                    $variants[$id]['images'][] = $row['image_url'];
                }
            }
            return ['success' => true, 'message' => 'Lấy danh sách thành công', 'data' => array_values($variants)];
        } else {
            return ['success' => false, 'message' => 'Lấy danh sách không thành công', 'data' => null];
        }
    }
    public function find_variant($product_id, $color_id, $size_id){
        $sql = "SELECT 
            v.*, 
            p.thumbnail, 
            p.product_name,
            c.color_name, 
            s.size_name 
        FROM product_variant v
        INNER JOIN product p ON p.product_id = v.product_id
        INNER JOIN color c ON v.color_id = c.color_id
        INNER JOIN size s ON v.size_id = s.size_id
        WHERE p.product_id = ? AND v.color_id = ? AND v.size_id = ?";
        $response = $this->select($sql, [$product_id, $color_id, $size_id]);
        if($response) {
            return ['success' => true, 'message' => 'Lấy thành công', 'data' => $response[0]];
        } else {
            return ['success' => false, 'message' => 'Lấy thất bại', 'data' => null];
        }
    }

    public function delete_variant($variant_id) {
        $sql1 = "DELETE FROM variant_image WHERE variant_id = ?";
        $res = $this->execute($sql1, [$variant_id]);
        if($res) {
            $sql2 = "DELETE FROM $this->table WHERE variant_id = ?";
            $response = $this->execute($sql2, [$variant_id]);
            if($response) {
                return ['success' => true, 'message' => 'Xoá thành công', 'data' => null];
            } else {
                return ['success' => false, 'message' => 'Xoá thất bại', 'data' => null];
            }
        } else {
            return ['success' => false, 'message' => 'Xoá thất bại', 'data' => null];
        }
    }
}