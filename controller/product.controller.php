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
    $priceRange= $_POST['priceRange'];
    $itemsPerPage = $_POST['itemsPerPage'];
    $page = intval($_POST['currentPage']);
    
    $startRange = 0;
    $endRange = 0;

    // Gán giá trị lại cho startRange && endRange nếu có chọn lọc theo giá
    if ($priceRange == 'duoi50') {
      $startRange = 0;
      $endRange = 49000;
    } else if ($priceRange == 'tu50duoi100') {
      $startRange = 50000;
      $endRange = 100000;
    } else if ($priceRange == 'tu100duoi200') {
      $startRange = 100000;
      $endRange = 200000;
    } else if ($priceRange == 'tren200') {
      $startRange = 200001;
      $endRange = 1000000000;
    }

    if ($priceRange != null && $categoryId != null) {
      $amountProduct = getProductsByCategoryAndPriceRangeModel($categoryId, $startRange, $endRange, null, null)->num_rows;
      $result = getProductsByCategoryAndPriceRangeModel($categoryId, $startRange, $endRange, $itemsPerPage, $page);
      if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = (object) array(
          'products' => $products,
          'page' => $page,
          'amountProduct' => $amountProduct
        );
        echo json_encode($response);
      } 
    } else if ($priceRange != null) {
      $amountProduct = getProductsByPriceRangeModel($startRange, $endRange, null, null)->num_rows;
      $result = getProductsByPriceRangeModel($startRange, $endRange, $itemsPerPage, $page);
      if ($result->num_rows > 0) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = (object) array(
          'products' => $products,
          'page' => $page,
          'amountProduct' => $amountProduct
        );
        echo json_encode($response);
      } 
    } else if ($categoryId != null) {
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
?>