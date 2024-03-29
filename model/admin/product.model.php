
<?php

function product_delete($id)
{
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
  include_once("{$base_dir}connect.php");
  $conn = connectDB();
  $sql_cat = 'DELETE FROM `category_details` WHERE product_id="' . $id . '"';
  $result_cat = mysqli_query($conn, $sql_cat);
  $sql_au = 'DELETE FROM `author_details` WHERE product_id="' . $id . '"';
  $result_au = mysqli_query($conn, $sql_au);
  $sql_receipt = 'DELETE FROM `goodsreceipt_details` WHERE product_id="' . $id . '"';
  $result_receipt = mysqli_query($conn, $sql_receipt);
  $sql_order = 'DELETE FROM `order_details` WHERE product_id="' . $id . '"';
  $result_order = mysqli_query($conn, $sql_order);
  $sql_product = 'DELETE FROM `products` WHERE id="' . $id . '"';
  $result_product = mysqli_query($conn, $sql_product);
  if ($result_cat && $result_au && $result_receipt && $result_order && $result_product) {
    mysqli_close($conn);
    return (object) array(
      'success' => true,
      'message' => "Xóa sản phẩm với mã $id thành công"
    );
  } else {
    $error = "Xóa sản phẩm với mã $id KHÔNG thành công\n";
    if (!$result_cat) {
      $error += "Lỗi khi xử lý bảng category_details\n";
    }
    if (!$result_au) {
      $error += "Lỗi khi xử lý bảng author_details\n";
    }
    if (!$result_receipt) {
      $error += "Lỗi khi xử lý bảng goodsreceipt_details\n";
    }
    if (!$result_order) {
      $error += "Lỗi khi xử lý bảng order_details\n";
    }
    if (!$result_product) {
      $error += "Lỗi khi xử lý bảng products\n";
    }
    mysqli_close($conn);
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}

