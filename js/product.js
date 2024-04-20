const itemsPerPage = 8;
const modelPath = "../model";
let categoryId = null;
let priceRange = null;

// Hàm để render HTML của mỗi sản phẩm
function renderProductHTML(data) {
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
                <a href="index.php?page=product_detail&pid=${
                  product.id
                }" class="product-action--btn product-action__detail">Chi tiết</a>
                <input type="hidden" class="productId" value="${product.id}"/>
                <button class="product-action--btn product-action__addToCart">Thêm vào giỏ</button>
              </div>
            </div>
            <div class="img-resize">
              <img
                src="${product.image_path}"
                alt="${product.name}" />
            </div>
          </div>
          <a href="index.php?page=product_detail&pid=${
            product.id || product.product_id
          }" >
            <div class="product-detail">
                <p class="product-title">${
                  product.name || product.product_name
                }</p>
                <p class="product-price">${formatPrice}</p>
            </div>
          </a>
        </div>
      </div>`;
  });
  productHTML += "</div>";
  return productHTML;
}

// Hàm để render HTML của phân trang
function renderPaginationHTML(data, itemsPerPage) {
  let paginationHTML = '<div class="pagination">';
  const totalPage = Math.ceil(data.amountProduct / itemsPerPage);

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

  for (let i = 1; i <= totalPage; i++) {
    const isActive = data.page === i ? "active" : "";
    if (i < data.page + 3 && i > data.page - 3) {
      paginationHTML += `<button class="pagination-btn ${isActive}" data="${i}">${i}</button>`;
    }
  }

  if (data.page + 3 <= totalPage) {
    paginationHTML += "...";
    paginationHTML += `<button class="pagination-btn" data="${totalPage}">${totalPage}</button>`;
  }

  if (data.page < totalPage) {
    const next = data.page + 1;
    paginationHTML += `
      <button class="pagination-btn" data="${next}">
        <i class="fa-solid fa-angle-right"></i>
      </button>`;
  }

  paginationHTML += "</div>";
  return paginationHTML;
}

// Hàm để render dữ liệu sản phẩm và phân trang (AJAX)
function renderProductsPerPage(
  currentPage,
  categoryId = null,
  priceRange = null
) {
  $.ajax({
    url: "controller/product.controller.php",
    type: "post",
    dataType: "html",
    data: {
      categoryId,
      priceRange,
      itemsPerPage,
      currentPage,
      modelPath,
    },
  }).done(function (result) {
    try {
      const data = JSON.parse(result);

      const productHTML = renderProductHTML(data);
      const paginationHTML = renderPaginationHTML(data, itemsPerPage);
      let html = `${productHTML}${paginationHTML}`;
      $(".result").html(html);
    } catch (error) {
      $(".result").html("Không tìm thấy sản phẩm");
    }
  });
}

$(document).ready(function () {
  // Tự load sản phẩm ở lần đầu vào trang
  renderProductsPerPage(1);

  // Sử dụng Event Delegation cho các nút phân trang
  $(document).on("click", ".pagination-btn", function () {
    $(".pagination-btn").removeClass("active");
    $(this).addClass("active");

    var current_page = $(this).attr("data");
    renderProductsPerPage(current_page, categoryId, priceRange);
  });

  // Lọc nâng cao theo thể loại
  $('input[name="theloai"]').click(function () {
    categoryId = $(this).attr("data");
    // Tự load sản phẩm ở lần đầu vào trang
    renderProductsPerPage(1, categoryId, priceRange);
  });

  // Lọc nâng cao theo giá tiền
  $('input[name="giaban"]').click(function () {
    priceRange = $(this).attr("data");
    // Tự load sản phẩm ở lần đầu vào trang
    renderProductsPerPage(1, categoryId, priceRange);
  });

  // Xử lý add to Cart
  $(document).on("click", ".product-action__addToCart", function (e) {
    e.preventDefault();
    const productId = $(this)
      .closest(".product-item")
      .find(".productId")[0]
      .getAttribute("value");
    addToCart(productId, 1);
  });
});

// Function xử lý addToCart
function addToCart(productId, amount) {
  $.ajax({
    type: "post",
    url: "controller/cart.controller.php",
    dataType: "html",
    data: {
      "product-action__addToCart": true,
      productId: productId,
      amount: amount,
    },
  }).done(function (result) {
    $(".cart-qnt").removeClass("hide");
    $(".cart-qnt").text(result);
    alert("Đã thêm sản phẩm thành công!");
  });
}
