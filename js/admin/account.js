// Load the jquery
var script = document.createElement("SCRIPT");
script.src = "https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js";
script.type = "text/javascript";
document.getElementsByTagName("head")[0].appendChild(script);
var search = location.search.substring(1);
urlParams = JSON.parse(
  '{"' + search.replace(/&/g, '","').replace(/=/g, '":"') + '"}',
  function (key, value) {
    return key === "" ? value : decodeURIComponent(value);
  }
);
var number_of_item = urlParams["item"];
var current_page = urlParams["pag"];
if (current_page == null) {
  current_page = 1;
}
if (number_of_item == null) {
  number_of_item = 5;
}
function checkReady() {
  return new Promise(async function (resolve) {
    while (!window.jQuery) {
      await new Promise((resolve) => setTimeout(resolve, 20));
    }
    resolve();
  });
}
async function loadForFirstTime() {
  await checkReady();
  loadItem();
}
function pagnationBtn() {
  // pagnation
  document.querySelectorAll(".pag").forEach((btn) =>
    btn.addEventListener("click", function () {
      current_page = btn.innerHTML;
      loadItem();
    })
  );
  if (document.getElementsByClassName("pag-pre").length > 0)
    document.querySelector(".pag-pre").addEventListener("click", function () {
      current_page =
        Number(document.querySelector("span.active").innerHTML) - 1;
      loadItem(number_of_item, current_page);
    });
  if (document.getElementsByClassName("pag-con").length > 0)
    document.querySelector(".pag-con").addEventListener("click", function () {
      current_page =
        Number(document.querySelector("span.active").innerHTML) + 1;

      loadItem();
    });
}
function loadItem() {
  $.ajax({
    url: "../controller/admin/pagnation.controller.php",
    type: "post",
    dataType: "html",
    data: {
      number_of_item: number_of_item,
      current_page: current_page,
      function: "render",
    },
  }).done(function (result) {
    var newurl =
      window.location.protocol +
      "//" +
      window.location.host +
      window.location.pathname +
      "?page=" +
      urlParams["page"] +
      "&item=" +
      number_of_item +
      "&pag=" +
      current_page;
    window.history.pushState({ path: newurl }, "", newurl);
    $(".result").html(result);
    pagnationBtn();
    js();
  });
}
document.addEventListener("DOMContentLoaded", () => {
  loadForFirstTime();
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
          <label for="editUserRole">Loại tài khoản</label>
          <select id="editUserRole">
              <option value="all">Tất cả</option>
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

  // Render modal Đổi mật khẩu
  const renderModalEditFunctionStaff = () => {
    modalContent.innerHTML = "";
    const html = `
    <h2>Đổi mật khẩu</h2>
    <form id="changePasswordForm">
      <div class="input-field">
          <label for="changeCurrentPassword">Mật khẩu hiện tại</label>
          <div class="changeCurrentPasswordContainer">
            <input type="password" id="changeCurrentPassword" >
            <button class="changeCurrentPasswordView">
              <i class="fa-solid fa-eye-slash noView-loginPassword"></i>
              <i class="fa-solid fa-eye view-loginPassword hide"></i>
            </button>
          </div>
      </div>
      <div class="input-field">
          <label for="changeNewPassword">Mật khẩu mới</label>
          <div class="changeNewPasswordContainer">
            <input type="password" id="changeNewPassword">
            <button class="changeNewPasswordView">
              <i class="fa-solid fa-eye-slash noView-loginPassword"></i>
              <i class="fa-solid fa-eye view-loginPassword hide"></i>
            </button>
          </div>
      </div>
      <div class="input-field">
          <label for="changeConfirmNewPassword">Nhập lại mật khẩu mới</label>
          <div class="changeConfirmNewPasswordContainer">
            <input type="password" id="changeConfirmNewPassword">
            <button class="changeConfirmNewPasswordView">
                <i class="fa-solid fa-eye-slash noView-loginPassword"></i>
                <i class="fa-solid fa-eye view-loginPassword hide"></i>
            </button>
          </div>
      </div>
    </form>
  `;
    modalContent.insertAdjacentHTML("afterbegin", html);
    anHienMatKhauModalDoiMatKhau();
  };

  const handleRenderDataModalEditUser = (button) => {
    modal.style.display = "block";
    // Populate modal fields with user data from the corresponding row
    const row = button.closest("tr");
    const userId = row.querySelector(".id").textContent;
    const userName = row.querySelector(".name").textContent;
    const userRole = row.querySelector(".type").getAttribute("value");
    const userStatus = row.querySelector(".status").getAttribute("value");
    document.getElementById("editUserId").value = userId;
    document.getElementById("editUserName").value = userName;
    // document.getElementById("editUserEmail").value = userEmail;
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
    button.addEventListener("click", () =>
      handleRenderDataModalEditUser(button)
    );
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
  var editForm = document.getElementById("editForm");
  if (!editForm == null)
    editForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent the default form submission
      // Handle form submission (you may send an AJAX request to update the user data)
      // Once the data is updated, close the modal
      modal.style.display = "none";
    });
};

// Bấm nút ẩn/hiện password
function anHienMatKhauModalDoiMatKhau() {
  const currentPasswordNoView = document.querySelector(
    ".changeCurrentPasswordView .noView-loginPassword"
  );
  const currentPasswordView = document.querySelector(
    ".changeCurrentPasswordView .view-loginPassword"
  );

  const newPasswordNoView = document.querySelector(
    ".changeNewPasswordView .noView-loginPassword"
  );
  const newPasswordView = document.querySelector(
    ".changeNewPasswordView .view-loginPassword"
  );

  const confirmNewPasswordNoView = document.querySelector(
    ".changeConfirmNewPasswordView .noView-loginPassword"
  );
  const confirmNewPasswordView = document.querySelector(
    ".changeConfirmNewPasswordView .view-loginPassword"
  );

  const inputCurrentPassword = document.querySelector("#changeCurrentPassword");
  const inputNewPassword = document.querySelector("#changeNewPassword");
  const inputConfirmNewPassword = document.querySelector(
    "#changeConfirmNewPassword"
  );

  currentPasswordNoView.addEventListener("click", (e) => {
    e.preventDefault();
    inputCurrentPassword.setAttribute("type", "text");
    currentPasswordView.classList.toggle("hide");
    currentPasswordNoView.classList.toggle("hide");
  });

  currentPasswordView.addEventListener("click", (e) => {
    e.preventDefault();
    inputCurrentPassword.setAttribute("type", "password");
    currentPasswordView.classList.toggle("hide");
    currentPasswordNoView.classList.toggle("hide");
  });

  newPasswordNoView.addEventListener("click", (e) => {
    e.preventDefault();
    inputNewPassword.setAttribute("type", "text");
    newPasswordView.classList.toggle("hide");
    newPasswordNoView.classList.toggle("hide");
  });

  newPasswordView.addEventListener("click", (e) => {
    e.preventDefault();
    inputNewPassword.setAttribute("type", "password");
    newPasswordView.classList.toggle("hide");
    newPasswordNoView.classList.toggle("hide");
  });

  confirmNewPasswordNoView.addEventListener("click", (e) => {
    e.preventDefault();
    inputConfirmNewPassword.setAttribute("type", "text");
    confirmNewPasswordView.classList.toggle("hide");
    confirmNewPasswordNoView.classList.toggle("hide");
  });

  confirmNewPasswordView.addEventListener("click", (e) => {
    e.preventDefault();
    inputConfirmNewPassword.setAttribute("type", "password");
    confirmNewPasswordView.classList.toggle("hide");
    confirmNewPasswordNoView.classList.toggle("hide");
  });
}
