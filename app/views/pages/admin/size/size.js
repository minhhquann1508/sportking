$(document).ready(function () {
    function loadSizes() {
        $.ajax({
            url: "?controller=size&action=get_all_sizes", // Gọi API lấy danh sách size
            type: "GET",
            dataType: "json", // Định dạng JSON
            success: function (response) {
                if (response.success) {
                    console.log("Dữ liệu từ API:", response.data);
                    let content = "";
                    $.each(response.data, function (key, size) {
                        content += `
                            <tr class="text-center">
                                <th scope="row">${key + 1}</th>
                                <td>${size.size_id}</td>
                                <td>${size.size_name}</td>
                                <td>${size.category_name}</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-primary update-size"
                                       data-id="${size.size_id}" data-name="${size.size_name}">
                                       Sửa
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-danger delete-size" 
                                       data-id="${size.size_id}">Xóa</a>
                                </td>
                            </tr>
                        `;
                    });
                    $("#size-table").html(content);
                } else {
                    console.error("Lỗi API:", response.message);
                    $("#size-table").html("<tr><td colspan='5' class='text-center text-danger'>Không có dữ liệu</td></tr>");
                }
            },
            error: function (xhr, status, error) {
                console.error("Lỗi khi tải dữ liệu size!", xhr.responseText);
                $("#size-table").html("<tr><td colspan='5' class='text-center text-danger'>Lỗi tải dữ liệu</td></tr>");
            }
        });
    }

    loadSizes();
});



$(document).ready(function() {
    $("#add_size").submit(function() {
        let size_name = $("#size_name").val();
        let category_name = $("#category_name").val();

        $.ajax({
            url: "controller=size&action=addSize",
            type: 'POST',
            


        })
    })
})

