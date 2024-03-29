<?php 
  include_once('connect.php');

  function getProductsById($category_id) {
    $conn = connectDB();
    $query = "SELECT p.id product_id, p.name product_name, p.price, p.image_path
              FROM category_details cd
              INNER JOIN products p ON p.id = cd.product_id
              INNER JOIN categories c ON c.id = cd.category_id
              WHERE c.id = $category_id";
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
  }

  function getProductsForPagination($item_per_page, $page) {
    $conn = connectDB();
    $offset = ($page - 1) * $item_per_page;
    $query_get_products = "SELECT * 
                            FROM `products` 
                            ORDER BY id ASC
                            LIMIT $item_per_page OFFSET $offset;";
    $result_get_products = mysqli_query($conn, $query_get_products);
    mysqli_close($conn); 
    if ($result_get_products->num_rows > 0) {
      return (object) array (
        'success' => true,
        'data' => $result_get_products
      );
    } else {
      return (object) array (
        'success' => false,
        'message' => "Không có sản phẩm nào"
      );
    }
  }

  function getTotalRecords() {
    $conn = connectDB();
    $total_records = mysqli_query($conn, "SELECT * FROM products");
    mysqli_close($conn);
    return $total_records->num_rows;
  }
?>