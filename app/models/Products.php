<?php
require_once '../app/configs/Database.php';
class Products extends Database
{
    private $table = "product";

    public function get_all_variants_by_product_id($product_id)
    {
        $sql = "SELECT 
                    v.*,
                    p.product_name, p.sub_desc, p.views, p.solds,
                    cat.category_id, cat.category_name,
                    b.brand_id, b.brand_name,
                    i.image_url,
                    c.color_id, c.color_name, c.color_hex,
                    s.size_id, s.size_name,
                    fv.first_variant_id
                FROM product_variant v
                INNER JOIN product p ON v.product_id = p.product_id
                INNER JOIN category cat ON p.category_id = cat.category_id
                INNER JOIN brands b ON p.brand_id = b.brand_id
                INNER JOIN variant_image i ON i.variant_id = v.variant_id
                INNER JOIN color c ON c.color_id = v.color_id
                INNER JOIN size s ON s.size_id = v.size_id
                INNER JOIN (
                    SELECT product_id, MIN(variant_id) AS first_variant_id
                    FROM product_variant
                    GROUP BY product_id
                ) fv ON fv.product_id = v.product_id
                WHERE p.product_id = ?";

        $response = $this->select($sql, [$product_id]);

        if ($response) {
            $variants = [];
            $colors = [];
            $sizes = [];
            $images = [];
            $productInfo = null;
            $firstVariantId = null;

            foreach ($response as $row) {
                // Lấy thông tin sản phẩm chung
                if (!$productInfo) {
                    $productInfo = [
                        'product_name' => $row['product_name'],
                        'sub_desc' => $row['sub_desc'],
                        'views' => $row['views'],
                        'solds' => $row['solds'],
                        'category' => [
                            'category_id' => $row['category_id'],
                            'category_name' => $row['category_name']
                        ],
                        'brand' => [
                            'brand_id' => $row['brand_id'],
                            'brand_name' => $row['brand_name']
                        ]
                    ];
                    $firstVariantId = $row['first_variant_id'];
                }

                // Tập hợp variant
                $variantId = $row['variant_id'];
                if (!isset($variants[$variantId])) {
                    $variants[$variantId] = [
                        'variant_id' => $variantId,
                        'price' => $row['price'],
                        'stock' => $row['stock'],
                        'color_id' => $row['color_id'],
                        'size_id' => $row['size_id'],
                        'images' => []
                    ];
                }

                // Tập hợp ảnh
                if (!in_array($row['image_url'], $variants[$variantId]['images'])) {
                    $variants[$variantId]['images'][] = $row['image_url'];
                }

                // Tập hợp màu
                $colorKey = $row['color_id'];
                if (!isset($colors[$colorKey])) {
                    $colors[$colorKey] = [
                        'color_id' => $row['color_id'],
                        'color_name' => $row['color_name'],
                        'color_hex' => $row['color_hex']
                    ];
                }

                // Tập hợp size
                $sizeKey = $row['size_id'];
                if (!isset($sizes[$sizeKey])) {
                    $sizes[$sizeKey] = [
                        'size_id' => $row['size_id'],
                        'size_name' => $row['size_name']
                    ];
                }
            }

            return [
                'success' => true,
                'message' => 'Lấy thành công',
                'data' => [
                    'product' => $productInfo,
                    'variants' => array_values($variants),
                    'colors' => array_values($colors),
                    'sizes' => array_values($sizes),
                    'first_variant_id' => $firstVariantId
                ]
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Lấy không thành công',
                'data' => null
            ];
        }
    }


    public function get_all_products($page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit;
        $countSql = "SELECT COUNT(*) as total FROM $this->table";
        $countResult = $this->select($countSql);
        $total = $countResult ? (int)$countResult[0]['total'] : 0;

        $sql = "SELECT p.*, c.category_name, b.brand_name 
                    FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    ORDER BY product_id DESC
                    LIMIT $limit OFFSET $offset";
            $result = $this->select($sql);
        
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Lấy danh sách thành công',
                    'data' => $result,
                    'pagination' => [
                        'current_page' => (int) $page,
                        'limit' => $limit,
                        'total' => $total,
                        'total_pages' => ceil($total / $limit)
                    ]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Lấy danh sách thất bại',
                    'data' => null,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => 0,
                        'total_pages' => 0
                    ]
                ];
            }
        }
    }

    public function add_product($product)
    {
        $index = 0;
        $params = [];
        $key_string = '(';
        $query_string = 'VALUES(';
        foreach ($product as $key => $value) {
            if ($index < count($product) - 1) {
                $key_string .= $key . ',';
                $query_string .= '?,';
            } else {
                $key_string .= $key . ')';
                $query_string .= '?)';
            }
            $index++;
            $params[] = $value;
        }
        $sql = "INSERT INTO $this->table $key_string $query_string";
        $response = $this->execute($sql, $params);
        if ($response) {
            return ['success' => true, 'message' => 'Thêm mới thành công', 'data' => null];
        } else {
            return ['success' => false, 'message' => 'Thêm mới thất bại', 'data' => null];
        }
    }

    public function get_product_by_id($id)
    {
        $sql = "SELECT p.*, c.category_name, b.brand_name FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    WHERE product_id = ?";
        $result = $this->select($sql, [$id]);
        if ($result) {
            return ['success' => true, 'message' => 'Lấy sản phẩm thành công', 'data' => $result];
        } else {
            return ['success' => false, 'message' => 'Lấy sản phẩm thất bại', 'data' => null];
        }
    }

    public function update_product_by_id($id, $product)
    {
        $index = 0;
        $params = [];
        $key_string = "SET ";
        foreach ($product as $key => $value) {
            if ($index < (count($product) - 1)) {
                $key_string .= $key . '= ?,';
            } else {
                $key_string .= $key . '= ?';
            }
            $index++;
            $params[] = $value;
        }
        $params[] = $id;
        $sql = "UPDATE $this->table $key_string WHERE product_id = ?";
        $result = $this->execute($sql, $params);
        if ($result) {
            return ['success' => true, 'message' => 'Cập nhật sản phẩm thành công', 'data' => null];
        } else {
            return ['success' => false, 'message' => 'Cập nhật sản phẩm thất bại', 'data' => null];
        }
    }

    public function delete_product($id)
    {
        $sql = "DELETE FROM $this->table WHERE product_id = ?";
        $result = $this->execute($sql, [$id]);
        if ($result) {
            return ['success' => true, 'message' => 'Xoá sản phẩm thành công', 'data' => null];
        } else {
            return ['success' => false, 'message' => 'Xoá sản phẩm thất bại', 'data' => null];
        }

        public function search_product($search_params, $page = 1, $limit = 10) {
            $product_name = $search_params['product_name'] ?? '';
            $brand_id = $search_params['brand_id'] ?? '';
            $category_id = $search_params['category_id'] ?? '';
        
            $where = [];
        
            if (!empty($product_name)) {
                $product_name = preg_replace('/[^a-zA-Z0-9\s]/', '', $product_name);
                $where[] = "p.product_name LIKE '%$product_name%'";
            }
        
            if (!empty($brand_id)) {
                $where[] = "p.brand_id = " . (int)$brand_id;
            }
        
            if (!empty($category_id)) {
                $where[] = "p.category_id = " . (int)$category_id;
            }
        
            $where_sql = '';
            if (!empty($where)) {
                $where_sql = 'WHERE ' . implode(' AND ', $where);
            }
        
            $offset = ($page - 1) * $limit;
        
            // Truy vấn dữ liệu
            $sql = "SELECT p.*, c.category_name, b.brand_name 
                    FROM $this->table p 
                    INNER JOIN category c ON c.category_id = p.category_id
                    INNER JOIN brands b ON b.brand_id = p.brand_id
                    $where_sql
                    ORDER BY p.product_id DESC
                    LIMIT $limit OFFSET $offset";
        
            $result = $this->select($sql);
        
            // Truy vấn tổng số dòng
            $count_sql = "SELECT COUNT(*) as total
                          FROM $this->table p
                          INNER JOIN category c ON c.category_id = p.category_id
                          INNER JOIN brands b ON b.brand_id = p.brand_id
                          $where_sql";
        
            $count_result = $this->select($count_sql);
            $total = $count_result[0]['total'] ?? 0;
        
            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Lấy danh sách thành công',
                    'data' => $result,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => (int)$total,
                        'total_pages' => ceil($total / $limit)
                    ]
                ];
            } else {
                return [
                    'success' => false,
                    'message' => 'Lấy danh sách thất bại',
                    'data' => null,
                    'pagination' => [
                        'current_page' => (int)$page,
                        'limit' => $limit,
                        'total' => 0,
                        'total_pages' => 0
                    ]
                ];
            }
        }
    }
}
