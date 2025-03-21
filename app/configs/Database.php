<?php 
    class Database {
        protected $conn;

        public function __construct() {
            $host = "localhost";
            $dbname = "sportking";
            $username = "root";
            $password = "";
    
            try {
                $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Kết nối thất bại: " . $e->getMessage());
            }
        }

        // Thực hiện truy vấn select
        public function select($query, $params = []) {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Thực hiện truy vấn thêm, xoá, sửa
        public function execute($query, $params = []) {
            $stmt = $this->conn->prepare($query);
            return $stmt->execute($params);
        }

        // Lấy id của bản ghi mới được thêm vào
        public function lastInsertId() {
            return $this->conn->lastInsertId();
        }
    }
?>