$(document).ready(function () {
  function loadCategories() {
    $.ajax({
      url: "?controller=category&ajax=true",
      method: "GET",
      dataType: "json",
      success: function (data) {
        let content = "";
        $.each(data, function (key, category) {
          content += `
                        <tr class="text-center">
                            <th scope="row">${key + 1}</th>
                            <td>${category.category_name}</td>
                            <td>${category.created_at}</td>
                            <td>${category.updated_at}</td>
                            <td>
                                <a href="javascript:void(0)" class="btn btn-danger delete-category" data-id="${
                                  category.category_id
                                }">Xóa</a>
                                <a href="javascript:void(0);" class="btn btn-primary update-category"
                                    data-id="${
                                      category.category_id
                                    }" data-name="${category.category_name}">
                                    Sửa
                                </a>
                            </td>
                        </tr>
                    `;
        });
        $("#category-table").html(content);
      },
    });
  }

  loadCategories();
  $("#category-form").submit(function (e) {
    e.preventDefault();
    let categoryName = $("#category_name").val();

    if (categoryName === "") {
      alert("Vui lòng nhập tên danh mục");
      return;
    }

    $.ajax({
      url: "?controller=category&action=addCategory",
      method: "POST",
      data: {
        category_name: categoryName,
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        if (response.status === "success") {
          $("#category_name").val("");
          loadCategories();
        } else {
          alert("Thêm danh mục thất bại");
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
    });
  });
  $(document).on("click", ".delete-category", function () {
    let category_id = $(this).data("id");
    if (confirm("Bạn có chắc chắn muốn xóa không?")) {
      $.ajax({
        url: "?controller=category&action=deleteCategory",
        method: "GET",
        data: {
          category_id: category_id,
        },
        dataType: "json",
        success: function (response) {
          alert(response.message);
          if (response.status === "success") {
            loadCategories();
          }
        },
      });
    }
  });
  $("#update-category-form").submit(function (e) {
    e.preventDefault();
    let category_id = $("#update_category_id").val();
    let category_name = $("#update_category_name").val();

    $.ajax({
      url: "?controller=category&action=updateCategory",
      method: "POST",
      data: {
        category_id: category_id,
        category_name: category_name,
      },
      dataType: "json",
      success: function (response) {
        alert("Cập nhật thành công");
        if (response.status === "success") {
          $("#updateCategoryModal").modal("hide");
          loadCategories();
        }
      },
    });
  });
});
