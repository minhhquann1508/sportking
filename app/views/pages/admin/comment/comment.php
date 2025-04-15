<div class="container mt-5">
    <h2>Quản Lý Bình Luận</h2>

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người Dùng</th>
                <th>Nội Dung</th>
                <th>Đánh giá</th>
                <th>Trạng Thái</th>
                <th>Thời Gian</th>
                <th>Hành Động</th>
            </tr>
        </thead>s
        <tbody id="comment-table">
            <!-- Dữ liệu sẽ được load bằng Ajax -->
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    // Load comments khi trang được tải
    loadComments();

    // Hàm load comments bằng Ajax
    function loadComments() {
        $.ajax({
            url: "?controller=comment&action=get_comments",
            method: "GET",
            dataType: "json",
            success: function(response) {
                if(response.success) {
                    renderComments(response.data);
                } else {
                    $("#comment-table").html(
                        `<tr>
                            <td colspan="7" class="text-center">${response.message}</td>
                        </tr>`
                    );
                }
            },
            error: function() {
                $("#comment-table").html(
                    `<tr>
                        <td colspan="7" class="text-center">Lỗi khi tải dữ liệu</td>
                    </tr>`
                );
            }
        });
    }

    // Hàm render comments
    function renderComments(comments) {
        let content = "";
        
        if(comments.length > 0) {
            $.each(comments, function(index, comment) {
                content += `
                    <tr>
                        <td>${comment.comment_id}</td>
                        <td>${comment.user_id}</td>
                        <td>${comment.content || ''}</td>
                        <td>${comment.rating || ''}</td>
                        <td>${comment.status === 'active' ? 'Hiện' : 'Ẩn'}</td>
                        <td>${comment.create_at}</td>
                        <td>
                            <button class="btn btn-warning toggle-status" 
                                data-id="${comment.comment_id}"
                                data-status="${comment.status === 'active' ? 'hidden' : 'active'}">
                                ${comment.status === 'active' ? 'Ẩn' : 'Hiện'}
                            </button>
                            <button class="btn btn-danger delete-comment" 
                                data-id="${comment.comment_id}">
                                Xóa
                            </button>
                        </td>
                    </tr>
                `;
            });
        } else {
            content = `
                <tr>
                    <td colspan="7" class="text-center">Không có bình luận nào</td>
                </tr>
            `;
        }
        
        $("#comment-table").html(content);
    }

    // Xóa bình luận
    $(document).on('click', '.delete-comment', function() {
        let commentId = $(this).data('id');
        
        if(confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
            $.post("?controller=comment&action=delete_comment", {
                comment_id: commentId
            }, function(response) {
                if(response.success) {
                    alert(response.message);
                    loadComments();
                } else {
                    alert('Xóa thất bại: ' + response.message);
                }
            }, 'json');
        }
    });

    // Thay đổi trạng thái
    $(document).on('click', '.toggle-status', function() {
        let commentId = $(this).data('id');
        let newStatus = $(this).data('status');
        
        $.post("?controller=comment&action=toggle_status", {
            comment_id: commentId,
            new_status: newStatus
        }, function(response) {
            if(response.success) {
                loadComments();
            } else {
                alert('Thay đổi trạng thái thất bại');
            }
        }, 'json');
    });
});
</script>