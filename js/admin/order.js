// Load the jquery
var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);
var search = location.search.substring(1);
urlParams = JSON.parse('{"' + search.replace(/&/g, '","').replace(/=/g, '":"') + '"}', function (key, value) { return key === "" ? value : decodeURIComponent(value) })
var number_of_item = urlParams['item'];
var current_page = urlParams['pag'];
if (current_page == null) {
    current_page = 1;
}
if (number_of_item == null) {
    number_of_item = 5;
}
function checkReady() {
    return new Promise(async function (resolve) {
        while (!window.jQuery) {
            await new Promise(resolve => setTimeout(resolve, 20));
        }
        resolve();
    })
}
async function loadForFirstTime() {
    await checkReady();
    loadItem();
}
function pagnationBtn() {
    // pagnation
    document.querySelectorAll('.pag').forEach((btn) => btn.addEventListener('click', function () {
        current_page=btn.innerHTML;
        loadItem();
    }));
    if (document.getElementsByClassName('pag-pre').length > 0)
        document.querySelector('.pag-pre').addEventListener('click', function () {
            current_page = Number(document.querySelector('span.active').innerHTML) - 1;
            loadItem(number_of_item, current_page);
        });
    if (document.getElementsByClassName('pag-con').length > 0)
        document.querySelector('.pag-con').addEventListener('click', function () {
            current_page = Number(document.querySelector('span.active').innerHTML) + 1;

            loadItem();
        });
}
function loadItem() {
    $.ajax({
        url: '../controller/admin/pagnation.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            number_of_item: number_of_item,
            current_page: current_page,
            function: "render"
        }
    }).done(function (result) {
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&pag=' + current_page ;
        window.history.pushState({path:newurl},'',newurl);
        $('.result').html(result);
        pagnationBtn();
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