<?php
require_once '../app/models/Voucher.php';
 
class VoucherController {
    private $voucherModel;

    public function __construct() {
        $this->voucherModel = new Voucher();
    }

    public function index() {
        // Kiểm tra nếu là AJAX request
        if ($this->isAjaxRequest()) {
            $vouchers = $this->voucherModel->getVouchers();
            $this->jsonResponse($vouchers);
            exit;
        }
        
        // Render view bình thường
        $content = '../app/views/pages/admin/voucher/voucher.php';
        include_once "../app/views/layouts/admin.php";
    }

    // public function getVoucher() {
    //     $voucherId = $_GET['voucherId'] ?? 0;
    //     if (!$voucherId) {
    //         $this->jsonResponse(['success' => false, 'message' => 'Thiếu voucherId']);
    //         return;
    //     }
    //     $voucher = $this->voucherModel->getById($voucherId);
    //     $this->jsonResponse($voucher);
    // }
    
    public function getVouchers() {
        $vouchers = $this->voucherModel->getVouchers();
        $this->jsonResponse($vouchers);
        exit;
    }
    
    public function getVoucher($voucherId) {
        $voucher = $this->voucherModel->getById($voucherId);
        $this->jsonResponse($voucher);
        exit;
    }
    
    // public function addVoucher() {
    //     $code = $_POST['code'] ?? '';
    //     $discountType = $_POST['discount_type'] ?? '';
    //     $discountValue = $_POST['discount_value'] ?? 0;
    //     $quantity = $_POST['quantity'] ?? 0;
    //     $expired = $_POST['expired'] ?? '';
    //     $status = $_POST['status'] ?? 'inactive';

    //     // Validate dữ liệu
    //     if (empty($code) || empty($discountType) || empty($expired)) {
    //         $this->jsonResponse(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
    //         return;
    //     }

    //     if ($this->voucherModel->create($code, $discountType, $discountValue, $quantity, $expired, $status)) {
    //         $this->jsonResponse(['success' => true, 'message' => 'Thêm voucher thành công']);
    //     } else {
    //         $this->jsonResponse(['success' => false, 'message' => 'Mã voucher đã tồn tại']);
    //     }
    // }
    // public function addVoucher() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $code = $_POST['code'];
    //         $discount_type = $_POST['discount_type'];
    //         $discount_value = $_POST['discount_value'];
    //         $quantity = $_POST['quantity'];
    //         $expired = $_POST['expired'];
    //         $status = $_POST['status'] === 'active' ? 1 : 0;
    
    //         // Gọi model để thêm dữ liệu
    //         $result = $this->voucherModel->create([
    //             'code' => $code,
    //             'discount_type' => $discount_type,
    //             'discount_value' => $discount_value,
    //             'quantity' => $quantity,
    //             'expired' => $expired,
    //             'status' => $status,
    //         ]);
    
    //         if ($result) {
    //             echo json_encode(['success' => true, 'message' => 'Thêm voucher thành công']);
    //         } else {
    //             echo json_encode(['success' => false, 'message' => 'Thêm voucher thất bại']);
    //         }
    //     }
    // }
    public function addVoucher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $code = $_POST['code'];
            $discount_type = $_POST['discount_type'];
            $discount_value = $_POST['discount_value'];
            $quantity = $_POST['quantity'];
            $expired = $_POST['expired'];
            $status = $_POST['status'] === 'active' ? 1 : 0;
    
            // Gọi model để thêm dữ liệu
            $result = $this->voucherModel->create(
                $code,
                $discount_type,
                $discount_value,
                $quantity,
                $expired,
                $status
            );
    
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Thêm voucher thành công']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Thêm voucher thất bại']);
            }
        }
    }
    
    public function updateVoucher() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $voucher_id = $_POST['voucher_id'];
            $code = $_POST['code'];
            $discount_type = $_POST['discount_type'];
            $discount_value = $_POST['discount_value'];
            $quantity = $_POST['quantity'];
            $expired = $_POST['expired'];
            $status = $_POST['status'];
    
            // Gọi model để cập nhật
            $result = $this->voucherModel->update($voucher_id, [
                'code' => $code,
                'discount_type' => $discount_type,
                'discount_value' => $discount_value,
                'quantity' => $quantity,
                'expired' => $expired,
                'status' => $status,
            ]);
    
            if ($result) {
                echo json_encode(['success' => true, 'message' => 'Cập nhật voucher thành công']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Cập nhật voucher thất bại']);
            }
        }
    }
    
    // public function updateVoucher() {
    //     $voucherId = $_POST['voucher_id'] ?? 0;
    //     $code = $_POST['code'] ?? '';
    //     $discountType = $_POST['discount_type'] ?? '';
    //     $discountValue = $_POST['discount_value'] ?? 0;
    //     $quantity = $_POST['quantity'] ?? 0;
    //     $expired = $_POST['expired'] ?? '';
    //     $status = $_POST['status'] ?? 'inactive';

    //     if (empty($voucherId) || empty($code) || empty($discountType) || empty($expired)) {
    //         $this->jsonResponse(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
    //         return;
    //     }

    //     if ($this->voucherModel->update($voucherId, $code, $discountType, $discountValue, $quantity, $expired, $status)) {
    //         $this->jsonResponse(['success' => true, 'message' => 'Cập nhật voucher thành công']);
    //     } else {
    //         $this->jsonResponse(['success' => false, 'message' => 'Mã voucher đã tồn tại cho voucher khác']);
    //     }
    // }
    
    // public function deleteVoucher($voucherId) {
    //     if ($this->voucherModel->delete($voucherId)) {
    //         $this->jsonResponse(['success' => true, 'message' => 'Xóa voucher thành công']);
    //     } else {
    //         $this->jsonResponse(['success' => false, 'message' => 'Xóa voucher thất bại']);
    //     }
    // }

    public function deleteVoucher() {
        $voucherId = $_GET['voucherId'] ?? 0;
        if (!$voucherId) {
            $this->jsonResponse(['success' => false, 'message' => 'Thiếu voucherId']);
            return;
        }
    
        if ($this->voucherModel->delete($voucherId)) {
            $this->jsonResponse(['success' => true, 'message' => 'Xóa voucher thành công']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Xóa voucher thất bại']);
        }
    }
    
    
    private function isAjaxRequest() {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
    
    private function jsonResponse($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}

?>