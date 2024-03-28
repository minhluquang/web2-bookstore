<?php
  function getCategoryList() {
    $conn = connectDB();
    $query = "SELECT *
              FROM categories";
    $result = mysqli_query($conn, $query);
    return $result;
  }
?>