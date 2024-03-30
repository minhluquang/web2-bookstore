<?php 
  include_once('connect.php');
  $database = new connectDB();

  function getProductsByIdCategoryModel($category_id) {
    global $database;
      if ($database->conn) {
        $sql = "SELECT p.id product_id, p.name product_name, p.price, p.image_path
        FROM category_details cd
        INNER JOIN products p ON p.id = cd.product_id
        INNER JOIN categories c ON c.id = cd.category_id
        WHERE c.id = $category_id";
        $result = $database->query($sql);
        return $result;
      } else {
        return false;
      }
  }

  function getProductsForPaginationModel($item_per_page, $page) {
    global $database;
    if ($database->conn) {
      $offset = ($page - 1) * $item_per_page;
      $sql = "SELECT * 
              FROM `products` 
              ORDER BY id ASC
              LIMIT $item_per_page OFFSET $offset;";
      $result = $database->query($sql);
      return $result;
    } else {
      return false;
    }
  }

  function getAmountProductModel() {
    global $database;
    if ($database->conn) {
      $products = $database->selectAll('products'); 
      return $products->num_rows;    
    } else {
      return false;
    }
  }
?>