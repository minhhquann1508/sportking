<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-end mb-3">
        <h5>Thông tin bài viết</h5>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-blog-modal">
            Thêm bài viết
        </button>
    </div>
    <div class="mb-3">
        <form method="post" id="search-box" class="row">
            <div class="col-11 d-flex gap-2">
                <div class="flex-grow-1">
                    <label for="fullname">Họ tên</label>
                    <input type="text" class="form-control" id="fullname-search" name="fullname"
                        placeholder="Nhập họ tên">
                </div>
                <div class="flex-grow-1">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email-search" name="email" placeholder="Nhập email">
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone-search" name="phone"
                        placeholder="Nhập số điện thoại">
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Ngày tạo</label>
                    <input type="date" class="form-control" name="created_at" id="created_at">
                </div>
                <div class="flex-grow-1">
                    <label for="phone">Lần cuối chỉnh sửa</label>
                    <input type="date" class="form-control" name="phone" id="updated_at">
                </div>
            </div>
            <div class="col ps-0 text-end d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100"><span class="fw-bold">Tìm</span> <i
                        class="fa-solid fa-magnifying-glass" style="font-size: 12px;"></i></button>
            </div>
    </div>
    <table class="table table-bordered border-dark">
        <thead>
            <tr>
                <th scope="col" class="fw-bold">STT</th>
                <th scope="col" class="fw-bold">Tiêu đề</th>
                <th scope="col" class="fw-bold">Nội dung</th>
                <th scope="col" class="fw-bold">Hình ảnh</th>
                <th scope="col" class="fw-bold">Lượt xem</th>
                <th scope="col" class="fw-bold">Ngày tạo</th>
                <th scope="col" class="fw-bold">Tác giả</th>
                <th scope="col" class="fw-bold text-center">Tuỳ chọn</th>
            </tr>
        </thead>
        <tbody id="table-body"></tbody>
    </table>
    <div id="pagination" class="d-flex justify-content-center align-items-center"></div>
</div>

<!-- thêm -->
<div class="modal fade" id="add-blog-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Thêm quản bài viết</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="exampleInputTitle" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="title" aria-describedby="titleHelp"
                            placeholder="Nhập tiêu đề bài viết">
                    </div>
                    <div class="mb-3 p-0">
                        <label class="form-label">Nội dung</label>
                        <textarea id="editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputThumbnail" class="form-label">Hình ảnh</label>
                        <input type="file" class="form-control" id="thumbnail" aria-describedby="thumbnailHelp">
                    </div>
                    <div class="mb-3 text-end">
                        <button type="submit" id="add-btn" class="btn btn-primary">Thêm ngay</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal cập nhật -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Chỉnh sửa bài viết</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="update_blog_id">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control" id="update_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea id="update_editor"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Hình ảnh</label>
                        <input class="form-control" type="file" id="updated_thumbnail">
                        <div class="mt-1" style="width: 150px; display: none;">
                            <img class="w-100" height="150" style="object-fit: cover;" id="preview_thumbnail" src="" alt="">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="updated_is_public">
                        <label class="form-check-label" for="flexSwitchCheckChecked">Xem trước hình ảnh</label>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="button" id="update_btn" class="btn btn-primary">Chỉnh sửa</button>
                </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        function formatDate(dateStr) {
        const date = new Date(dateStr);
        return date.toLocaleDateString("vi-VN");
            }
        function loadBlogs(){
            $.ajax({
                url: "?controller=blog&ajax=true",
                type: "GET",
                dataType: "json",
                success: function (response){
                    if (response.success){
                        let content = "";
                        $.each(response.data, function(key, blog) {
                        content += `
                        <tr>
                            <td>${key+1}</td>
                            <td>${blog.title}</td>
                            <td>${blog.content}</td>
                            <td><img src="${blog.thumbnail}" width="100"></td>
                            <td>${blog.views}</td>
                            <td>${formatDate(blog.created_at)}</td>
                            <td>${blog.fullname}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary update-blog" 
                                    data-id="${blog.blog_id}" data-bs-toggle="modal" data-bs-target="#updateModal">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </button>
                                <a href="javascript:void(0)" class="btn btn-danger delete-blog" 
                                    data-id="${blog.blog_id}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>

                        </tr>`;
                    });
                    $("#table-body").html(content);
                    renderPagination(page, response.total);
                }
            }
        })
    }
    loadBlogs();
    $('#add-btn').click(function(e) {
        e.preventDefault();
        const title = $('#title');
        const content = $('#editor');
        const thumbnail = $('#thumbnail');
        const file = thumbnail[0].files[0] || null;
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "chovybe_present");
            formData.append("cloud_name", "dtdkm7cjl");
            
            $.ajax({
                url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: (res) => {
                    const blog = {
                        title: title.val(),
                        content: content.val(),
                        author_id: 1,
                        thumbnail: res.secure_url
                    }
                    console.log(blog);
                    $.ajax({

                        url: '?controller=blog&action=add_blog_action',
                        method: "POST",
                        data: blog,
                        dataType: "json",
                        success: (response) => {
                            title.val('');
                            content.val(''),
                            thumbnail.val('');
                            $('#add-blog-modal').modal('hide');
                            loadBlogs();
                            showToast(response.message)
                        },
                        error: (error) => {
                            showToast(error.responseText)
                    }
                })
            },
                error: (error) => {
                    console.log(error.responseText);
                }
            })
    })

    // xoá
    $(document).on('click', '.delete-blog', function(){
        let blog_id = $(this).data('id');
        $.get("?controller=blog&action=delete_blog", {blog_id: blog_id}, function(response){
            alert("Xoá thành công");
            loadBlogs();
        });
    });

    // set update-blog
    $(document).on('click', '.update-blog', function () {
    const blogId = $(this).data('id');
    $.ajax({
        url: '?controller=blog&action=get_blog_by_id',
        method: 'GET',
        data: { id: blogId },
        dataType: 'json',
        success: (res) => {
            if (res.success) {
                const blog = res.data;
                $('#update_blog_id').val(blog.blog_id);
                $('#update_title').val(blog.title);
                $('#update_editor').val(blog.content);
                $('#preview_thumbnail').attr('src', blog.thumbnail).parent().show();
                $('#updated_is_public').prop('checked', blog.is_public == 1);
            } else {
                alert("Không lấy được dữ liệu bài viết");
            }
        }
    });
});

    // img preview
    $('#updated_thumbnail').on('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#preview_thumbnail').attr('src', e.target.result).parent().show();
        }
        reader.readAsDataURL(file);
    }
});

const updateBlogBtn = $('#update_btn');
const updateBlogId = $('#update_blog_id');
const updateTitle = $('#update_title');
const updateContent = $('#update_editor');
const updatedThumbnail = $('#preview_thumbnail');
const updateThumbnailInput = $('#updated_thumbnail');
const updateIsPublic = $('#updated_is_public');


    //cập nhật bài viết
    updateBlogBtn.click(async () => {
        const file = updateThumbnailInput[0].files[0];
        const content = updateContent.val();
        const blog = {
        blog_id: updateBlogId.val(),
        title: updateTitle.val(),
        content: content,
        is_public: updateIsPublic.is(':checked') ? 1 : 0,
        };

        if (file) {
            const formData = new FormData();
            formData.append("file", file);
            formData.append("upload_preset", "chovybe_present");
            formData.append("cloud_name", "dtdkm7cjl");
            try {
                const cloudinaryResponse = await $.ajax({
                    url: 'https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false
                });
                blog.thumbnail = cloudinaryResponse.secure_url;
            } catch (err) {
                showToast("Upload ảnh thất bại!");
                return;
            }
        } else {
            blog.thumbnail = updatedThumbnail.attr('src') || null;
        }
        console.log("Blog cần cập nhật:", blog);
        $.ajax({
        url: '?controller=blog&action=update_blog_by_id',
        method: 'POST',
        data: blog,
        dataType: 'json',
        success: (response) => {
            $('#updateModal').modal('hide');
            loadBlogs();
            showToast(response.message);
        },
        error: (err) => {
            showToast(err.responseText);
        }
        });
            });
        });
</script>