<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (isset($_POST['modelPath'])) {
  include_once($_POST['modelPath'] . '/delivery_info.model.php');
} else {
  include_once('../model/delivery_info.model.php');
}
if (isset($_POST['function'])) {
  $function = $_POST['function'];
  switch ($function) {
    case 'updateUserInfo':
      updateUserInfo();
      break;
    case 'createNewUserInfo':
      createNewUserInfo();
      break;
    case 'renderAllUserInfoByUserId':
      renderAllUserInfoByUserId();
      break;
    case 'showCurrentDeliveryAddress':
      showCurrentDeliveryAddress();
      break;
  }
}
function getAllUserInfoByUserId($userId)
{
  $result = getAllUserInfoByUserIdModel($userId);

  if ($result !== false) {
    $allUserInfo = $result->fetch_all(MYSQLI_ASSOC);
    
    return $allUserInfo;
  } {
    return "Hệ thống gặp sự cố";
  }
}

function createNewUserInfo()
{
  if (isset($_SESSION['username'])) {
    $idUser = $_SESSION['id'];
    $username = $_SESSION['username'];
    $fullname = $_POST['fullname'];
    $phoneNumber = $_POST['phoneNumber'];
    $addressForm = $_POST['addressForm'];
    $citySelect = $_POST['citySelect'];
    $districtSelect = $_POST['districtSelect'];
    $wardSelect = $_POST['wardSelect'];
    $result = createUserInfoByIdModel($idUser, $fullname, $phoneNumber, $addressForm, $citySelect, $districtSelect, $wardSelect);

    echo json_encode($result);
  } else {
    echo "Phiên đăng nhập không tồn tại!";
  }
}
function updateUserInfo()
{
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
function renderAllUserInfoByUserId()
{
  $usernameUser = $_SESSION['username'];
  $idUser = (int)$_SESSION['id'];  // Ép kiểu thành số nguyên

  $result = getAllUserInfoByUserId($idUser);

  // Kiểm tra kết quả truy vấn
  if (!empty($result)) {
    echo json_encode($result);
  } else {
    echo json_encode(['message' => 'Không có thông tin người dùng.']);
  }
}

// Lấy dữ liệu current user info
function showCurrentDeliveryAddress()
{
  $listUserInfo = getAllUserInfoByUserId($_SESSION['id']);

  foreach ($listUserInfo as $key => $userInfo) {
    if ($key == $_POST['indexAddressRadioChecked']) {
      $result = $userInfo;
    }
  }
  echo json_encode($result);
}
