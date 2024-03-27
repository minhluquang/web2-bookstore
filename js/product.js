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

// // Start: Handle Sort When Small Devices (Select, option)
// const sortFilterSelect = document.querySelector(".sort-filter__select");

// sortFilterSelect.addEventListener("change", (e) => {
//   const link = `sortby=${e.target.value}`;
//   const host = window.location.origin;
//   const pathname = window.location.pathname;
//   window.location.href = `${host}${pathname}?${link}`;
// });
// // End: Handle Sort When Small Devices (Select, option)
