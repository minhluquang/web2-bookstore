<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }

  if (isset($_POST['modelPath'])) {
    include_once($_POST['modelPath'].'/delivery_info.model.php');
  } else {
    include_once('model/delivery_info.model.php');
  }

  function getAllUserInfoByUserId($userId) {
    $result = getAllUserInfoByUserIdModel($userId);

    if ($result !== false) {
      $allUserInfo = $result->fetch_all(MYSQLI_ASSOC);
      return $allUserInfo;
    } {
      return "Hệ thống gặp sự cố";  
    }
  }

  if (isset($_POST['updateUserInfo']) && $_POST['updateUserInfo']) {
    if (isset($_SESSION['username'])) {
      $updateUserInfoId = $_POST['updateUserInfoId'];
      $updateFullname = $_POST['updateFullname'];
      $updatePhoneNumber = $_POST['updatePhoneNumber'];
      $updateAddressForm = $_POST['updateAddressForm'];
      $citySelect = $_POST['citySelect'];
      $districtSelect = $_POST['districtSelect'];
      $wardSelect = $_POST['wardSelect'];
      $result = updateUserInfoByIdModel($updateUserInfoId, $updateFullname, $updatePhoneNumber, $updateAddressForm, $citySelect, $districtSelect, $wardSelect);
      
      echo json_encode($result);
    } else {
      echo "Phiên đăng nhập không tồn tại!";
    }
  }

  // Lấy dữ liệu all user info by user id để render
  if (isset($_POST['renderAllUserInfoByUserId']) && $_POST['renderAllUserInfoByUserId']) {
    $userId = $_SESSION['username'];
    $result = getAllUserInfoByUserId($userId);
   
    echo json_encode($result);
  }

  // Lấy dữ liệu current user info
  if (isset($_POST['showCurrentDeliveryAddress']) && $_POST['showCurrentDeliveryAddress']) {
    $listUserInfo = getAllUserInfoByUserId($_SESSION['username']);
    foreach ($listUserInfo as $key => $userInfo) {
      if ($key == $_POST['indexAddressRadioChecked']) {
        $result = $userInfo;
      }
    }
    echo json_encode($result);
  }
?>