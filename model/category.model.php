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

  function getCategoryByIdModel($category_id) {
    global $database;
    if (!$database->conn) return false;

    $query = "SELECT * FROM categories WHERE id = $category_id";
    $result = $database->conn->query($query);

    return $result->fetch_assoc();
}

?>