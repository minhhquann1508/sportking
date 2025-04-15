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
        }
        
        // Render view bình thường
        $content = '../app/views/pages/admin/voucher/voucher.php';
        include_once "../app/views/layouts/admin.php";
    }

    public function getVouchers() {
        $vouchers = $this->voucherModel->getVouchers();
        $this->jsonResponse($vouchers);
    }
    
    public function getVoucher($voucherId) {
        $voucher = $this->voucherModel->getById($voucherId);
        $this->jsonResponse($voucher);
    }
    
    public function addVoucher() {
        $code = $_POST['code'] ?? '';
        $discountType = $_POST['discount_type'] ?? '';
        $discountValue = $_POST['discount_value'] ?? 0;
        $quantity = $_POST['quantity'] ?? 0;
        $expired = $_POST['expired'] ?? '';
        $status = $_POST['status'] ?? 'inactive';

        // Validate dữ liệu
        if (empty($code) || empty($discountType) || empty($expired)) {
            $this->jsonResponse(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
            return;
        }

        if ($this->voucherModel->create($code, $discountType, $discountValue, $quantity, $expired, $status)) {
            $this->jsonResponse(['success' => true, 'message' => 'Thêm voucher thành công']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Mã voucher đã tồn tại']);
        }
    }
    
    public function updateVoucher() {
        $voucherId = $_POST['voucher_id'] ?? 0;
        $code = $_POST['code'] ?? '';
        $discountType = $_POST['discount_type'] ?? '';
        $discountValue = $_POST['discount_value'] ?? 0;
        $quantity = $_POST['quantity'] ?? 0;
        $expired = $_POST['expired'] ?? '';
        $status = $_POST['status'] ?? 'inactive';

        if (empty($voucherId) || empty($code) || empty($discountType) || empty($expired)) {
            $this->jsonResponse(['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin']);
            return;
        }

        if ($this->voucherModel->update($voucherId, $code, $discountType, $discountValue, $quantity, $expired, $status)) {
            $this->jsonResponse(['success' => true, 'message' => 'Cập nhật voucher thành công']);
        } else {
            $this->jsonResponse(['success' => false, 'message' => 'Mã voucher đã tồn tại cho voucher khác']);
        }
    }
    
    public function deleteVoucher($voucherId) {
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