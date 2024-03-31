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
  const modal = document.getElementById("modal");
  const editButtons = document.querySelectorAll(".actions--edit");
  const modalContent = document.querySelector(".modal-content .form");
  const editFunctionButton = document.querySelector(".editFunctionButton");
  const editAuthorButton = document.querySelector(".editAuthorButton");
  const closeIcon = document.querySelector(".close i");

  // Lưu nút button sửa đã bấm để lấy thông tin Author
  let storeButtonClicked;

  // Render modal chỉnh sửa thông tin tác giả
  const renderModalEditInfoAuthor = () => {
    // Thêm html vào modal-content
    modalContent.innerHTML = "";
    const html = `
    <h2>Chỉnh sửa thông tin tác giả</h2>
    <form id="editForm">
      <div class="input-field">
          <label for="editAuthorId">Mã tác giả</label>
          <input type="text" id="editAuthorId" readonly>
      </div>
      <div class="input-field">
          <label for="editAuthorName">Tên tác giả</label>
          <input type="text" id="editAuthorName">
      </div>
      <div class="input-field">
          <label for="editAuthorEmail">Email</label>
          <input type="email" id="editAuthorEmail">
      </div>
      <div class="input-field">
          <label for="editAuthorRole">Thể loại viết</label>
          <input type="text" id="editAuthorGenres" readonly>

      </div>
      
      
    </form>`;
    modalContent.insertAdjacentHTML("afterbegin", html);
  };




  const handleRenderDataModalEditAuthor = (button) => {
    modal.style.display = "block";
    // Populate modal fields with Author data from the corresponding row
    const row = button.closest("tr");
    const AuthorId = row.querySelector(".id").textContent;
    const AuthorName = row.querySelector(".name").textContent;
    const AuthorEmail = row.querySelector(".email").textContent;
    const AuthorGenres = row.querySelector(".genres").textContent;

    document.getElementById("editAuthorId").value = AuthorId;
    document.getElementById("editAuthorName").value = AuthorName;
    document.getElementById("editAuthorEmail").value = AuthorEmail;
    document.getElementById("editAuthorGenres").value = AuthorGenres;

    const editAuthorStatusSelect = document.querySelector("#editAuthorStatus");
    for (var i = 0; i < editAuthorStatusSelect.options.length; i++) {
      if (editAuthorStatusSelect.options[i].value == AuthorStatus) {
        editAuthorStatusSelect.options[i].selected = true;
        break;
      }
    }


  };

  // Handle khi bấm vào nút sửa
  const handleClickedEditButon = (button) => {
    button.addEventListener("click", () => handleRenderDataModalEditAuthor(button));
  };

  // When the Author clicks the edit button, open the modal
  editButtons.forEach(function (button) {
    renderModalEditInfoAuthor();
    handleClickedEditButon(button);
    storeButtonClicked = button;
  });

  // Thay đổi sang modal phân quyền thành chỉnh sửa thông tin
  editAuthorButton.addEventListener("click", (e) => {
    e.preventDefault();
    renderModalEditInfoAuthor();
    handleRenderDataModalEditAuthor(storeButtonClicked);

    // Ẩn/hiện nút
    editFunctionButton.classList.remove("d-none");
    editAuthorButton.classList.add("d-none");
  });

  // // Close modal
  closeIcon.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // When the Author clicks anywhere outside of the modal, close it
  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Add event listener to the form for handling form submission
  document
    .getElementById("editForm")
    .addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission
      // Handle form submission (you may send an AJAX request to update the Author data)
      // Once the data is updated, close the modal
      modal.style.display = "none";
    });
}