<?php
  include_once("../model/checkout.model.php");

  if (isset($_POST['promoCodeCheck']) && $_POST['promoCodeCheck']) {
    $promoValue = $_POST['promoValue'];

    // Kiểm tra discount có tồn tại không
    $discount = checkIsExistDiscountCode($promoValue);
    echo json_encode($discount);
  }
?>