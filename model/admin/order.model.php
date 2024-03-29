<?php
function order_delete($id)
{
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
    include_once("{$base_dir}connect.php");
    $conn = connectDB();
    $sql_details = 'DELETE FROM `order_details` WHERE order_id="' . $id . '"';
    $result_details = mysqli_query($conn, $sql_details);
    $sql_order = 'DELETE FROM `orders` WHERE id="' . $id . '"';
    $result_order = mysqli_query($conn, $sql_order);
    if ($result_details && $result_order ) {
        return (object) array(
          'success' => true,
          'message' => "Xóa dơn hàng với mã $id thành công"
        );
      } else {
        $error ="Xóa đơn hàng với mã $id KHÔNG thành công\n";
        if(!$result_details){
          $error += "Lỗi khi xử lý bảng order_details\n";
        }
        if(!$result_order){
          $error += "Lỗi khi xử lý bảng orders\n";
        }
        return (object) array(
          'success' => false,
          'message' => $error
        );
      }
}
