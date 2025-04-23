<?php
$cities = ['Hà Nội', 'TP. Hồ Chí Minh', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng', 'Huế', 'Nha Trang', 'Vũng Tàu'];

$address = [
    'city' => $user['city'],
    'district' => $user['district'],
    'ward' => $user['ward'],
    'street' => $user['street'],
];
$missing = array_filter($address, function($value) {
    return empty($value);
});
?>
<div class="wrapper-address">
    <?php if (!empty($missing)) {?>
    <div class="alert alert-danger" role="alert">
        Bạn vui lòng cập nhật thông tin tài khoản: <a href="#" class="alert-link">Cập nhật thông tin ngay</a>
    </div>
    <?php } ?>
    <div class="form-address">
        <h3 class="mb-4">Địa Chỉ</h3>
        <form method="POST" id="form-address">
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Tỉnh/Thành phố</label>
                <div class="col-sm-10">
                    <select class="form-control" id="city" name="city">
                        <option value="">-- Chọn tỉnh/thành --</option>
                        <?php foreach ($cities as $city): ?>
                        <option value="<?= $city ?>" <?= ($user['city'] == $city) ? 'selected' : '' ?>>
                            <?= $city ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="district" class="col-sm-2 col-form-label">Quận/Huyện</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="district" name="district"
                        value="<?php echo $user['district']; ?>" placeholder="Quận/Huyện">
                </div>
            </div>
            <div class="form-group row">
                <label for="ward" class="col-sm-2 col-form-label">Xã/Phường</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ward" value="<?php echo $user['ward']; ?>" name="ward"
                        placeholder="Xã/Phường">
                </div>
            </div>
            <div class="form-group row">
                <label for="street" class="col-sm-2 col-form-label">Địa chỉ</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="street" name="street"
                        value="<?php echo $user['street']; ?>" placeholder="Địa chỉ">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Lưu địa chỉ</button>
                </div>
            </div>
        </form>
        <div class="text-start mt-3">
            <a href="#" class="btn btn-link text-decoration-none">« Quay lại</a>
        </div>
    </div>
</div>

<script>
$("#form-address").submit(function(e) {
    e.preventDefault();
    let btn = $(this).find('button[type="submit"]');
    btn.prop("disabled", true).text("Đang lưu...");

    let city = $("#city").val().trim();
    let district = $("#district").val().trim();
    let ward = $("#ward").val().trim();
    let street = $("#street").val().trim();

    $.ajax({
        url: "index.php?controller=home&action=updateAddress",
        method: "POST",
        data: {
            city,
            district,
            ward,
            street
        },
        dataType: "json",
        success: function(response) {
            console.log(response);
            showToast(response.message);
            btn.prop("disabled", false).text("Lưu địa chỉ");
        },
        error: function(xhr, status, error) {
            console.log(response);
            showToast("Có lỗi xảy ra, vui lòng thử lại.");
            btn.prop("disabled", false).text("Lưu địa chỉ");
        }
    });
});
</script>

<style>
.wrapper-address {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-address {
    padding: 20px;
    border-radius: 10px;
    background-color: #fff;
}

.form-address h3 {
    font-size: 1.5rem;
    margin-bottom: 20px;
    color: #333;
}

.form-address .form-group {
    margin-bottom: 15px;
}

.profile-statiscal .form-control {
    border-radius: 5px;
    padding: 25px;
}

.form-address .form-check-label {
    margin-right: 15px;
}

.form-address .form-check-input {
    margin-right: 5px;
    padding: 10px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}
</style>