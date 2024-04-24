$(document).ready(function () {
  $("#searchInput").on("input", function () {
    const keyword = $(this).val();

    $.ajax({
      type: "post",
      url: "controller/product.controller.php",
      dataType: "html",
      data: {
        isSearch: true,
        keyword,
        modelPath: "../model",
      },
    }).done(function (result) {
      const data = JSON.parse(result);
      document.querySelector(".notification-title").classList.remove("hide");

      if (data.success) {
        renderHTMLSearchResult(data);
      } else {
        const books = document.querySelector(".book-section .books");
        books.innerHTML = `
          <div class="no-search-result">
            <p>${data.message}</p>
          </div>
        `;
      }

      // Nếu keyword == '' thì hide cái notification
      if (keyword == "") {
        document.querySelector(".notification").style.display = "none";
      } else {
        document.querySelector(".notification").style.display = "flex";
      }
    });
  });
});

function renderHTMLSearchResult(data) {
  const books = document.querySelector(".book-section .books");
  books.innerHTML = "";

  data.products.forEach((product) => {
    const html = `
      <div class="book">
        <a href="index.php?page=product_detail&pid=${product.id}">${product.name}</a>
      </div> 
    `;

    books.insertAdjacentHTML("afterbegin", html);
  });
}
