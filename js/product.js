const btnDetail = document.querySelectorAll(".product-action__detail");
const btnCloseModal = document.querySelector(".modal-close-icon");
const btnDecreaseQnt = document.querySelector(".modal-qnt__descrease");
const btnIncreaseQnt = document.querySelector(".modal-qnt__increase");

const overlay = document.querySelector(".modal-overlay");
const modal = document.querySelector(".modal");

btnDetail.forEach((item) => {
  item.addEventListener("click", (e) => {
    modal.classList.add("active");
    overlay.classList.add("active");
  });
});

btnCloseModal.addEventListener("click", (e) => {
  modal.classList.remove("active");
  overlay.classList.remove("active");
});

overlay.addEventListener("click", (e) => {
  modal.classList.remove("active");
  overlay.classList.remove("active");
});

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

// Start: Handle Sort When Small Devices (Select, option)
const sortFilterSelect = document.querySelector(".sort-filter__select");

sortFilterSelect.addEventListener("change", (e) => {
  const link = `sortby=${e.target.value}`;
  const host = window.location.origin;
  const pathname = window.location.pathname;
  window.location.href = `${host}${pathname}?${link}`;
});
// End: Handle Sort When Small Devices (Select, option)
