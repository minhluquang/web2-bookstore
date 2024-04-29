<?php
  include_once('connect.php');

  function addNewOrder($customerId, $deliveryInfoId, $totalPrice, $discountCode) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "INSERT INTO orders (customer_id, staff_id, delivery_info_id, date_create, total_price, status_id, discount_code)
              VALUES ('$customerId', null, $deliveryInfoId, NOW(), $totalPrice, 1, $discountCode);";
      $result = $database->execute($sql);
      if ($result) {
        $orderId = $database->conn->insert_id;
        $database->close();
        return $orderId;
      } else {
        $database->close();
        return $sql;
      }
    } else {
      $database->close();
      return false;
    }
  }
?>