$(document).ready(function () {
  // Hàm để render dữ liệu sản phẩm
  function renderProductsPerPage(current_page) {
    var items_per_page = 8;

    $.ajax({
      url: "controller/product.controller.php",
      type: "post",
      dataType: "html",
      data: {
        itemsPerPage: items_per_page,
        currentPage: current_page,
      },
    }).done(function (result) {
      // Xử lý render sản phẩm
      const data = JSON.parse(result);

      // =========== Start: Xử lý render dữ liệu products ===========
      let productHTML = '<div class="collection-product-list">';
      data.products.forEach((product) => {
        const formatPrice = parseInt(product.price).toLocaleString("vi-VN", {
          style: "currency",
          currency: "VND",
        });
        productHTML += `
          <div class="product-item--wrapper">
            <div class="product-item">
              <div class="product-img">
                <div class="product-action">
                  <div class="product-action--wrapper">
                    <a href="index.php?page=product_detail&pid=${product.id}" class="product-action--btn product-action__detail">Chi tiết</a>
                    <form>
                      <input type="hidden" name="product_id" value="${product.id}">
                      <input
                          type="submit"
                          class="product-action--btn product-action__addToCart"
                          value="Thêm vào giỏ"
                        />
                    </form>
                  </div>
                </div>
                <div class="img-resize">
                  <img
                  src="${product.image_path}"
                  alt="${product.name}" />
                </div>
              </div>
              <a href="index.php?page=product_detail&pid=${product.id}" >
                <div class="product-detail">
                    <p class="product-title">'${product.name}'</p>
                    <p class="product-price">${formatPrice}</p>
                </div>
              </a>
            </div>
          </div>`;
      });
      productHTML += "</div>";
      // =========== End: Xử lý render dữ liệu products ===========

      // =========== Start: Xử lý render btns ===========
      // Render buttons
      const amountProduct = data.amountProduct;
      const totalPage = Math.ceil(amountProduct / items_per_page);
      paginationHTML = '<div class="pagination">';

      // Render prev btn
      if (data.page > 1) {
        const prev = data.page - 1;
        paginationHTML += `
          <button class="pagination-btn" data="${prev}">
            <i class="fa-solid fa-angle-left"></i>
          </button>`;
      }

      if (data.page - 3 >= 1) {
        paginationHTML += '<button class="pagination-btn" data="1">1</button>';
        paginationHTML += "...";
      }

      // Render btns
      for (let i = 1; i < totalPage; i++) {
        const isActive = data.page === i ? "active" : "";
        if (i < data.page + 3 && i > data.page - 3) {
          paginationHTML += `<button class="pagination-btn ${isActive}" data="${i}">${i}</button>`;
        }
      }

      if (data.page + 3 <= totalPage) {
        paginationHTML += "...";
        paginationHTML += `<button class="pagination-btn" data="${totalPage}">${totalPage}</button>`;
      }

      // Render next btn
      if (data.page < totalPage) {
        const next = data.page + 1;
        paginationHTML += `
          <button class="pagination-btn" data="${next}">
            <i class="fa-solid fa-angle-right"></i>
          </button>`;
      }

      paginationHTML += "</div>";
      // =========== End: Xử lý render btns ===========

      let html = `${productHTML}${paginationHTML}`;

      $(".result").html(html);
    });
  }

  // Tự load sản phẩm ở lần đầu vào trang
  renderProductsPerPage(1);

  // Sử dụng Event Delegation cho các nút phân trang
  $(document).on("click", ".pagination-btn", function () {
    // Xoá tất cả trạng thái active, và chỉ hiển thị active của nút vừa bấm
    $(".pagination-btn").removeClass("active");
    $(this).addClass("active");

    var current_page = $(this).attr("data");
    renderProductsPerPage(current_page);
  });
});
