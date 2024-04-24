<?php 
  include_once('connect.php');

  function getProductsByIdCategoryModel($category_id, $item_amount, $page) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT p.id product_id,
                      p.name product_name, 
                      p.price, 
                      p.image_path
              FROM category_details cd
              INNER JOIN products p ON p.id = cd.product_id
              INNER JOIN categories c ON c.id = cd.category_id
              WHERE c.id = $category_id";

      if ($item_amount && $page) {
        $offset = ($page - 1) * $item_amount;
        $sql .= " LIMIT $item_amount OFFSET $offset";
      }

      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getProductsForPaginationModel($item_per_page, $page) {
    $database = new connectDB();
    if ($database->conn) {
      $offset = ($page - 1) * $item_per_page;
      $sql = "SELECT * 
              FROM products 
              ORDER BY id ASC
              LIMIT $item_per_page OFFSET $offset;";
      $result = $database->query($sql);
      $database->close();
      return $result;     
    } else {
      $database->close();
      return false;
    }
  }

  function getAmountProductModel() {
    $database = new connectDB();
    if ($database->conn) {
      $products = $database->selectAll('products'); 
      $database->close();
      return $products->num_rows;    
    } else {
      $database->close();
      return false;
    }
  }

  function getProductsByPriceRangeModel($startRange, $endRange, $itemsPerPage, $page) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT * 
              FROM products 
              WHERE price BETWEEN $startRange AND $endRange
              ORDER BY price ASC";

      if ($itemsPerPage && $page) {
        $offset = ($page - 1) * $itemsPerPage;
        $sql .= " LIMIT $itemsPerPage OFFSET $offset;";
      }

      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function getProductsByCategoryAndPriceRangeModel($categoryId, $startRange, $endRange, $itemsPerPage = null, $page = null) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT p.id product_id,
                      p.name product_name, 
                      p.price, 
                      p.image_path
              FROM category_details cd
              INNER JOIN products p ON p.id = cd.product_id
              INNER JOIN categories c ON c.id = cd.category_id
              WHERE c.id = $categoryId AND price BETWEEN $startRange AND $endRange
              ORDER BY price ASC";

      if ($itemsPerPage && $page) {
        $offset = ($page - 1) * $itemsPerPage;
        $sql .= " LIMIT $itemsPerPage OFFSET $offset;";
      }

      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function checkProductEnoughQuantity($id, $quantity) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT *
              FROM products
              WHERE id = $id AND quantity >= $quantity";
      $result = $database->query($sql);
      if ($result && $result->num_rows > 0) {
        $database->close();
        return true;
      } else {
        $database->close();
        return false;
      }
    } else {
      $database->close();
      return false;
    }
  } 

  function updateQuantityProductByIdModel($id, $quantity) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT *
              FROM products
              WHERE id = $id";
      $isExist = $database->query($sql);
      
      // Nếu sản phẩm tồn tại
      if ($isExist && $isExist->num_rows > 0) {
        $sqlUpdateAmount = "UPDATE products
                            SET quantity = quantity + $quantity
                            WHERE id = $id";
        $result = $database->execute($sqlUpdateAmount);
        $database->close();
        return $result;
      } 
      $database->close();
      return false;
    } else {
      $database->close();
      return false;
    }
  }

  function searchProductsByKeywordModel($keyword) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT * 
              FROM products
              WHERE name LIKE '%$keyword%'";
      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }
?>