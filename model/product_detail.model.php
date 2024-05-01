<?php
include_once('connect.php');

function getProductDetailByIdModel($product_id, $closeDatabase = false)
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT 
            p.name AS product_name, 
            p.image_path, 
            p.quantity, 
            p.price, 
            pub.name AS publisher_name,
            GROUP_CONCAT(' ', c.name) AS category_names,
            GROUP_CONCAT(' ', a.name) AS author_names
        FROM 
            products p  
            INNER JOIN publishers pub ON p.publisher_id = pub.id
            LEFT JOIN category_details cd ON cd.product_id = p.id
            LEFT JOIN categories c ON cd.category_id = c.id
            LEFT JOIN author_details ad ON ad.product_id = p.id
            LEFT JOIN authors a ON ad.author_id = a.id
        WHERE 
            p.id = $product_id
        GROUP BY 
            p.id";
    $result = $database->query($sql);
    if ($closeDatabase) {
      $database->close();
    }
    return $result;
  } else {
    return false;
  }
}
