<div class="container mt-5">
    <h2>Quản Lý Bình Luận</h2>
    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Người Dùng</th>
                <th>Nội Dung</th>
                <th>Trạng Thái</th>
                <th>Thời Gian</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody id="comment-table"></tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    function loadComments() {
        $.ajax({
            url: "?controller=comment&ajax=true",
            method: "GET",
            dataType: "json",
            success: function(data) {
                let content = "";
                $.each(data, function(index, comment) {
                    let statusText = comment.status === "active" ? "Hiện" : "Ẩn";
                    let toggleStatus = comment.status === "active" ? "hidden" : "active";

                    content += `
                        <tr>
                            <td>${comment.comment_id}</td>
                            <td>${comment.username}</td>
                            <td>${comment.content}</td>
                            <td>${statusText}</td>
                            <td>${new Date(comment.created_at).toLocaleString()}</td>
                            <td>
                                <button class="btn btn-warning toggle-status" data-id="${comment.comment_id}" data-status="${toggleStatus}">${statusText}</button>
                                <button class="btn btn-danger delete-comment" data-id="${comment.comment_id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                });
                $("#comment-table").html(content);
            }
        });
    }

    loadComments();

    // Xóa bình luận
    $(document).on('click', '.delete-comment', function() {
        let commentId = $(this).data('id');

        $.post("?controller=comment&action=delete_comment", { comment_id: commentId }, function() {
            loadComments();
        });
    });
});
</script>
