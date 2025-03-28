<link rel="stylesheet" href="/app/views/pages/user/order.css">
<div class="container">
    <div class="row py-3">
        <div class="col-8">
            <div class="d-flex justify-content-between align-items-center pb-2">
                <h5 class="text-uppercase">Đơn hàng</h5>
            </div>
            <div class="row g-3">
            <div class="col-sm-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Tên phải hợp lệ.
              </div>
            </div>

            <div class="col-sm-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
              <div class="invalid-feedback">
                Tên phải hợp lệ.
              </div>
            </div>

            <div class="col-12">
              <label for="username" class="form-label">Tên Người Dùng</label>
              <div class="input-group has-validation">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" id="username" placeholder="Username" required>
                <div class="invalid-feedback">
                    Tên người dùng của bạn là bắt buộc
                </div>
              </div>
            </div>

            <div class="col-12">
              <label for="email" class="form-label">Email </label>
              <input type="email" class="form-control" id="email" placeholder="you@example.com">
              <div class="invalid-feedback">
                Vui lòng nhập địa chỉ email hợp lệ để cập nhật thông tin vận chuyển.
              </div>
            </div>

            <div class="col-12">
              <label for="address" class="form-label">Địa chỉ</label>
              <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
              <div class="invalid-feedback">
                Vui lòng nhập địa chỉ giao hàng của bạn.
              </div>
            </div>

            <div class="col-12">
              <label for="address2" class="form-label">Địa chỉ 2</label>
              <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
            </div>

            <div class="col-md-5">
              <label for="country" class="form-label">Quốc gia</label>
              <select class="form-select" id="country" required>
                <option value="">Choose...</option>
                <option>United States</option>
              </select>
              <div class="invalid-feedback">
                Vui lòng chọn quốc gia hợp lệ.
              </div>
            </div>

            <div class="col-md-4">
              <label for="state" class="form-label">Tình trạng</label>
              <select class="form-select" id="state" required>
                <option value="">Choose...</option>
                <option>California</option>
              </select>
              <div class="invalid-feedback">
                Vui lòng cung cấp trạng thái hợp lệ.
              </div>
            </div>

            <div class="col-md-3">
              <label for="zip" class="form-label">Mã Zip</label>
              <input type="text" class="form-control" id="zip" placeholder="" required>
              <div class="invalid-feedback">
                Cần có mã bưu chính.
              </div>
            </div>
          </div>
        </div>
        <div class="col-4">
        <h5 class="text-uppercase text-center">tóm tắt đơn hàng</h5>
            <div class="mt-4">
                <ul>
                    <li class=" list-group-item d-flex justify-content-between mb-2 bg-light">
                        <span>2 sản phẩm</span>
                        <span>2.480.000 đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between mb-2 bg-light">
                        <span>Giá gốc</span>
                        <span>3.480.000 đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light mb-2">
                        <div class="text-success">
                        <h6 class="my-0">Giảm giá</h6>
                        <small>voucher</small>
                        </div>
                        <span class="text-success">−1.000.000 đ</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light mb-2">
                    <div class="row py-3 h-100 align-items-stretch">
                        <div class="col-3 d-flex justify-content-between align-items-center ">
                            
                            <img width="120" height="120" style="object-fit: cover;"
                                src="https://image.msscdn.net/thumbnails/images/goods_img/20240820/4350233/4350233_17246475812360_big.png"
                                alt="">
                        </div>
                        <div class="col-9 d-flex flex-column justify-content-between ps-4" style="height: 120px; ">
                            <div class="d-flex justify-content-between flex-grow-1">
                                <div>
                                    <h6 class="mb-1">Áo thun GenG 2023.</h6>
                                    <div class="d-flex gap-2 mb-1">
                                        <small>Màu: Đen</small>
                                        <small>Size: XL</small>
                                        <small>Số Lương: 1</small>
                                    </div>
                                    <h6 class="mb-1" style="font-size: 14px;">2.099.000 vnđ</h6>
                                    <h6 class="text-decoration-line-through text-black-50" style="font-size: 14px;">
                                        2.099.000 vnđ
                                    </h6>
                                </div>
                                
                                </span>
                            </div>

                            
                        </div>
                    </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between mb-2 bg-light">
                        <span>Giao hàng</span>
                        <span>Miễn phí</span>
                    </li>
                    <hr>
                    <li class="list-group-item d-flex justify-content-between mt-2 bg-light">
                        <strong>Tổng</strong>
                        <strong>2.650.000 đ</strong>
                    </li>
                </ul>
                <button class="btn btn-primary mt-3 w-100">Thanh toán ngay</button>
                <div class="mt-3">
                    <strong>CÁC PHƯƠNG THỨC THANH TOÁN</strong>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>

                
            </div>
        </div>
    </div>
    <div class="py-3">
    
                   
            
</div>