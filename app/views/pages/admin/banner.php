<div class="w-100"></div>
<div class="row">
    <div class="col-4">
        <h5 class="mb-3">Form nhập banner</h5>
        <div class="mb-3">
            <label for="url" class="form-label">Đường dẫn URL</label>
            <input type="text" class="form-control" id="url" placeholder="Nhập đường dẫn tại đây">
        </div>
        <div class="mb-3">
            <label class="form-label">Chọn phương thức nhập ảnh</label>
            <div>
                <input type="radio" id="urlOption" name="imageOption" checked>
                <label for="urlOption">Nhập URL</label>
                <input type="radio" id="fileOption" name="imageOption">
                <label for="fileOption">Tải lên tệp</label>
            </div>
        </div>

        <div class="mb-3">
            <label for="imageUrl" class="form-label">Đường dẫn URL</label>
            <input type="text" class="form-control" id="imageUrl" placeholder="Nhập URL hình ảnh">
        </div>

        <div class="mb-3">
            <label for="imageFile" class="form-label">Hình ảnh</label>
            <input class="form-control" type="file" id="imageFile" disabled>
        </div>
        <img style="width: 150px;" src="" alt="" id="previewImage">
        <div class="mb-3 text-end">
            <button type="button" id="btn" class="btn btn-primary">Thêm ngay</button>
        </div>
    </div>

    <div class="col-8">
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th scope="col">STT</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Đường dẫn</th>
                    <th scope="col">Tùy chọn</th>
                </tr>
            </thead>
            <tbody id="table-body">

            </tbody>
        </table>
    </div>
</div>
</div>

<script>
// Lấy các phần tử
const urlOption = document.getElementById("urlOption");
const fileOption = document.getElementById("fileOption");
const imageUrl = document.getElementById("imageUrl");
const imageFile = document.getElementById("imageFile");
const previewImage = document.getElementById("previewImage");

// Chọn phương thức nhập ảnh
urlOption.addEventListener("change", () => {
    imageUrl.disabled = false;
    imageFile.disabled = true;
    imageFile.value = "";
    previewImage.classList.add("d-none");
});

fileOption.addEventListener("change", () => {
    imageUrl.disabled = true;
    imageFile.disabled = false;
    imageUrl.value = "";
    previewImage.classList.add("d-none");
});

// Xem trước hình ảnh từ URL
imageUrl.addEventListener("input", () => {
    if (imageUrl.value.trim() !== "") {
        previewImage.src = imageUrl.value;
        previewImage.classList.remove("d-none");
    } else {
        previewImage.classList.add("d-none");
    }
});

// Xem trước hình ảnh từ file
imageFile.addEventListener("change", (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
    }
});

const deleteBanner = (id) => {
    const isConfirm = confirm('Bạn có chắc muốn xoá banner này?');
    if (isConfirm) {
        $.ajax({
            url: '?controller=banner&action=delete',
            method: 'POST',
            dataType: 'json',
            data: {
                banner_id: id
            },
            success: (res) => {
                showToast(res.message);
                fetchListBanners();
            },
            error: (err) => {
                showToast('Có lỗi xảy ra');
            }
        })
    }
};

const renderListBanners = (banners) => {
    const html = banners.map((banner, key) => {
        return `
            <tr class="text-center">
                <th scope="row">${key + 1}</th>
                <td>
                    <img class="mx-auto" width="160" height="80"
                        style="object-fit: contain"
                        src="${banner.img_url}"
                        alt="">
                </td>
                <td><a target="_blank" href="${banner.url}">Link</a></td>
                <td>
                    <button class="btn btn-danger" onclick="deleteBanner(${banner.banner_id})">Xóa</button>
                    <button class="btn btn-primary">Sửa</button>
                </td>
            </tr>
        `;
    })
    document.getElementById('table-body').innerHTML = html.join('');
}

const fetchListBanners = () => {
    $.ajax({
        url: '?controller=banner&action=get_all',
        method: 'GET',
        dataType: 'json',
        success: (res) => {
            renderListBanners(res.data);
        },
        error: (error) => {
            console.log(error);
        }
    })
}

$(document).ready(() => {
    fetchListBanners();
})

$('#btn').click(async (e) => {
    e.preventDefault();
    const url = $('#url').val().trim();
    const urlOption = $('#urlOption').prop('checked');
    const imageUrlVal = $('#imageUrl').val().trim();
    const fileInput = $('#imageFile')[0];
    const file = fileInput.files[0];

    // ✅ Validate đơn giản: các trường không được để trống
    if (!url) {
        showToast("Vui lòng nhập URL điều hướng");
        return;
    }

    if (urlOption) {
        if (!imageUrlVal) {
            showToast("Vui lòng nhập URL ảnh");
            return;
        }
    } else {
        if (!file) {
            showToast("Vui lòng chọn file ảnh");
            return;
        }
    }

    const bannerInfo = {
        url
    };

    if (urlOption) {
        bannerInfo.img_url = imageUrlVal;
    } else {
        const formData = new FormData();
        formData.append("file", file);
        formData.append("upload_preset", "chovybe_present");
        formData.append("cloud_name", "dtdkm7cjl");

        try {
            const cloudinaryResponse = await uploadToCloudinary(formData);
            bannerInfo.img_url = cloudinaryResponse.secure_url;
        } catch (error) {
            showToast("Upload ảnh không thành công");
            return;
        }
    }

    // ✅ Gửi banner và reset form sau khi thành công
    $.ajax({
        url: '?controller=banner&action=add',
        method: 'POST',
        dataType: 'json',
        data: bannerInfo,
        success: (res) => {
            showToast(res.message);
            fetchListBanners();

            // ✅ Reset form
            $('#url').val('');
            $('#imageUrl').val('');
            $('#imageFile').val('');
            $('#previewImage').addClass('d-none').attr('src', '');
            $('#urlOption').prop('checked', true).trigger('change');
        },
        error: () => {
            showToast('Thêm mới không thành công');
        }
    });
});
</script>