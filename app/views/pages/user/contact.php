    <style>
        .contact-section { 
            padding: 50px 0;
            margin-top: 50px;
         }
        .contact-info { 
            padding: 30px; 
         }
        .contact-form { 
            background: #fff; 
            padding: 30px; 
            border-radius: 5px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
         }
        .social-icons a { 
            color: #333;
            margin-right: 10px;
            font-size: 20px;
         }
        .btn-submit { 
            border: none; 
            color: #000; 
            padding: 12px 20px;
         }
        .map-container { 
            height: 500px;
            margin: 40px auto; 
            border-radius: 10px; 
            overflow: hidden;
         }
        .footer { 
            background: #ffcc00; 
            padding: 20px; 
            text-align: center;
         }
    </style>
<body>
<!-- banner -->
 <section class="banner-section container">
         <div>
            <img src="" alt="">
         </div>
 </section>
<!-- contact section -->
<section class="contact-section container">
    <div class="row">
        <div class="col-md-5">
            <div class="contact-info">
                <h4>SPORTKING</h4>
                <p>Liên hệ qua địa chỉ hoặc trực tiếp bằng số điện thoại dưới đây</p>
                <p><strong>Địa chỉ:</strong> QTSC 9 Building, Đ. Tô Ký, Tân Chánh Hiệp, Quận 12, Hồ Chí Minh</p>
                <p><strong>Điện thoại:</strong> 0862356775</p>
                <p><strong>Email:</strong> hello@sportking.com</p>
                <p><strong>Giờ mở cửa:</strong> Thứ 2 - Thứ 7 (8:00 - 17:30)</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>

<!-- form -->
        <div class="col-md-7">
            <div class="contact-form">
                <h4>THÔNG TIN LIÊN HỆ</h4>
                <p>Để liên hệ và nhận các thông tin khuyến mãi mới nhất, chúng tôi sẽ liên lạc với bạn trong thời gian sớm nhất.</p>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label>Họ và Tên*</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email*</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Số điện thoại*</label>
                        <input type="tel" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Nội dung*</label>
                        <textarea name="message" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn w-100 btn-dark">GỬI LIÊN HỆ</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- MAP -->
<section class="container">
    <div class="map-container">
    <h4 class="mb-3">Bản đồ cửa hàng</h4>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.8523584714453!2d105.81232807502906!3d21.001392687854863!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abd5b8c4c111%3A0xf997fedf8ed828d8!2zMjY2IMSQLiDEkOG7mWkgQ-G6p24sIFRyxrDhu51uZyBMacOqbmcgQ2jDrSBNaW5oLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1711617905109!5m2!1sen!2s" 
            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>

<!-- FOOTER -->
<div class="footer py-4">
    <h4>ĐĂNG KÝ NHẬN KHUYẾN MÃI</h4>
    <form class="d-flex justify-content-center ">
        <input type="email" class="form-control w-50 me-2" placeholder="Nhập email của bạn">
        <button class="btn btn-dark">ĐĂNG KÝ</button>
    </form>
</div>

</body>
</html>
