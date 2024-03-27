<?php

// Import connectDB
include_once('model/connect.php');

// Header
require_once("view/header.php");
// connectDB();
// Content
if (isset($_GET['page']) && $_GET['page'] != '') {
  $page = $_GET['page'];

  switch ($page) {
    case 'product':
      require_once('view/pages/product.php');
      break;
    case 'cart':
      require_once('view/pages/cart.php');
      break;
    case 'checkout':
      require_once('view/pages/checkout.php');
      break;
    case 'signup':
      require_once('view/pages/signup.php');
      break;
    case 'product_detail':
      require_once('view/pages/product_detail.php');
      break;
    default:
      // Xử lý trường hợp không khớp với bất kỳ trang nào
      require_once('view/pages/notFound.php');
      break;
  }
} else {
  // Trang chủ
  require_once('view/pages/home.php');
}

// Footer
require_once("view/footer.php");
