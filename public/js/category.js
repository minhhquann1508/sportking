$(document).ready(function() {
    function loadCategories(filterName = "", filterCreated = "", filterUpdated = "") {
        $.ajax({
            url: "?controller=category&ajax=true",
            method: "GET",
            dataType: "json",
            success: function(data) {
                let content = "";
                $.each(data, function(key, category) {
                    let categoryCreatedDate = category.created_at ? formatDate(category.created_at.split(" ")[0]) : "";
                    let categoryUpdatedDate = category.updated_at ? formatDate(category.updated_at.split(" ")[0]) : "";


                    let normalizeText = (text) => text.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
                    let nameMatch = filterName === "" || normalizeText(category.category_name).includes(normalizeText(filterName));

                    let formattedFilterCreated = formatDate(filterCreated);
                    let formattedFilterUpdated = formatDate(filterUpdated);
                    let createdMatch = filterCreated === "" || categoryCreatedDate === formattedFilterCreated;
                    let updatedMatch = filterUpdated === "" || categoryUpdatedDate === formattedFilterUpdated;

                    if (nameMatch && createdMatch && updatedMatch) {
                        content += `
                            <tr class="text-center">
                                <th scope="row">${key + 1}</th>
                                <td>${category.category_name}</td>
                                <td>${categoryCreatedDate}</td>
                                <td>${categoryUpdatedDate}</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-outline-info update-category"
                                        data-id="${category.category_id}" data-name="${category.category_name}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-outline-danger delete-category" data-id="${category.category_id}"><i class="fa-solid fa-trash-can"></i></a>
                                </td>
                            </tr>
                        `;
                    }
                });
                $("#category-table").html(content);
            }
        });
    }

    $(".form-control").on("input change", function() {
        currentPage = 1;
        let filterName = $("#filter_category_name").val();
        let filterCreated = $("#filter_created_date").val();
        let filterUpdated = $("#filter_updated_date").val();
        loadCategories(filterName, filterCreated, filterUpdated, currentPage);
    });
    function formatDate(dateString) {
        if (!dateString) return "";
        let parts = dateString.split("-"); 
        return `${parts[2]}-${parts[1]}-${parts[0]}`; 
    }
    
    loadCategories();
    $("#category-form").submit(function (e) {
        e.preventDefault();
        let categoryName = $("#category_name").val().trim();
    
        if (categoryName === "") {
          alert("Vui lòng nhập tên danh mục");
          return;
        }
    
        $.ajax({
          url: "?controller=category&action=addCategory",
          method: "POST",
          data: { category_name: categoryName },
          dataType: "json",
          success: function(response) {
            if (response.success) {
              $("#category_name").val("");
              showToast(response.message);
              setTimeout(() => {
                loadCategories();
              }, 1000);
            } else {
              showToast(response.message);
            }
          },
          error: function(response) {
            showToast(response.responseText);
          }
        });
      });
    
      $(document).on("click", ".delete-category", function () {
        let category_id = $(this).data("id");
        if (confirm("Bạn có chắc chắn muốn xóa không?")) {
          $.ajax({
            url: "?controller=category&action=deleteCategory",
            method: "GET",
            data: { category_id: category_id },
            dataType: "json",
            success: function (response) {
              if (response.success) {
                showToast(response.message);
                loadCategories();
              }
            },
          });
        }
      });
    
      $("#update-category-form").submit(function (e) {
        e.preventDefault();
        let category_id = $("#update_category_id").val();
        let category_name = $("#update_category_name").val().trim();
    
        $.ajax({
          url: "?controller=category&action=updateCategory",
          method: "POST",
          data: { category_id: category_id, category_name: category_name },
          dataType: "json",
          success: function (response) {
            if (response.success) {
              $("#updateCategoryModal").modal("hide");
              showToast(response.message);
              loadCategories();
            } else {
              showToast(response.message);
            }
          },
        });
      });
});
