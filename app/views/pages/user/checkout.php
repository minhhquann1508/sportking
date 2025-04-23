 <?php 
    $orderItems = $_SESSION['orderItems'] ?? [];
    $user = $_SESSION['user'] ?? [];
    $address = $_SESSION['address'] ?? []; 
    $total_price = 0;
?>
 <div class="container" style="padding: 76px;">
     <div class="text-center mb-4">
         <h1 class="display-5 fw-bold">Thanh Toán</h1>
     </div>

     <div class="row gx-5">
         <!-- Thông tin người nhận -->
         <div class="col-md-6" id="user-info"></div>

         <!-- Danh sách sản phẩm -->
         <div class="col-md-6" id="order-items"></div>
     </div>
 </div>


 <script>
function renderOrderPage(data) {
    // Lấy phần tử chứa thông tin người nhận
    const user = data.order[0];
    const userInfoContainer = document.getElementById('user-info');
    userInfoContainer.innerHTML = `
        <h5 class="mb-3 text-uppercase">Thông tin nhận hàng</h5>
        <div class="p-3 bg-light rounded">
            <p class="mb-1 fw-bold">Họ tên: ${user.fullname ?? 'Chưa có'}</p>
            <p class="mb-1">SĐT: ${user.phone ?? 'Chưa có'}</p>
            <p class="mb-1">Email: ${user.email ?? 'Chưa có'}</p>
            <hr>
            <p class="fw-bold mb-1">Địa chỉ nhận hàng:</p>
            <ul class="mb-0 ps-3">
                <li>${user.street}, Quận ${user.district}, ${user.city}</li>
            </ul>
        </div>

        <div class="mt-4">
            <h5 class="text-uppercase">Phương thức thanh toán</h5>
            <p>Thanh toán khi nhận hàng (COD)</p>
        </div>
    `;

    // Lấy phần tử chứa danh sách sản phẩm
    const orderItemsContainer = document.getElementById('order-items');
    let orderItemsHTML = `
        <div class="card">
            <div class="card-header fw-bold">Đơn hàng của bạn</div>
            <div class="card-body">
                <ul class="list-group mb-3" id="order-cart">
    `;

    // Lặp qua các sản phẩm trong đơn hàng
    data.items.forEach(item => {
        const productTotal = item.price * item.quantity;
        orderItemsHTML += `
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="d-flex gap-3">
                    <img src="${item.thumbnail}" alt="Product Image" width="60" height="60" style="object-fit: contain; border-radius: 6px;">
                    <div>
                        <h6 class="mb-1">Sản phẩm #${item.order_item}</h6>
                        <small class="text-muted">Số lượng: ${item.quantity}</small><br>
                        <small class="text-muted">Size: ${item.size_name ?? 'Chưa có'}</small><br>
                        <small class="text-muted">Màu: ${item.color_name ?? 'Chưa có'}</small>
                    </div>
                </div>
                <small class="text-muted">${productTotal.toLocaleString('vi-VN')}đ</small>
            </li>
        `;
    });

    orderItemsHTML += `
                </ul>
            </div>
        </div>
        <div class="card mt-3">
            <div class="card-body">
                <h5 class="text-uppercase text-center mb-3">Tóm tắt đơn hàng</h5>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Tổng tiền hàng</span>
                        <strong>${Number(data.order[0].total_amount).toLocaleString('vi-VN')}đ</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Phí vận chuyển</span>
                        <strong>0đ</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between text-danger fw-bold">
                        <span>Tổng thanh toán</span>
                        <strong>${Number(data.order[0].total_amount).toLocaleString('vi-VN')}đ</strong>
                    </li>
                </ul>
            </div>
        </div>
    `;

    orderItemsContainer.innerHTML = orderItemsHTML;
}
$(document).ready(() => {
    const urlParams = new URLSearchParams(window.location.search);
    const orderId = urlParams.get('id');
    $.ajax({
        url: '?controller=order&action=get_detail_order',
        method: 'GET',
        dataType: 'json',
        data: {
            order_id: orderId
        },
        success: (res) => {
            renderOrderPage(res.data);
        },
        error: (err) => {
            showToast('Có lỗi xảy ra');
        }
    })
})
 </script>