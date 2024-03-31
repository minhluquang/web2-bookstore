<?php
  if (isset($_POST['modelPath'])) {
    include_once($_POST['modelPath'].'/product.model.php');
  } else {
    include_once('model/product.model.php');
  }

  // include_once("../model/product.model.php");

  function getProductsByIdCategory($category_id, $items_amount = null, $page = null) {
    $result = getProductsByIdCategoryModel($category_id, $items_amount, $page);
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
      return (object) array (
        'success' => false,
        'message' => "Không có sản phẩm nào"
      );
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
    $categoryId = $_POST['categoryId'];
    $itemsPerPage = $_POST['itemsPerPage'];
    $page = intval($_POST['currentPage']);

    if (isset($_POST['categoryId']) && $_POST['categoryId'] != null) {
      $amountProduct = getProductsByIdCategoryModel($categoryId, null, null)->num_rows;  
      $result = getProductsByIdCategoryModel($categoryId, $itemsPerPage, $page);
      
      if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = (object) array(
          'products' => $products,
          'page' => $page,
          'amountProduct' => $amountProduct
        );
        echo json_encode($response);
      }
    } else {
      $result = getProductsForPaginationModel($itemsPerPage, $page);
      if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = (object) array(
          'products' => $products,
          'page' => $page,
          'amountProduct' => getAmountProductModel()
        );
        echo json_encode($response);
      }
    }
  }

  // // Xử lý lọc sản phẩm nâng cao
  // if (isset($_POST['categoryId'])) {
  //   $categoryId = $_POST['categoryId'];
  //   $itemsPerPage = $_POST['itemsPerPage'];
  //   $page = $_POST['page'];

  //   $amountProduct = getProductsByIdCategoryModel($categoryId, null, null)->num_rows;  
  //   $result = getProductsByIdCategoryModel($categoryId, $itemsPerPage, $page);
    
  //   if ($result->num_rows > 0) {
  //     $products = $result->fetch_all(MYSQLI_ASSOC);
  //     $response = (object) array(
  //       'products' => $products,
  //       'page' => $page,
  //       'amountProduct' => $amountProduct
  //     );
  //     echo json_encode($response);
  //   }
  // }
?>