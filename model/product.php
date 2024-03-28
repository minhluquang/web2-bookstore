<?php 
  function getProductsById($category_id) {
    $conn = connectDB();
    $query = "SELECT p.id product_id, p.name product_name, p.price, p.image_path
              FROM category_details cd
              INNER JOIN products p ON p.id = cd.product_id
              INNER JOIN categories c ON c.id = cd.category_id
              WHERE c.id = $category_id";
    $result = mysqli_query($conn, $query);
    return $result;
}
?>