<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include_once('../../model/admin/index.model.php');
  include_once('../../model/admin/function_detail.model.php');

  if (isset($_POST['isLogout']) && $_POST['isLogout']) {
    try {
      unset($_SESSION['usernameAdmin']);
      echo true;
    } catch (\Throwable $th) {
      echo false;
    }
  }

  if (isset($_POST['isRender']) && $_POST['isRender']) {
    $username = $_SESSION['usernameAdmin'];

    $account = getRoleIdByUsernameModel($username);
    $account = $account->fetch_assoc();
    $roleId = intval($account['role_id']);

    $functionDetails = getAllFunctionDetailsByRolerIdModel($roleId);
    
    if ($functionDetails) {
      $functionDetails = $functionDetails->fetch_all(MYSQLI_ASSOC);
      // $account = $account->fetch_assoc();
      echo json_encode($functionDetails);
    } else {
      echo false;
    }
  }
?>