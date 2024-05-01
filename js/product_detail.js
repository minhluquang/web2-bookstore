// ========== Start: Xử lý nút tăng/giảm khi bấm ==========
const btnDecreaseQnt = document.querySelector(".modal-qnt__descrease");
const btnIncreaseQnt = document.querySelector(".modal-qnt__increase");

btnDecreaseQnt.addEventListener("click", (e) => {
  const modalQntValue = document.querySelector(".modal-qnt__value");
  if (+modalQntValue.value > 1) {
    const qnt = +modalQntValue.value;
    modalQntValue.value = qnt - 1;
    modalQntValue.setAttribute("value", qnt - 1);
  }
});

btnIncreaseQnt.addEventListener("click", (e) => {
  const modalQntValue = document.querySelector(".modal-qnt__value");
  const modalQntValueMax = document.querySelector(".modal-qnt__value-max");
  if (+modalQntValueMax.value > +modalQntValue.value) {
    const qnt = +modalQntValue.value;
    modalQntValue.value = qnt + 1;
    modalQntValue.setAttribute("value", qnt + 1);
  }
});
// ========== End: Xử lý nút tăng/giảm khi bấm ==========

// Xử lý thêm vào giỏ bằng ajax
$(document).ready(function () {
  $(".modal-btn").click(function (e) {
    // Ngăn chặn thêm sp vào giỏ hàng khi kho hết
    if ($(".modal-btn.notAllowed")[0]) {
      return;
    }

    e.preventDefault();

    const currentURL = window.location.href;
    const searchParams = new URLSearchParams(currentURL);
    const productId = searchParams.get("pid");
    const amount = $(this)
      .closest(".modal-content__model-right")
      .find(".modal-qnt .modal-qnt-select input[type=text]")[0]
      .getAttribute("value");

    addToCart(productId, amount);
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
    var data = JSON.parse(result);
    $(".cart-qnt").removeClass("hide");
    $(".cart-qnt").text(data.quantity);
    alert(data.message);
  });
}
