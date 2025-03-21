$(document).ready(function() {
    function loadCategories(filterName = "", filterCreated = "", filterUpdated = "") {
        $.ajax({
            url: "?controller=category&ajax=true",
            method: "GET",
            dataType: "json",
            success: function(data) {
                let content = "";
                $.each(data, function(key, category) {
                    let nameMatch = filterName === "" || category.category_name.toLowerCase().includes(filterName.toLowerCase());
                    let createdMatch = filterCreated === "" || category.created_at === filterCreated;
                    let updatedMatch = filterUpdated === "" || category.updated_at === filterUpdated;

                    if (nameMatch && createdMatch && updatedMatch) {
                        content += `
                            <tr class="text-center">
                                <th scope="row">${key + 1}</th>
                                <td>${category.category_name}</td>
                                <td>${category.created_at}</td>
                                <td>${category.updated_at}</td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-danger delete-category" data-id="${category.category_id}">Xóa</a>
                                    <a href="javascript:void(0);" class="btn btn-primary update-category"
                                        data-id="${category.category_id}" data-name="${category.category_name}">
                                        Sửa
                                    </a>
                                </td>
                            </tr>
                        `;
                    }
                });
                $("#category-table").html(content);
            }
        });
    }
    $(".form-control").on("input", function() {
        let filterName = $("#filter_category_name").val();
        let filterCreated = $("#filter_created_date").val();
        let filterUpdated = $("#filter_updated_date").val();
        loadCategories(filterName, filterCreated, filterUpdated);
    });

    loadCategories();
});
