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
?>