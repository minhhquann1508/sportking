function showToast(message, status = "success") {
  var toast = $("#toast");
  var toastMess = $("#toast-mesage");
  toast.show();
  toastMess.text(message);
  setTimeout(() => {
    toast.hide();
  }, 1500);
}

function renderPagination(currentPage = 1, totalItems = 10, itemsPerPage = 10) {
  const paginationDiv = document.getElementById("pagination");
  paginationDiv.innerHTML = "";

  const totalPages = Math.ceil(totalItems / itemsPerPage);
  const ul = document.createElement("ul");
  ul.classList.add("pagination");

  const prevPage = Math.max(1, currentPage - 1);
  const prevUrl = new URL(window.location.href);
  prevUrl.searchParams.set("page", prevPage);
  const prevDisabled = currentPage === 1 ? "disabled" : "";

  let content = `<li class="page-item ${prevDisabled}">
                    <a class="page-link" href="${prevUrl.href}">Trước</a>
                  </li>`;
  for (let index = 1; index <= totalPages; index++) {
    const isActive = currentPage === index ? "active" : "";
    const url = new URL(window.location.href);
    url.searchParams.set("page", index);

    content += `<li class="page-item ${isActive}">
                    <a class="page-link" href="${url.href}">${index}</a>
                </li>`;
  }

  const nextPage = Math.min(totalPages, currentPage + 1);
  const nextUrl = new URL(window.location.href);
  nextUrl.searchParams.set("page", nextPage);
  const nextDisabled = currentPage === totalPages ? "disabled" : "";

  content += `
      <li class="page-item ${nextDisabled}">
          <a class="page-link" href="${nextUrl.href}">Sau</a>
      </li>`;

  ul.innerHTML = content;
  paginationDiv.appendChild(ul);
}

//
let lastScrollY = window.scrollY;
const header = document.querySelector("header");

window.addEventListener("scroll", () => {
  if (window.scrollY > 50) {
    header.classList.add("header-scroll");
  } else {
    header.classList.remove("header-scroll");
  }

  if (window.scrollY > lastScrollY) {
    header.classList.add("header-hidden");
  } else {
    header.classList.remove("header-hidden");
  }
  lastScrollY = window.scrollY;
});

const updateCartQuantitySpan = () => {
  $.ajax({
    url: "?controller=cart&action=get_cart",
    method: "GET",
    dataType: "json",
    success: (res) => {
      let totalQuantity = 0;
      Object.values(res).forEach((item) => {
        item.forEach((i) => {
          totalQuantity += Number(i.quantity);
        });
      });
      $("#cart-quantity").text(totalQuantity);
    },
    error: (err) => {
      console.log(err);
    },
  });
};

function uploadToCloudinary(formData) {
  return new Promise((resolve, reject) => {
    $.ajax({
      url: "https://api.cloudinary.com/v1_1/dtdkm7cjl/image/upload",
      method: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: (res) => resolve(res),
      error: (err) => reject(err),
    });
  });
}

$(document).ready(() => {
  updateCartQuantitySpan();
});
