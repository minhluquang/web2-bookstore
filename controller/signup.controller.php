<?php
// Include model
include_once('../model/signup.model.php');
session_start();
// Kiểm tra nếu có dữ liệu được gửi từ Ajax (LOGIN)
if (isset($_POST['usernameLogin']) && isset($_POST['passwordLogin'])) {
  $user = $_POST['usernameLogin'];
  $pass = $_POST['passwordLogin'];

  // Kiểm tra thông tin đăng nhập
  $loginResult = checkLogin($user, $pass);
  if ($loginResult) {
    $_SESSION['username'] = $user;
    $response = (object) array(
      "success" => true,
      "username" => $user,
      "message" => "Đăng nhập thành công!"
    );
    echo json_encode($response);
  } else {
    $response = (object) array(
      "success" => false,
      "message" => "Tài khoản hoặc mật khẩu không chính xác!"
    );
    echo json_encode($response);
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
  $city = $_POST['cityRegister'];
  $district = $_POST['districtRegister'];
  $ward = $_POST['wardRegister'];

  $registerResult = checkRegister($username, $fullname, $phoneNumber, $address, $password, $city, $district, $ward);
  echo json_encode($registerResult);
}
