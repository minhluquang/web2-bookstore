const btnDetails = document.querySelectorAll(".actions--view");
const modal = document.querySelector(".order-modal");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelector(".close-modal");

const openModal = function () {
  modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
};

const closeModal = function () {
  modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

btnDetails.forEach((btn) => btn.addEventListener("click", openModal));
overlay.addEventListener("click", closeModal);
btnCloseModal.addEventListener("click", closeModal);

// delete

const del_modal = document.querySelector('.delete-modal');

const btnDelete = document.querySelectorAll(".actions--delete");
const btnDeleteCancel = document.querySelector(".del-cancel");

const openDeleteModal = function () {
  del_modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
  document.querySelector(".delete-id").innerHTML=this.parentNode.parentNode.querySelector(".order_id").innerHTML;
  document.querySelector(".del-confirm").type = "submit";
  del_modal.querySelector('.hidden_input').value =this.parentNode.parentNode.querySelector(".order_id").innerHTML;
};

const closeDeleteModal = function () {
  del_modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

btnDelete.forEach((btn) => btn.addEventListener("click", openDeleteModal));
overlay.addEventListener("click", closeDeleteModal);
btnCloseModal.addEventListener("click", closeDeleteModal);
btnDeleteCancel.addEventListener("click", closeDeleteModal);

