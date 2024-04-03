$(document).ready(function () {
  $(".btnDangNhap").click(function (e) {
    e.preventDefault();
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
  });
});

$(document).ready(function () {
  $(".btnDangKy").click(function (e) {
    e.preventDefault();
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
      $(".result").html(result);
    });
  });
});
