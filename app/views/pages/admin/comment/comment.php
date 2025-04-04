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
        <?php
            $content = '';
            foreach ($comments['data'] as $key => $comment) {
                $content .= '
                <tr>
                    <td>'.$comment['content'].'</td>
                    <td>'.$comment['fullname'].'</td>
                    <td>'.$comment['comment_id'].'</td>
                    <td>'.date('H:i d/m/Y', strtotime($comment['created_at'])).'</td>
                </tr>';
            }
            echo ($content);
        ?>
    </table>
</div>

<script>
    function loadComments() {
        $.ajax({
            url: "?controller=comment&ajax=true",
            method: "GET",
            dataType: "json",
            success: function(data) {
                console.log(data);
                let content = "";
                $.each(data, function(index, comment) {
                   

                    content += `
                        <tr>
                            <td>${comments.comment_id}</td>
                            <td>${comments.fullname}</td>
                            <td>${comments.content}</td>
                           
                            <td>${new Date(comments.created_at).toLocaleString()}</td>
                        </tr>
                    `;
                });
                $("#comment-table").html(content);
            }
        });
    }
$(document).ready(function() {
    // loadComments();

    // Xóa bình luận
    $(document).on('click', '.delete-comment', function() {
        let commentId = $(this).data('id');

        $.post("?controller=comment&action=delete_comment", { comment_id: commentId }, function() {
            loadComments();
        });
    });
});
</script>
