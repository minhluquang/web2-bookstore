const btnSubstractGroup = document.querySelectorAll(".btn-substract-qty");
const btnAddGroup = document.querySelectorAll(".btn-add-qty");

btnSubstractGroup.forEach((btn) =>
  btn.addEventListener("click", function (e) {
    const input = btn.nextElementSibling;
    if (input.value > 1) {
      --input.value;
      input.setAttribute("value", input.value);
    }
  })
);
btnAddGroup.forEach((btn) =>
  btn.addEventListener("click", function (e) {
    const input = btn.previousElementSibling;
    ++input.value;
    input.setAttribute("value", input.value);
  })
);

// Hàm cập nhật trạng thái của tất cả các checkbox
function updateAllCheckbox(checked) {
  ckbAddCarts.forEach((ckb) => {
    ckb.checked = checked;
  });
}

// Xử lý sự kiện khi click vào checkbox-all-product
const ckbAllAddCart = document.querySelector("#checkbox-all-product");
ckbAllAddCart.addEventListener("change", (e) => {
  updateAllCheckbox(ckbAllAddCart.checked);
  updateTotalPrice();
});

function calculateTotalPrice() {
  let totalPrice = 0;
  const ckbAddCarts = document.querySelectorAll(".checkbox-add-cart:checked");

  ckbAddCarts.forEach((ckb) => {
    const parentEle = ckb.closest(".cart-item");
    const price = +parentEle
      .querySelector(".price-hidden")
      .getAttribute("value");
    const amount = +parentEle.querySelector(".qty-cart").getAttribute("value");
    totalPrice += price * amount;
  });

  return totalPrice;
}

// Xử lý chọn sản phẩm trong giỏ hàng
const ckbAddCarts = document.querySelectorAll(".checkbox-add-cart");

ckbAddCarts.forEach((ckb) => {
  ckb.addEventListener("change", (e) => {
    updateTotalPrice();
  });
});

// Xử lý tăng/giảm số lượng sản phẩm trong giỏ hàng
const btnAddQnts = document.querySelectorAll(".btn-add-qty");
const btnSubQnts = document.querySelectorAll(".btn-substract-qty");

function updateTotalPrice() {
  const totalPrice = calculateTotalPrice();
  document.querySelector(
    ".cart-total p"
  ).innerHTML = `Tổng cộng: ${totalPrice.toLocaleString("vi-VN", {
    style: "currency",
    currency: "VND",
  })}`;
}

btnAddQnts.forEach((btnAddQnt) => {
  btnAddQnt.addEventListener("click", (e) => {
    updateTotalPrice();
  });
});

btnSubQnts.forEach((btnSubQnt) => {
  btnSubQnt.addEventListener("click", (e) => {
    updateTotalPrice();
  });
});
