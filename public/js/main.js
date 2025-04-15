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

function showLoading() {
  const loading = document.getElementById("loading");
  loading.style.display = "flex";

  loading.innerHTML = `
      <div>
          <img src="./img/loading.gif" alt="Loading">
          <div id="loading-text">Loading</div>
      </div>
      <div id="progress-bar">
          <div id="progress-bar-fill"></div>
      </div>
  `;

  const loadingText = loading.querySelector("#loading-text");
  const fill = loading.querySelector("#progress-bar-fill");

  let dot = 0;
  let progress = 0;

  const dotInterval = setInterval(() => {
    dot = (dot + 1) % 4;
    loadingText.textContent = "Loading" + ".".repeat(dot);
  }, 500);

  const progressInterval = setInterval(() => {
    progress += Math.random() * 10;
    fill.style.width = Math.min(progress, 100) + "%";

    if (progress >= 100) {
      clearInterval(progressInterval);
      clearInterval(dotInterval);
      loading.style.display = "none";
    }
  }, 300);
}
