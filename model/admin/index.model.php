<?php
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
  include_once("{$base_dir}connect.php");

  function getRoleIdByUsernameModel($username) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT *
              FROM accounts
              WHERE username = '$username'";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getTotalIncome() {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT SUM(o.total_price) AS total_income FROM orders o WHERE o.status_id = 5";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getTotalOrders() {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT COUNT(id) AS order_count FROM orders";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getTotalProducts() {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT COUNT(id) AS product_count FROM products";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getTotalAccounts() {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT COUNT(username) AS member_count FROM accounts";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }
?>