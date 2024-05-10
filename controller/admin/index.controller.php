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

  if (isset($_POST['isAutoUpdateData']) && $_POST['isAutoUpdateData']) {
    $totalIncome = getTotalIncome();
    $totalIncome = $totalIncome->fetch_assoc();

    $totalOrders = getTotalOrders();
    $totalOrders = $totalOrders->fetch_assoc();

    $totalProducts = getTotalProducts();
    $totalProducts = $totalProducts->fetch_assoc();

    $totalAccounts = getTotalAccounts();
    $totalAccounts = $totalAccounts->fetch_assoc();

    if ($totalIncome && $totalOrders && $totalProducts && $totalAccounts) {
      $result = array(
          'totalIncome' => $totalIncome['total_income'],
          'totalOrders' => $totalOrders['order_count'],
          'totalProducts' => $totalProducts['product_count'],
          'totalAccounts' => $totalAccounts['member_count']
      );

      echo json_encode($result);
    } else {
        echo json_encode(false);
    }
  }
?>