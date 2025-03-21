$(document).ready(function(){
    function loadSizes(){
        $.ajax({
            url: "?controller=size",
            type: "GET",
            data: "json",
            success: function(data){
                let content ="";
                $.each(data, function(size){
                    content += `
                            <tr class="text-center">
                                <td>${size.size_id}</td>
                                <td>${size.size_name}</td>
                                <td>${category.category_name}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger delete-size" data-id="${size.size_id}">Xóa</a>
                                    <a href="javascript:void(0);" class="btn btn-primary update-size"
                                        data-id="${size.size_id}" data-name="${size.size_name}">
                                        Sửa
                                    </a>
                                </td>
                            </tr>
                    `;
                });
                $("#size-table").html(content);
            }
        });
    }
})

loadSizes();

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

