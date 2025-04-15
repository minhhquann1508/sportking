<link rel="stylesheet" href="/app/views/pages/user/order.css">
<main style="padding-top: 76px;">
    <div class="container">
        <div class="row py-3">
            <div class="col-7">
                <div class="d-flex justify-content-between align-items-center pb-2">
                    <h5 class="text-uppercase">Đơn hàng</h5>
                </div>
                <div class="row g-3">
                    <div class="col-6">
                        <label for="firstName" class="form-label">Họ và tên</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" required>
                        <div class="invalid-feedback">
                            Tên phải hợp lệ.
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="email" class="form-label">Email</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">@</span>
                            <input type="text" class="form-control" id="username" required>
                            <div class="invalid-feedback">
                                Tên người dùng của bạn là bắt buộc
                            </div>
                        </div>
                    </div>

                    <div class="col-12 ">
                        <label for="phone" class="form-label ">Số điện thoại </label>
                        <input type="phone" class="form-control" id="phone">
                        <div class="invalid-feedback">
                            Vui lòng nhập địa chỉ email hợp lệ để cập nhật thông tin vận chuyển.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="checkside" class="me-2">Địa chỉ từng đặt</label>
                        <input type="radio" class="me-2" id="chooseSavedAddress">
                        <label for="checkin" class="me-2">Nhập địa chỉ </label>
                        <input type="radio" id="enterNewAddress">
                    </div>

                    <div class="col-12">
                        <!-- <div class="btn-group col-12" id="savedAddressSection">
                            <button type="button" class="$gray-700 form-control" id="saveAddressBtn"> Chọn địa chỉ</button>
                            <button type="button" class="$gray-500 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="visually-hidden">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" id="savedAdressList">
                                <li><a class="dropdown-item" class="form-label" href="#">Địa chỉ từng đặt hàng</a></li>
                                <li><a class="dropdown-item" href="#">12d, Tân kỳ tân quý, Bình Tân , TP Hồ Chí Minh</a></li>
                                <li><a class="dropdown-item" href="#">55c, Quang Trung, Gò Vấp , TP Hồ Chí Minh</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                            
                        </div> -->
                        <div class="form-group" id="savedAddressSection">
                            <label class="form-label">Chọn địa chỉ đã từng đặt:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="savedAddress" value="12d, Tân kỳ tân quý, Bình Tân , TP Hồ Chí Minh">
                                <label class="form-check-label">12d, Tân kỳ tân quý, Bình Tân , TP Hồ Chí Minh</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="savedAddress" value="55c, Quang Trung, Gò Vấp , TP Hồ Chí Minh">
                                <label class="form-check-label">55c, Quang Trung, Gò Vấp , TP Hồ Chí Minh</label>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex mt-3 " id="newAddressSection">
                        <label for="addressInput" class="form-label">Địa chỉ 2</label>
                        <input type="text" class="form-control" id="addressInput" disabled>


                        <div class="col-6">
                            <label for="firstName" class="form-label">Thành Phố</label>
                            <input type="text" readonly class="form-control" value="Hồ Chí Minh">
                        </div>
                        <div class="col-6">
                            <label for="username" class="form-label">Phường:</label>
                            <div class="input-group has-validation">

                                <input type="text" class="form-control" id="username" required>

                            </div>
                        </div>
                        <div class="col-6">
                            <label for="firstName" class="form-label">Quận:</label>
                            <input type="text" class="form-control" id="username">
                        </div>
                        <div class="col-6">
                            <label for="username" class="form-label">Đường:</label>
                            <div class="input-group has-validation">

                                <input type="text" class="form-control" id="username" required>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-5">
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
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="useVoucher">
                                <label class="form-check-label text-success" for="useVoucher">Sử dụng voucher giảm 1.000.000đ</label>
                            </div>
                            <span id="voucherAmount" class="text-success">−1.000.000 đ</span>
                        </li>
                        <!-- <li class="list-group-item d-flex justify-content-between bg-light mb-2">
                            <div class="form-check">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                                </select>
                            </div>
                        </li> -->
                        <li class="list-group-item d-flex justify-content-between bg-light mb-2">
                            <div class="row py-3 h-100 align-items-stretch">
                                <div class="col-3 d-flex justify-content-between align-items-center ">

                                    <img width="120" height="120" style="object-fit: cover;"
                                        src="https://image.msscdn.net/thumbnails/images/goods_img/20240820/4350233/4350233_17246475812360_big.png"
                                        alt="">
                                </div>
                                <div class="col-9 d-flex flex-column justify-content-between ps-4"
                                    style="height: 120px; ">
                                    <div class="d-flex justify-content-between flex-grow-1">
                                        <div>
                                            <h6 class="mb-1">Áo thun GenG 2023.</h6>
                                            <div class="d-flex gap-2 mb-1">
                                                <small>Màu: Đen</small>
                                                <small>Size: XL</small>
                                                <small>Số Lương: 1</small>
                                            </div>
                                            <h6 class="mb-1" style="font-size: 14px;">2.099.000 vnđ</h6>
                                            <h6 class="text-decoration-line-through text-black-50"
                                                style="font-size: 14px;">
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
                            <strong id="totalAmount">2.480.000 đ</strong>
                        </li>

                    </ul>
                    <div class="mt-3">
                        <strong>CÁC PHƯƠNG THỨC THANH TOÁN</strong>
                        <div>
                            <label for="#">Thanh toán khi nhận được hàng</label>
                            <input type="radio">
                            <label for="#">Thanh toán bằng QR</label>
                            <input type="radio">
                        </div>
                    </div>

                    <button class="btn btn-primary mt-3 w-100" id="order-submit">Thanh toán ngay</button>



                </div>
            </div>
        </div>
        <div class="py-3">
        </div>
    </div>
</main>
<script>
    // $.ajax({
    //     url: "?controller=order", // File PHP xử lý
    //     type: "POST",
    //     data: orderData,
    //     dataType: "json",
    //     success: function(response) {
    //         if (response.status === "success") {
    //             alert(" Đặt hàng thành công!");
    //             console.log(" Phản hồi từ server:", response);
    //         } else {
    //             alert("Lỗi đặt hàng: " + response.message);
    //         }
    //     },
    //     error: function(xhr, status, error) {
    //         alert(" Lỗi kết nối đến server! Hãy thử lại.");
    //         console.error(" AJAX Error:", status, error);
    //     },
    // });
    $(document).ready(function() {
        console.log("Trang đã tải xong - JS hoạt động!");

        // Ẩn phần nhập địa chỉ ban đầu
        $("#savedAddressSection").hide();
        $("#newAddressSection").hide();

        // Xử lý chọn địa chỉ
        $("#chooseSavedAddress").on("change", function() {
            if ($(this).is(":checked")) {
                $("#enterNewAddress").prop("checked", false);
                // $("#addressInput").prop("disabled", true).val(""); // Ẩn input nhập địa chỉ
                $("#savedAddressSection").show();
                $("#newAddressSection").hide();
            }
        });

        $("#enterNewAddress").on("change", function() {
            if ($(this).is(":checked")) {
                $("#chooseSavedAddress").prop("checked", false);
                // $("#addressInput").prop("disabled", false);
                $("#savedAddressSection").hide();
                $("#newAddressSection").show();
            }
        });

        // Chặn nhập ký tự không phải số trong ô điện thoại
        $("#phone").on("keypress", function(e) {
            let charCode = e.which ? e.which : e.keyCode;
            if (charCode < 48 || charCode > 57) {
                e.preventDefault();
            }
        });

        // Hàm kiểm tra input hợp lệ
        function validateInput(selector, pattern, errorMsg) {
            let value = $(selector).val().trim();
            if (!pattern.test(value)) {
                $(selector).addClass("is-invalid");
                alert(errorMsg);
                return false;
            }
            $(selector).removeClass("is-invalid");
            return true;
        }

        let selectedSaveAddress = "";


        //khi click vào địa chỉ từng đặt
        $("#savedAddressList.dropdown-item").on("click", function(e) {
            e.preventDefault();
            selectedSavedAddress = $(this).text().trim();
            $("#savedAddressBtn").text(selectedSavedAddress);
        });

        // xử lý tính tổng

        $(document).ready(function() {
            function parseCurrency(str) {
                return parseInt(str.replace(/[^\d]/g, '')); // Bỏ ký tự không phải số
            }

            function formatCurrency(number) {
                return number.toLocaleString('vi-VN') + " đ";
            }

            const originalTotal = parseCurrency($("#totalAmount").text()); // Lấy số tiền gốc

            $("#useVoucher").on("change", function() {
                let finalTotal = originalTotal;
                if ($(this).is(":checked")) {
                    finalTotal -= 1000000;
                }
                $("#totalAmount").text(formatCurrency(finalTotal));
            });
        });


        // lấy dữ liệu sản phẩm đăth hàng
        let productName = $(".col-9 h6.mb-1").first().text().trim();
        let productPrice = $(".col-9 h6.mb-1").last().text().trim();
        let productQty = $(".col-9 small:contains('Số Lương')").text().replace("Số Lương: ", "").trim();

        let productData = {
            name: productName,
            price: productPrice,
            quantity: productQty
        };

        console.log("Thông tin sản phẩm:", productData);




        // Khi bấm nút Thanh Toán
        $("#order-submit").on("click", function(e) {
            e.preventDefault();
            console.log("Nút thanh toán được bấm!");

            let isValid = true;

            isValid &= validateInput("#firstName", /^[a-zA-ZÀ-Ỹà-ỹ\s]+$/, "Tên không hợp lệ!");
            isValid &= validateInput("#username", /^[^\s@]+@[^\s@]+\.[^\s@]+$/, "Email không hợp lệ!");
            isValid &= validateInput("#phone", /^[0-9]{10}$/, "Số điện thoại không hợp lệ!");

            // if ($("#enterNewAddress").is(":checked")) {
            //     isValid &= validateInput("#addressInput", /.+/, "Địa chỉ không được để trống!");
            // }
            if (isValid) {
                // Lấy dữ liệu địa chỉ
                let address = "";
                if ($("#enterNewAddress").is(":checked")) {
                    let phuong = $("#newAddressSection input").eq(1).val().trim();
                    let quan = $("#newAddressSection input").eq(2).val().trim();
                    let duong = $("#newAddressSection input").eq(3).val().trim();
                    address = `${duong}, ${phuong}, ${quan}, Hồ Chí Minh`;
                } else {
                    address = "Địa chỉ đã từng đặt";
                }

                let orderData = {
                    fullName: $("#firstName").val(),
                    email: $("#username").val(),
                    phone: $("#phone").val(),
                    address: $("#enterNewAddress").is(":checked") ?
                        `${$("#newAddressSection input").eq(3).val().trim()}, ${$("#newAddressSection input").eq(1).val().trim()}, ${$("#newAddressSection input").eq(2).val().trim()}, Hồ Chí Minh` : selectedSavedAddress || "Chưa chọn địa chỉ",

                };

                console.log("📤 Dữ liệu đơn hàng:", orderData);
                alert("✅ Đơn hàng hợp lệ, dữ liệu đã được thu thập!");

                // Nếu muốn gửi lên server
                // $.post("order.php", orderData, function(response) {
                //     alert("Đặt hàng thành công!");
                // });

            }


        });
    });
</script>