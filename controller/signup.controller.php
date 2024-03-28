<?php
  // Bắt đầu session
  session_start();

  // Include model
  include_once('../model/signup.model.php');

  // Kiểm tra nếu có dữ liệu được gửi từ Ajax (LOGIN)
  if (isset($_POST['usernameLogin']) && isset($_POST['passwordLogin'])) {
    $user = $_POST['usernameLogin'];
    $pass = $_POST['passwordLogin'];

    // Kiểm tra thông tin đăng nhập
    if (checkLogin($user, $pass)) {
      echo "Đăng nhập thành công";
      $_SESSION['username'] = $user;
    } else {
      echo "Sai tên đăng nhập hoặc mật khẩu!";
    }
  } 

  // Kiểm tra nếu có dữ liệu gửi từ Ajax (REGISTER)
  if (
    isset($_POST['usernameRegister']) &&
    isset($_POST['fullnameRegister']) &&
    isset($_POST['phoneNumberRegister']) &&
    isset($_POST['addressRegister']) &&
    isset($_POST['passwordRegister']) &&
    isset($_POST['confirmPasswordRegister'])
  ) {
    $username = $_POST['usernameRegister'];
    $fullname = $_POST['fullnameRegister'];
    $phoneNumber = $_POST['phoneNumberRegister'];
    $address = $_POST['addressRegister'];
    $password = $_POST['passwordRegister'];
    $confirmPassword = $_POST['confirmPasswordRegister'];

    $registerResult = checkRegister($username, $fullname, $phoneNumber, $address, $password);
    if ($registerResult->success) {
      echo $registerResult->message;
    } else {
      echo $registerResult->message;
    }
  } 
?>