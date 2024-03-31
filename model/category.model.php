<?php
  $database = new connectDB();

  function getCategoryListModel() {
    global $database;
    if ($database->conn) {
      $result = $database->selectAll("categories");
      return $result;
    } else {
      return false;
    }
  }
?>