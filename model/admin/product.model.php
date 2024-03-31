
<?php
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
  include_once("{$base_dir}connect.php");
  $database = new connectDB();
function product_delete($id)
{

  global $database;
  $sql_cat = 'DELETE FROM `category_details` WHERE product_id="' . $id . '"';
  $result_cat = $database->query($sql_cat);
  $sql_au = 'DELETE FROM `author_details` WHERE product_id="' . $id . '"';
  $result_au =$database->query( $sql_au);
  $sql_receipt = 'DELETE FROM `goodsreceipt_details` WHERE product_id="' . $id . '"';
  $result_receipt =$database->query( $sql_receipt);
  $sql_order = 'DELETE FROM `order_details` WHERE product_id="' . $id . '"';
  $result_order =$database->query( $sql_order);
  $sql_product = 'DELETE FROM `products` WHERE id="' . $id . '"';
  $result_product =$database->query( $sql_product);
  if ($result_cat && $result_au && $result_receipt && $result_order && $result_product) {
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
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}

function loadProductForPagnation($number_of_item,$current_page,$page)
{
  global $database;
  $offset=($current_page-1)*$number_of_item;
  $sql = "SELECT * FROM $page ORDER BY id ASC LIMIT $number_of_item OFFSET $offset ";
  $result =$database->query( $sql);
  if($result->num_rows > 0){
    return (Object) array (
      'success' => true,
      'data' => $result
    );
  }
  else {
    return (Object) array (
      'success' => false
    );
  } 
}
function getTotalRecords($page) {
  global $database;
  $total_records =$database->query( "SELECT * FROM $page");
  return $total_records->num_rows;
}

