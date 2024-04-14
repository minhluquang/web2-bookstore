var searchInput = document.getElementById("searchInput");
var notification = document.querySelector(".notification");
var signupForm = document.querySelector("#signupForm");
var btnTabDangKy = document.querySelector(".btnTabDangKy");
var btnTabDangNhap = document.querySelector(".btnTabDangNhap");

// Add focus event to search input
searchInput.addEventListener("focus", function () {
  notification.style.display = "flex";

  // Close notification when clicking outside after a delay
  setTimeout(function () {
    document.addEventListener("click", clickOutsideHandler);
  }, 0);
});

// Function to handle click outside
function clickOutsideHandler(event) {
  var isClickInside =
    notification.contains(event.target) || searchInput.contains(event.target);
  if (!isClickInside && event.target !== searchInput) {
    // Kiểm tra xem không phải click vào trường tìm kiếm
    notification.style.display = "none";
    document.removeEventListener("click", clickOutsideHandler);
  }
}

// Hàm để hiện phần thông tin của tôi
function showNotification() {
  document.getElementById("overlay").style.display = "block";
  document.getElementById("notificationBox").style.display = "block";
}

function hideNotification() {
  document.getElementById("overlay").style.display = "none";
  document.getElementById("notificationBox").style.display = "none";
}
function saveInfo() {
  var newName = document.getElementById("newName").value;
  var newPhone = document.getElementById("newPhone").value;
  var newAddress = document.getElementById("newAddress").value;

  document.getElementById("name").innerText = newName;
  document.getElementById("phone").innerText = newPhone;
  document.getElementById("address").innerText = newAddress;

  hideNotification();
}

// Ham de hien dang ki hay dang nhap
function showForm(formId, button) {
  var forms = document.querySelectorAll(".form-container");
  forms.forEach(function (form) {
    if (form.id === formId) {
      form.classList.add("active");
    } else {
      form.classList.remove("active");
    }
  });

  var buttons = document.querySelectorAll(".button");
  buttons.forEach(function (btn) {
    btn.classList.remove("active");
  });

  button.classList.add("active");
}

var urlParams = new URLSearchParams(window.location.search);
var paramValue = urlParams.get("luachon");
if (paramValue == "dangky") {
  showForm("signupForm", btnTabDangKy);
}

// Kiểm tra form hợp lệ
const btnDangNhap = document.querySelector(".btnDangNhap");
const btnDangKy = document.querySelector(".btnDangKy");

const loginUsername = document.querySelector("#loginUsername");
const loginPassword = document.querySelector("#loginPassword");
const errMessageUsername = document.querySelector(".errMessageUsername");
const errMessagePassword = document.querySelector(".errMessagePassword");

const registerUsername = document.querySelector("#registerUsername");
const registerFullname = document.querySelector("#registerFullname");
const registerPhoneNumber = document.querySelector("#registerPhoneNumber");
const registerPassword = document.querySelector("#registerPassword");
const registerAddress = document.querySelector("#registerAddress");
const registerConfirmPassword = document.querySelector(
  "#registerConfirmPassword"
);
const errMessageUsernameRegister = document.querySelector(
  ".errMessageUsernameRegister"
);
const errMessageFullnameRegister = document.querySelector(
  ".errMessageFullnameRegister"
);
const errMessagePhoneNumberRegister = document.querySelector(
  ".errMessagePhoneNumberRegister"
);
const errMessageAddressRegister = document.querySelector(
  ".errMessageAddressRegister"
);
const errMessagePasswordRegister = document.querySelector(
  ".errMessagePasswordRegister"
);
const errMessageConfirmPasswordRegister = document.querySelector(
  ".errMessageConfirmPasswordRegister"
);

const validationFormDangNhap = () => {
  let isNotEmptyUsername = false;
  let isNotEmptyPassword = false;

  if (loginUsername.value.trim() == "") {
    errMessageUsername.innerText = "Vui lòng điền username";
    isNotEmptyUsername = false;
  } else {
    errMessageUsername.innerText = "";
    isNotEmptyUsername = true;
  }

  if (loginPassword.value.trim() == "") {
    errMessagePassword.innerText = "Vui lòng điền mật khẩu";
    isNotEmptyPassword = false;
  } else {
    errMessagePassword.innerText = "";
    isNotEmptyPassword = true;
  }

  return isNotEmptyUsername && isNotEmptyPassword;
};

$(document).ready(function () {
  $(".btnDangNhap").click(function (e) {
    e.preventDefault();
    if (validationFormDangNhap()) {
      var $username = $("#loginUsername").val();
      var $password = $("#loginPassword").val();
      $.ajax({
        url: "controller/signup.controller.php",
        type: "post",
        dataType: "html",
        data: {
          usernameLogin: $username,
          passwordLogin: $password,
        },
      }).done(function (result) {
        const data = JSON.parse(result);
        if (data.success) {
          window.location.href = "index.php";
        } else {
          $(".result").html(data.message);
        }
      });
    }
  });
});

const validationFormDangKy = () => {
  let isNotEmptyUsername = false;
  let isNotEmptyFullname = false;
  let isNotEmptyPhoneNumber = false;
  let isNotEmptyAddress = false;
  let isNotEmptyPassword = false;
  let isNotEmptyConfirmPassword = false;

  const regexPhoneNumber = /^0\d{9,10}$/gm;

  if (registerUsername.value.trim() == "") {
    errMessageUsernameRegister.innerText = "Vui lòng điền username";
    isNotEmptyUsername = false;
  } else {
    errMessageUsernameRegister.innerText = "";
    isNotEmptyUsername = true;
  }

  if (registerFullname.value.trim() == "") {
    errMessageFullnameRegister.innerText = "Vui lòng điền họ và tên";
    isNotEmptyFullname = false;
  } else {
    errMessageFullnameRegister.innerText = "";
    isNotEmptyFullname = true;
  }

  if (registerPhoneNumber.value.trim() == "") {
    errMessagePhoneNumberRegister.innerText = "Vui lòng điền số điện thoại";
    isNotEmptyPhoneNumber = false;
  } else if (!regexPhoneNumber.test(registerPhoneNumber.value.trim())) {
    errMessagePhoneNumberRegister.innerText =
      "Vui lòng điền số điện thoại theo đúng định dạng";
    isNotEmptyPhoneNumber = false;
  } else {
    errMessagePhoneNumberRegister.innerText = "";
    isNotEmptyPhoneNumber = true;
  }

  if (registerAddress.value.trim() == "") {
    errMessageAddressRegister.innerText = "Vui lòng điền địa chỉ";
    isNotEmptyAddress = false;
  } else {
    errMessageAddressRegister.innerText = "";
    isNotEmptyAddress = true;
  }

  if (registerPassword.value.trim() == "") {
    errMessagePasswordRegister.innerText = "Vui lòng điền mật khẩu";
    isNotEmptyPassword = false;
  } else if (registerPassword.value.trim().length < 8) {
    errMessagePasswordRegister.innerText =
      "Vui lòng điền mật khẩu tối thiệu 8 kí tự";
    isNotEmptyPassword = false;
  } else {
    errMessagePasswordRegister.innerText = "";
    isNotEmptyPassword = true;
  }

  if (registerConfirmPassword.value.trim() == "") {
    errMessageConfirmPasswordRegister.innerText =
      "Vui lòng điền nhập lại mật khẩu";
    isNotEmptyConfirmPassword = false;
  } else if (
    registerConfirmPassword.value.trim() != registerPassword.value.trim() &&
    registerPassword.value.trim() != ""
  ) {
    errMessageConfirmPasswordRegister.innerText =
      "Vui lòng điền nhập lại mật khẩu khớp với mật khẩu";
    isNotEmptyConfirmPassword = false;
  } else {
    errMessageConfirmPasswordRegister.innerText = "";
    isNotEmptyConfirmPassword = true;
  }

  return (
    isNotEmptyUsername &&
    isNotEmptyFullname &&
    isNotEmptyPhoneNumber &&
    isNotEmptyAddress &&
    isNotEmptyPassword &&
    isNotEmptyConfirmPassword
  );
};

const toast = document.querySelector(".toast");
const overlay = document.querySelector(".toast-overlay");
$(document).ready(function () {
  $(".btnDangKy").click(function (e) {
    e.preventDefault();
    if (validationFormDangKy()) {
      var $username = $("#registerUsername").val();
      var $fullname = $("#registerFullname").val();
      var $phoneNumber = $("#registerPhoneNumber").val();
      var $address = $("#registerAddress").val();
      var $password = $("#registerPassword").val();
      var $confirmPassword = $("#registerConfirmPassword").val();

      $.ajax({
        url: "controller/signup.controller.php",
        type: "post",
        dataType: "html",
        data: {
          usernameRegister: $username,
          fullnameRegister: $fullname,
          phoneNumberRegister: $phoneNumber,
          addressRegister: $address,
          passwordRegister: $password,
          confirmPasswordRegister: $confirmPassword,
        },
      }).done(function (result) {
        const data = JSON.parse(result);
        if (data.success) {
          toast.classList.add("active");
          overlay.classList.add("active");

          $(".result").html("");
        } else {
          $(".result").addClass("error");
          $(".result").html(data.message);
        }
      });
    }
  });
});

// Xoá thông điệp lỗi khi bấm đăng nhập/đăng ký
function deleteResultMessage() {
  var resultElements = document.querySelectorAll(".result");
  resultElements.forEach((resultEle) => (resultEle.innerText = ""));
}

function deleteInputFieldSignIn() {
  loginUsername.value = "";
  loginPassword.value = "";
}

function deleteInputFeildSignUp() {
  registerUsername.value = "";
  registerFullname.value = "";
  registerPhoneNumber.value = "";
  registerAddress.value = "";
  registerPassword.value = "";
  registerConfirmPassword.value = "";
}

btnTabDangKy.addEventListener("click", deleteResultMessage);
btnTabDangKy.addEventListener("click", deleteInputFieldSignIn);
btnTabDangNhap.addEventListener("click", deleteResultMessage);
btnTabDangNhap.addEventListener("click", deleteInputFeildSignUp);
