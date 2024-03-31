// Load the jquery
var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);

function checkReady() {
  return new Promise(async function(resolve) {
    while (!window.jQuery) {
        await new Promise(resolve => setTimeout(resolve, 20));
    }
    resolve();
  })
}
async function loadForFirstTime(){
  await checkReady();
    loadItem(1);
}
const urlParams = new URLSearchParams(window.location.search);
function loadItem (current_page) {
    $.ajax({
    url: '../controller/admin/pagnation.controller.php',
    type: "post",
    dataType: 'html',
    data: {
      number_of_item: 5,
      current_page: current_page,
      function: "render"
    }
  }).done(function (result) {
    $('.result').html(result);
    js();
  })
};

document.addEventListener("DOMContentLoaded", () => { 
  loadForFirstTime()
});
var js = function () {

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