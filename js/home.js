// // Ham check mat khau co trung voi lap lai mat khau
// var password = document.getElementById("psw");
// var confirmPassword = document.getElementById("registerConfirmPassword");
// var signUpButton = document.querySelector("#signupForm button[type='submit']");

// // Thêm sự kiện 'input' vào trường nhập liệu "Lặp lại Mật khẩu"
// confirmPassword.addEventListener("input", function () {
//   // Nếu giá trị của trường "Lặp lại Mật khẩu" khớp với giá trị của trường "Mật khẩu"
//   if (password.value === confirmPassword.value) {
//     // Xóa thông báo lỗi (nếu có)
//     confirmPassword.setCustomValidity("");
//   } else {
//     // Đặt thông báo lỗi
//     confirmPassword.setCustomValidity("Mật khẩu không khớp");
//   }
// });

// // Thêm sự kiện 'submit' vào form
// document
//   .querySelector("#signupForm")
//   .addEventListener("submit", function (event) {
//     // Kiểm tra nếu trường "Lặp lại Mật khẩu" không hợp lệ
//     if (!confirmPassword.validity.valid) {
//       // Ngăn chặn việc gửi form
//       event.preventDefault();
//     }
//   });
