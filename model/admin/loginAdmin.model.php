<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");

  function isLoginSuccess($username, $password) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT * 
              FROM accounts a
              INNER JOIN roles r ON r.id = a.role_id
              WHERE username = '$username' AND password = '$password'  AND (r.name = 'admin' OR r.name = 'staff')";
      $result = $database->query($sql);
      $database->close();
      if (mysqli_num_rows($result) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      $database->close();
      return false;
    }
  }

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
?>