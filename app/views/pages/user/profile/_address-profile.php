<div class="wrapper-address">
    <div class="alert alert-danger" role="alert">
        Bạn vui lòng cập nhật thông tin tài khoản: <a href="#" class="alert-link">Cập nhật thông tin ngay</a>
    </div>
    <div class="form-address">
        <h2 class="mb-4">Dia Chi</h2>
        <form method="POST" id="form-address">
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label">Tỉnh/Thành phố</label>
                <div class="col-sm-10">
                    <select class="form-control" id="city" name="city">
                        <option selected><?php echo $user['city']; ?></option>
                        <option>Hà Nội</option>
                        <option>TP. Hồ Chí Minh</option>
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

    const data = {
        city: $("#city").val(),
        district: $("#district").val(),
        ward: $("#ward").val(),
        street: $("#street").val()
    };

    $.ajax({
        url: "index.php?controller=home&action=updateAddress",
        method: "POST",
        data: data,
        dataType: "json",
        success: function(response) {
            if (response.success) {
                showToast(response.message);
            } else {
                showToast(response.message);
            }
        },
        error: function(xhr, status, error) {
            showToast(error.message);
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