<?php
// Include model
include_once('../model/signup.model.php');
session_start();
// Kiểm tra nếu có dữ liệu được gửi từ Ajax (LOGIN)
if (isset($_POST['usernameLogin']) && isset($_POST['passwordLogin'])) {
  $user = $_POST['usernameLogin'];
  $pass = $_POST['passwordLogin'];

  // Khởi tạo đối tượng kết nối cơ sở dữ liệu (đảm bảo rằng kết nối đã tồn tại trong model)
  global $database;
  
  // Kiểm tra nếu kết nối cơ sở dữ liệu tồn tại
  if ($database) {
    // Truy vấn để lấy ID người dùng từ username
    $result = $database->query("SELECT id FROM accounts WHERE username = '$user'");
    
    // Kiểm tra nếu truy vấn thành công và có kết quả
    if ($result && $result->num_rows > 0) {
      // Lấy id từ kết quả truy vấn
      $idUser = mysqli_fetch_assoc($result)['id'];

      // Kiểm tra thông tin đăng nhập
      $loginResult = checkLogin($user, $pass);

      // Nếu đăng nhập thành công
      if ($loginResult->success && $loginResult->status == 1) {
        // Gán thông tin vào session
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $idUser;
      }

      // Trả về kết quả đăng nhập dưới dạng JSON
      echo json_encode($loginResult);
    } 
  }}
// Kiểm tra nếu có dữ liệu gửi từ Ajax (REGISTER)
if (isset($_POST['function'])) {
  $function = $_POST['function'];
  switch ($function) {
    case 'sendNewCode':
      sendNewCode();
      break;
    case 'checkCode':
      checkCode();
      break;
    case 'checkAccountExist':
      checkAccountExist();
      break;
    case 'registerAccount':
      registerAccount();
      break;
    case 'checkEmailExist':
      checkEmailExist();
      break;
    case 'resetPassword':
      resetPassword();
      break;
  }
}
function checkAccountExist()
{
  if (
    isset($_POST['usernameRegister']) &&
    isset($_POST['emailRegister'])

  ) {
    $username = $_POST['usernameRegister'];
    $email = $_POST['emailRegister'];

    $registerResult = checkRegister($username, $email);
    echo json_encode($registerResult);
  }
}
function checkCode()
{
  if (
    isset($_POST['verify_code']) &&
    isset($_POST['verify_time']) &&
    isset($_POST['emailRegister'])
  ) {
    $code = $_POST['verify_code'];
    $time = $_POST['verify_time'];
    $email = $_POST['emailRegister'];

    $registerResult = checkVerifyCode($email, $code, $time);
    // $registerResult = registerNewAccount($username, $email,$fullname, $phoneNumber, $address, $password, $city, $district, $ward);
    echo json_encode($registerResult);
  }
}
function sendNewCode()
{
  if (
    isset($_POST['verify_time']) &&
    isset($_POST['email'])
  ) {
    $time = $_POST['verify_time'];
    $email = $_POST['email'];
    sendNewVerifyCode($email, $time);
  }
}
function registerAccount()
{
  if (
    isset($_POST['emailRegister']) &&
    isset($_POST['usernameRegister']) &&
    isset($_POST['fullnameRegister']) &&
    isset($_POST['phoneNumberRegister']) &&
    isset($_POST['addressRegister']) &&
    isset($_POST['passwordRegister']) &&
    isset($_POST['confirmPasswordRegister'])
  ) {
    $email = $_POST['emailRegister'];
    $username = $_POST['usernameRegister'];
    $fullname = $_POST['fullnameRegister'];
    $phoneNumber = $_POST['phoneNumberRegister'];
    $address = $_POST['addressRegister'];
    $password = $_POST['passwordRegister'];
    $confirmPassword = $_POST['confirmPasswordRegister'];
    $city = $_POST['cityRegister'];
    $district = $_POST['districtRegister'];
    $ward = $_POST['wardRegister'];

    // $registerResult = checkVerifyCode($email,$code,$time);
    registerNewAccount($username, $email, $fullname, $phoneNumber, $address, $password, $city, $district, $ward);
    // echo json_encode($registerResult);

  }
}

function resetPassword()
{
  if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirmPassword'])
  ) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    // $registerResult = checkVerifyCode($email,$code,$time);
    setPassword($email, $password);
    // echo json_encode($registerResult);

  }
}

function checkEmailExist(){
  if(isset($_POST['email'])){
    $registerResult = checkEmail($_POST['email']);
    echo json_encode($registerResult);
  }
}