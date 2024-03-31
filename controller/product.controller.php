<?php
  include_once('../model/product.model.php');

  function getProductsByIdCategory($category_id) {
    $result = getProductsByIdCategoryModel($category_id);
    if ($result !== false) {
      $products = $result->fetch_all(MYSQLI_ASSOC);
      return $products;
    } else {
      return "Hệ thống gặp sự cố";
    }
  }

  function getProductsForPagination($item_per_page, $page) {
    $result = getProductsForPaginationModel($item_per_page, $page);
    if ($result !== false) {
      if ($result->num_rows > 0) {
        return (object) array (
          'success' => true,
          'data' => $result->fetch_all(MYSQLI_ASSOC)
        );
      } else {
        return (object) array (
          'success' => false,
          'message' => "Không có sản phẩm nào"
        );
      }
    } else {
      return "Hệ thống gặp sự cố";
    }
  }

  function getAmountProduct() {
    $result = getAmountProductModel();
    if ($result !== false) {
      return $result;
    } else {
      return "Hệ thống gặp sự cố";
    }
  }

  // Xử lý render sản phẩm (page=product)
  if (isset($_POST['currentPage']) && isset($_POST['itemsPerPage'])) {
    $items_per_page = intval($_POST['itemsPerPage']);
    $page = intval($_POST['currentPage']);
    $result = getProductsForPaginationModel($items_per_page, $page);
    if ($result->num_rows > 0) {
      $products = $result->fetch_all(MYSQLI_ASSOC);
      $response = (object) array(
        'products' => $products,
        'page' => $page,
        'amountProduct' => getAmountProductModel()
      );
      echo json_encode($response);
    } else {
      return "Hệ thống gặp sự cố";
    }
  }
?>