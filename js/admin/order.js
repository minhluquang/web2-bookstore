const btnDetails = document.querySelectorAll(".actions--view");
const modal = document.querySelector(".order-modal");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelector(".close-modal");
console.log(btnDetails);

const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};
const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};
btnDetails.forEach(btn => btn.addEventListener("click", openModal));
overlay.addEventListener("click", closeModal);
btnCloseModal.addEventListener("click", closeModal);
