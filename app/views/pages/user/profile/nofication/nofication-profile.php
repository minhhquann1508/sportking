<div class="container ctn-noti mt-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link active" id="all-tab" data-bs-toggle="pill" href="#all">Tất Cả</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="orders-tab" data-bs-toggle="pill" href="#orders">Đơn Hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="events-tab" data-bs-toggle="pill" href="#events">Sự Kiện</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="discounts-tab" data-bs-toggle="pill" href="#discounts">Mã Giảm Giá</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="confirmations-tab" data-bs-toggle="pill" href="#confirmations">Xác Nhận</a>
        </li>
    </ul>
    <div class="line"></div>

    <div class="tab-content mt-3">
        <div class="tab-pane fade show active" id="all">
            <div class="content-box">
                <h4>Thông Báo Chung</h4>
                <p>Chào mừng bạn đến với trang thông báo. Hãy kiểm tra các mục bên dưới để biết thêm thông tin.</p>
            </div>
        </div>
        <div class="tab-pane fade" id="orders">
            <?php include '_nofi-order.php'?>
        </div>
        <div class="tab-pane fade" id="events">
            <?php include '_nofi-event.php'?>
        </div>
        <div class="tab-pane fade" id="discounts">
            <div class="content-box">
                <h4>Mã Giảm Giá</h4>
                <ul>
                    <li>Mã "SALE50" - Giảm 50% cho đơn hàng trên 500k.</li>
                    <li>Mã "FREESHIP" - Miễn phí vận chuyển cho mọi đơn hàng.</li>
                </ul>
            </div>
        </div>
        <div class="tab-pane fade" id="confirmations">
            <div class="content-box">
                <h4>Xác Nhận</h4>
                <p>Chưa có xác nhận mới nào. Hãy kiểm tra lại sau.</p>
            </div>
        </div>
    </div>
</div>



<style>
.ctn-noti {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.nav-pills .nav-link {
    border-radius: 20px;
    color: #555;
    margin-right: 10px;
}

.nav-pills .nav-link.active {
    background-color: #ff6a00;
    color: #fff;
}

.line {
    width: 100%;
    height: 3px;
    background: #ff6a00;
    margin: 15px 0;
}

.content-box {
    background: #f9f9f9;
    border: 1px solid #eee;
    border-radius: 8px;
    padding: 15px 20px;
    margin-top: 10px;
    text-align: left;
}

.content-box h4 {
    color: #ff6a00;
    margin-bottom: 10px;
}

.content-box p,
.content-box ul {
    color: #333;
    font-size: 16px;
}

.content-box ul li {
    margin-bottom: 5px;
}
</style>