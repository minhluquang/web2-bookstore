var filter_form = document.querySelector(".admin__content--body__filter");
function getFilterFromURL() {
    filter_form.querySelector("#userIdClient").value = (urlParams['id'] != null) ? urlParams['id'] : "";
    filter_form.querySelector("#userRoleClient").value = (urlParams['id'] != null) ? urlParams['role'] : "";
    filter_form.querySelector("#userStatus").value = (urlParams['id'] != null) ? urlParams['status'] : "";
}
function pushFilterToURL() {
  var filter = getFilterFromForm();
  var url_key = {
      "user_id": "id",
      "user_role" : "role",
      "user_status":"status"
  }
  var url = "";
  Object.keys(filter).forEach(key => {
      url += (filter[key] != null && filter[key] != "") ? `&${url_key[key]}=${filter[key]}` : "";
  });
  return url;
}
function getFilterFromForm() {
  return {
      "user_id": filter_form.querySelector("#userIdClient").value,
      "user_role": filter_form.querySelector("#userRoleClient").value,     
      "user_status": filter_form.querySelector("#userStatus").value,
  }
}
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
  getFilterFromURL();
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
  var filter = getFilterFromForm();
    $.ajax({
        url: '../controller/admin/pagnation.controller.php',
        type: "post",
        dataType: 'html',
        data: {
            number_of_item: number_of_item,
            current_page: current_page,
            function: "getRecords",
            filter: filter
        }
    }).done(function (result) {
        if (current_page > parseInt(result)) current_page = parseInt(result)
        if (current_page < 1) current_page = 1;
        $.ajax({
            url: '../controller/admin/pagnation.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                number_of_item: number_of_item,
                current_page: current_page,
                function: "render",
                filter: filter
            }
        }).done(function (result) {

            var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams['page'] + '&item=' + number_of_item + '&current_page=' + current_page;
            newurl += pushFilterToURL();
            window.history.pushState({ path: newurl }, '', newurl);
            $('.result').html(result);
            pagnationBtn();
            filterBtn();
            js();
        })
    })
}
document.addEventListener("DOMContentLoaded", () => {
  loadForFirstTime();
});
function filterBtn() {
  $(".body__filter--action__filter").click((e) => {
      current_page = 1;
      e.preventDefault();
      loadItem();
  })
  $(".body__filter--action__reset").click((e) => {
      current_page = 1;
      status_value = "active";
      $.ajax({
          url: '../controller/admin/pagnation.controller.php',
          type: "post",
          dataType: 'html',
          data: {
              number_of_item: number_of_item,
              current_page: current_page,
              function: "render",
              filter: {
                  user_status: status_value
              }
          }
      }).done(function (result) {
          var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?page=' + urlParams[  'page'] + '&item=' + number_of_item + '&current_page=' + current_page ;
          window.history.pushState({ path: newurl }, '', newurl);
          $('.result').html(result);
          pagnationBtn();
          js();
      })
  })

}
var js = function () {
  const modal = document.getElementById("modal");
  const editButtons = document.querySelectorAll(".actions--edit");
  const modalContent = document.querySelector(".modal-content .form");
  const editFunctionButton = document.querySelector(".editFunctionButton");
  const editAccountButton = document.querySelector(".editAccountButton");
  const closeIcon = document.querySelector(".close i");
  const editPass = document.querySelectorAll(".actions--pass");
  // Lưu nút button sửa đã bấm để lấy thông tin user
  let storeButtonClicked;

  // Render modal chỉnh sửa thông tin tài khoản
  const renderModalEditInfoUser = () => {
    // Thêm html vào modal-content
    document.querySelector('.modal-content').innerHTML = "";
    const html = `    
    <span class="close">
    <i class="fa-solid fa-xmark"></i>
  </span>
  <div class="form">
  <h2>Chỉnh sửa thông tin tài khoản</h2>
      <form id="editForm">
      <div class="input-field">
          <label for="editUserId">Mã người dùng</label>
          <input type="text" id="editUserId" readonly>
      </div>
      <div class="input-field">
          <label for="editUserRole">Loại tài khoản</label>
          <select id="editUserRole">
              <opti value="">Tất cả</opti
              on>
              <option value="3">Người dùng</option>
              <option value="1">Quản trị viên</option>
              <option value="2">Nhân viên</option>
          </select>
      </div>
      <div class="input-field mt-55px">
          <label for="editUserStatus">Trạng thái tài khoản</label>
          <select id="editUserStatus">
              <option value="active">Hoạt động</option>
              <option value="inactive">Ngưng hoạt động</option>
          </select>
      </div>
    </form>
</div>
  <div class="form-actions">
      <button class="closeBtn">Hủy</button>
      <button type="submit" class="saveButton">Lưu</button>
  </div>
    `;
    document.querySelector('.modal-content').innerHTML = html;
  };

  // Render modal Đổi mật khẩu

  const handleRenderDataModalEditUser = (button) => {
    modal.style.display = "block";
    // Populate modal fields with user data from the corresponding row
    const row = button.closest("tr");
    const userId = row.querySelector(".id").textContent;
    const userRole = row.querySelector(".type").getAttribute("value");
    const userStatus = row.querySelector(".status").getAttribute("value");
    document.getElementById("editUserId").value = userId;
  
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

  };

  // Handle khi bấm vào nút sửa

  for (var i = 0; i < editButtons.length; i++) {
      editButtons[i].addEventListener('click',function(e) {
      e.preventDefault();
      renderModalEditInfoUser();
      handleRenderDataModalEditUser(this)

      modal.querySelector('.saveButton').addEventListener('click',function(e) {
        e.stopPropagation();
        e.preventDefault();
          $.ajax({
            url: '../controller/admin/account.controller.php',
            type: "post",
            dataType: 'html',
            data: {
                function: "edit",
                field: { 
                    username: modal.querySelector("#editUserId").value,                  
                    role: modal.querySelector('#editUserRole').value,  
                    status: modal.querySelector('#editUserStatus').value,                
                }
            }
        }).done(function (result) {
            loadItem();
            $("#sqlresult").html(result);
        });
        modal.style.display = "none";
      })

      document.querySelector(".close i").addEventListener("click", function () {
        modal.style.display = "none";
      });
      document.querySelector('.closeBtn').addEventListener("click",function() {
        modal.style.display = "none";
      })
    } );
  }

  const renderModalEditFunctionStaff = () => {
    document.querySelector('.modal-content').innerHTML = "";
    const html_pass = `

    <span class="close">
    <i class="fa-solid fa-xmark"></i>
</span>
<div class="form">
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
</div>
  <div class="form-actions">
      <button class="closeBtn">Hủy</button>
      <button type="submit" class="changePass">Lưu</button>
  </div>
  `;
  document.querySelector('.modal-content').innerHTML = html_pass;
  };



    editPass.forEach(btn => {
    btn.addEventListener('click',function(e) {
      e.preventDefault();
      document.querySelector('.modal-content').innerHTML = "";
      console.log(btn)
      modal.style.display = "block";
      renderModalEditFunctionStaff();
      const username = btn.closest("tr").querySelector(".id").textContent;
    
      document.querySelector(".changePass").addEventListener("click",function(e) {
        e.stopPropagation();
        e.preventDefault();
        const currentPass = document.getElementById("changeCurrentPassword");
        const newPass = document.getElementById("changeNewPassword");
        const confirmNewPass = document.getElementById("changeConfirmNewPassword");
        if(currentPass.value === "") {
          alert("Vui lòng nhập mật khẩu hiện tại !");
          currentPass.focus();
          return;
        } else if(newPass.value === "") {
          alert("Vui lòng nhập mật khẩu mới !");
          newPass.focus();
          return;
        } else if(confirmNewPass.value === "") {
          alert("Vui lòng nhập lại mật khẩu mới !");
          confirmNewPass.focus();
          return;
        } else if(newPass.value !== confirmNewPass.value) {
          alert("nhập lại mật khẩu không chính xác !");
          confirmNewPass.focus(); 
          return;
        }

        var data = {
          function: "password",
          field: {
              username: username,
              currentPassword: currentPass.value,
              NewPassword: confirmNewPass.value
          }
        };
        $.ajax({
          url: '../controller/admin/account.controller.php',
          type: "post",
          dataType: 'html',
          data: data,
      }).done(function (result) {
          loadItem();
          $("#sqlresult").html(result);
          modal.style.display = "none";
      });
        
      })

      document.querySelector(".close i").addEventListener("click", function () {
        modal.style.display = "none";
      });
      document.querySelector('.closeBtn').addEventListener("click",function() {
        modal.style.display = "none";
      })
     
    })
    
  })

  const html_add = `
  <span class="close">
  <i class="fa-solid fa-xmark"></i>
</span>
<div class="form">
<h2>Thông tin tài khoản</h2>
    <form id="editForm">
    <div class="input-field">
        <label for="editUserId">Mã người dùng</label>
        <input type="text" id="editUserId">
    </div>
    <div class="input-field">
        <label for="password">Mật khẩu</label>
        <input type="text" id="password">
    </div>
    <div class="input-field">
        <label for="confirmPassword">Nhập lại mật khẩu</label>
        <input type="text" id="confirmPassword">
    </div>
    <div class="input-field">
        <label for="editUserRole">Loại tài khoản</label>
        <select id="editUserRole">
            <option value="">Tất cả</option>
            <option value="3">Người dùng</option>
            <option value="1">Quản trị viên</option>
            <option value="2">Nhân viên</option>
        </select>
    </div>
  </form>
</div>
<div class="form-actions">
    <button class="closeBtn">Hủy</button>
    <button type="submit" class="addButton">Tạo tài khoản</button>
</div>
  `;

  document.querySelector(".body__filter--action__add").addEventListener("click", (e) => {
    e.preventDefault();
    document.querySelector('.modal-content').innerHTML = html_add;
    modal.style.display = "block";
    modal.querySelector('.addButton').addEventListener('click', function (e) {
        e.preventDefault();
        const username = document.getElementById("editUserId");
        const password = document.getElementById("password");
        const confirmPassword = document.getElementById("confirmPassword");
        const role = document.getElementById("editUserRole");
        
        if(username.value === "") {
          alert("Tên đăng nhập không được để trống !");
          username.focus(); return;
        } else if(password.value === "") {
          alert("Mật khẩu không được để trống !");
          password.focus(); return;
        } else if(password.value.length < 8) {
          alert("Mật khẩu phải từ 8 ký tự trở lên !");
          password.focus(); return;
        } else if(confirmPassword.value === "") {
          alert("Vui lòng nhập lại mật khẩu !");
          confirmPassword.focus(); return;
        } else if(password.value !== confirmPassword.value) {
          alert("Nhập lại mật khẩu không chính xác !");
          confirmPassword.focus(); return;
        } else if(role.value === "") {
          alert("Vui lòng chọn loại tài khoản !");
          role.focus(); return;
        }
        console.log(username,password.value,role.value);
        var data = {
          function: "create",
          field: {
              username:username.value,
              password:password.value,
              role:role.value,
          }
        };
        console.log("Hello");
        $.ajax({
          url: '../controller/admin/account.controller.php',
          type: "post",
          dataType: 'html',
          data: data,
      }).done(function (result) {
          loadItem();
          $("#sqlresult").html(result);
          modal.style.display = "none";
      });  
    });
    
    document.querySelector(".close i").addEventListener("click", function () {
      modal.style.display = "none";
    });
    document.querySelector('.closeBtn').addEventListener("click",function() {
      modal.style.display = "none";
    })
});















  window.addEventListener("click", function (event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  });

};