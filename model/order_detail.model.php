<?php
  include_once('connect.php');

  function addNewOrderDetail($orderId, $productId, $quantity, $price) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "INSERT INTO order_details(order_id, product_id, quantity, price)
               VALUES ($orderId, $productId, $quantity, $price);";
      $result = $database->execute($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }
?>