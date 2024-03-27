// ========== Start: Xử lý nút tăng/giảm khi bấm ==========
const btnDecreaseQnt = document.querySelector(".modal-qnt__descrease");
const btnIncreaseQnt = document.querySelector(".modal-qnt__increase");

btnDecreaseQnt.addEventListener("click", (e) => {
  const modalQntValue = document.querySelector(".modal-qnt__value");
  if (modalQntValue.value > 1) {
    const qnt = +modalQntValue.value;
    modalQntValue.value = qnt - 1;
    modalQntValue.setAttribute("value", qnt - 1);
  }
});

btnIncreaseQnt.addEventListener("click", (e) => {
  const modalQntValue = document.querySelector(".modal-qnt__value");
  const qnt = +modalQntValue.value;
  modalQntValue.value = qnt + 1;
  modalQntValue.setAttribute("value", qnt + 1);
});
// ========== End: Xử lý nút tăng/giảm khi bấm ==========
