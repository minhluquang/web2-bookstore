<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  include_once('../../model/admin/loginAdmin.model.php');

  if (isset($_POST['isLogin']) && isset($_POST['isLogin'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $isLoginSuccess = isLoginSuccess($username, $password);
    if ($isLoginSuccess) {
      $_SESSION['usernameAdmin'] = $username;
      $response = (object) array (
        "success" => true,
        "message" => "Đăng nhập thành công"
      );
      echo json_encode($response);
    } else {
      $response = (object) array (
        "success" => false,
        "message" => "Tài khoản hoặc mật khẩu không đúng"
      );
      echo json_encode($response);
    }
  }
?>