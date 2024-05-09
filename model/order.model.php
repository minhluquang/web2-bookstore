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
      } 
    } else {
      $database->close();
      return false;
    }
  }

  function getAllOrdersByUsernameModel($username) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT o.id, o.customer_id, o.staff_id, o.delivery_info_id,
                o.date_create, o.total_price, os.id as order_status_id, os.name as order_status, 
                o.discount_code
              FROM orders o
              INNER JOIN order_statuses os ON o.status_id = os.id 
              WHERE customer_id = '$username'
              ORDER BY o.id DESC";
      $result = $database->query($sql);
      if ($result) {
        $database->close();
        return $result;
      } 
    } else {
      $database->close();
      return false;
    }
  }

  function getDetailOrderByOrderIdModel($orderId) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT o.id, o.customer_id, o.staff_id, o.delivery_info_id,
                o.date_create, o.total_price, os.id as order_status_id, os.name as order_status, 
                o.discount_code
              FROM orders o
              INNER JOIN order_statuses os ON o.status_id = os.id 
              WHERE o.id = '$orderId'";
      $result = $database->query($sql);
      if ($result) {
        $database->close();
        return $result;
      } 
    } else {
      $database->close();
      return false;
    }
  }

  function deleteOrderByOrderId($orderId) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "UPDATE orders
              SET status_id = 3
              WHERE id = $orderId";
      $result = $database->execute($sql);
      if ($result) {
        $database->close();
        return $result;
      } 
    } else {
      $database->close();
      return false;
    }
  }
?>