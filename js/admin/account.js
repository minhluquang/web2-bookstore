// Load the jquery
var script = document.createElement("SCRIPT");
script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js';
script.type = 'text/javascript';
document.getElementsByTagName("head")[0].appendChild(script);

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
  loadItem(1);
}
function pagnationBtn() {
  // pagnation
  document.querySelectorAll('.pag').forEach((btn) => btn.addEventListener('click', function () {
    loadItem(btn.innerHTML);
  }));
  if (document.getElementsByClassName('pag-pre').length > 0)
    document.querySelector('.pag-pre').addEventListener('click', function () {
      var current_page = Number(document.querySelector('span.active').innerHTML) - 1;
      loadItem(current_page);
    });
  if (document.getElementsByClassName('pag-con').length > 0)
    document.querySelector('.pag-con').addEventListener('click', function () {
      var current_page = Number(document.querySelector('span.active').innerHTML) + 1;
      loadItem(current_page);
    });
}
const urlParams = new URLSearchParams(window.location.search);
function loadItem(current_page) {
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
  const editAccountButton = document.querySelector(".editAccountButton");
  const closeIcon = document.querySelector(".close i");

  // Lưu nút button sửa đã bấm để lấy thông tin user
  let storeButtonClicked;

  // Render modal chỉnh sửa thông tin tài khoản
  const renderModalEditInfoUser = () => {
    // Thêm html vào modal-content
    modalContent.innerHTML = "";
    const html = `
    <h2>Chỉnh sửa thông tin tài khoản</h2>
    <form id="editForm">
      <div class="input-field">
          <label for="editUserId">Mã người dùng</label>
          <input type="text" id="editUserId" readonly>
      </div>
      <div class="input-field">
          <label for="editUserName">Tên người dùng</label>
          <input type="text" id="editUserName">
      </div>
      <div class="input-field">
          <label for="editUserEmail">Email</label>
          <input type="email" id="editUserEmail">
      </div>
      <div class="input-field">
          <label for="editUserRole">Loại tài khoản</label>
          <select id="editUserRole">
              <option value="customer">Người dùng</option>
              <option value="admin">Quản trị viên</option>
              <option value="staff">Nhân viên</option>
          </select>
      </div>
      <div class="input-field mt-55px">
          <label for="editUserStatus">Trạng thái tài khoản</label>
          <select id="editUserStatus">
              <option value="active">Hoạt động</option>
              <option value="inactive">Ngưng hoạt động</option>
          </select>
      </div>
      
    </form>`;
    modalContent.insertAdjacentHTML("afterbegin", html);
  };

  // Render modal chỉnh sửa quyền nhân viên
  const renderModalEditFunctionStaff = () => {
    modalContent.innerHTML = "";
    const html = `
    <h2>Chỉnh sửa quyền nhân viên</h2>
    <form id="Form">
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qlsp" id="qlsp">
            <label for="qlsp">Quản lý sản phẩm</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qldh" id="qldh">
            <label for="qldh">Quản lý đơn hàng</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qltk" id="qltk">
            <label for="qltk">Quản lý tài khoản</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qldm" id="qldm">
            <label for="qldm">Quản lý danh mục</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qltkbc" id="qltkbc">
            <label for="qltkbc">Quản lý thống kê và báo cáo</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qlttgh" id="qlttgh">
            <label for="qlttgh">Quản lý thông tin giao hàng</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qlnxb" id="qlnxb">
            <label for="qlnxb">Quản lý nhà xuất bản</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qltg" id="qltg">
            <label for="qltg">Quản lý tác giả</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qlncc" id="qlncc">
            <label for="qlncc">Quản lý nhà cung cấp</label>
        </div>
        <div class="input-field d-flex-start">
            <input type="checkbox" name="qlpq" id="qlpq">
            <label for="qlpq">Quản lý phân quyền</label>
        </div>
    </form>
  `;
    modalContent.insertAdjacentHTML("afterbegin", html);
  };

  const handleRenderDataModalEditUser = (button) => {
    modal.style.display = "block";
    // Populate modal fields with user data from the corresponding row
    const row = button.closest("tr");
    const userId = row.querySelector(".id").textContent;
    const userName = row.querySelector(".name").textContent;
    const userEmail = row.querySelector(".email").textContent;
    const userRole = row.querySelector(".type").getAttribute("value");
    const userStatus = row.querySelector(".status").getAttribute("value");
    document.getElementById("editUserId").value = userId;
    document.getElementById("editUserName").value = userName;
    document.getElementById("editUserEmail").value = userEmail;
    var editUserRoleSelect = document.getElementById("editUserRole");
    for (var i = 0; i < editUserRoleSelect.options.length; i++) {
      if (editUserRoleSelect.options[i].value === userRole) {
        editUserRoleSelect.options[i].selected = true;
        break;
      }
    }

    const editUserStatusSelect = document.querySelector("#editUserStatus");
    for (var i = 0; i < editUserStatusSelect.options.length; i++) {
      if (editUserStatusSelect.options[i].value == userStatus) {
        editUserStatusSelect.options[i].selected = true;
        break;
      }
    }

    // Thay đổi sang modal chỉnh sửa thông tin thành phân quyền
    editFunctionButton.addEventListener("click", (e) => {
      e.preventDefault();
      renderModalEditFunctionStaff();

      // Ẩn/hiện nút
      editFunctionButton.classList.add("d-none");
      editAccountButton.classList.remove("d-none");
    });
  };

  // Handle khi bấm vào nút sửa
  const handleClickedEditButon = (button) => {
    button.addEventListener("click", () => handleRenderDataModalEditUser(button));
  };

  // When the user clicks the edit button, open the modal
  editButtons.forEach(function (button) {
    renderModalEditInfoUser();
    handleClickedEditButon(button);
    storeButtonClicked = button;
  });

  // Thay đổi sang modal phân quyền thành chỉnh sửa thông tin
  editAccountButton.addEventListener("click", (e) => {
    e.preventDefault();
    renderModalEditInfoUser();
    handleRenderDataModalEditUser(storeButtonClicked);

    // Ẩn/hiện nút
    editFunctionButton.classList.remove("d-none");
    editAccountButton.classList.add("d-none");
  });

  // // Close modal
  closeIcon.addEventListener("click", function () {
    modal.style.display = "none";
  });

  // When the user clicks anywhere outside of the modal, close it
  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

  // Add event listener to the form for handling form submission
  var editForm = document.getElementById("editForm")
  if (!editForm == null) editForm.addEventListener("submit", function (event) {
    event.preventDefault(); // Prevent the default form submission
    // Handle form submission (you may send an AJAX request to update the user data)
    // Once the data is updated, close the modal
    modal.style.display = "none";
  });

}