document.addEventListener("DOMContentLoaded", () => {
  $.ajax({
    url: '../controller/admin/order.controller.php',
    type: "post",
    dataType: 'html',
    data: {}
  }).done(function (result) {
    $('.table-content').html(result);
    js();
  })
});
var js = function(){
  
const btnDetails = document.querySelectorAll(".actions--view");
const modal = document.querySelector(".order-modal");
const overlay = document.querySelector(".overlay");
const btnCloseModal = document.querySelectorAll(".close-modal");

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
btnCloseModal[1].addEventListener("click", closeModal);


var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.7.1.min.js'; // Check https://jquery.com/ for the current version
document.getElementsByTagName('head')[0].appendChild(script);

// delete
document.querySelector('.del-confirm').addEventListener('click', function (e) {
  e.preventDefault();
  var $id = $('#order-delete-id').html();
  selected_content_id = '#order_id' + $id;
  selected_content = document.querySelector(selected_content_id).parentNode;
  $.ajax({
    url: '../controller/admin/order.controller.php',
    type: "post",
    dataType: 'html',
    data: {
      delete_id: $id
    }
  }).done(function (result) {
    selected_content.remove();
    closeDeleteModal();
  })
})

const del_modal = document.querySelector('.delete-modal');

const btnDelete = document.querySelectorAll(".actions--delete");
const btnDeleteCancel = document.querySelector(".del-cancel");

const openDeleteModal = function () {
  del_modal.classList.remove("hidden");
  overlay.classList.remove("hidden");
  $('#order-delete-id').html(this.parentNode.parentNode.querySelector(".order_id").innerHTML);
};

const closeDeleteModal = function () {
  del_modal.classList.add("hidden");
  overlay.classList.add("hidden");
};

btnDelete.forEach((btn) => btn.addEventListener("click", openDeleteModal));
overlay.addEventListener("click", closeDeleteModal);
btnCloseModal[0].addEventListener("click", closeDeleteModal);
btnDeleteCancel.addEventListener("click", closeDeleteModal);

}