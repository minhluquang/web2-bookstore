<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function order_delete($id)
{
  $database = new connectDB();
  $sql_details = 'DELETE FROM `order_details` WHERE order_id="' . $id . '"';
  $result_details = $database->query($sql_details);
  $sql_order = 'DELETE FROM `orders` WHERE id="' . $id . '"';
  $result_order = $database->query($sql_order);
  $database->close();
  if ($result_details && $result_order) {
    return (object) array(
      'success' => true,
      'message' => "Xóa dơn hàng với mã $id thành công"
    );
  } else {
    $error = "Xóa đơn hàng với mã $id KHÔNG thành công\n";
    if (!$result_details) {
      $error += "Lỗi khi xử lý bảng order_details\n";
    }
    if (!$result_order) {
      $error += "Lỗi khi xử lý bảng orders\n";
    }
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}
function order_render($id)
{
  $database = new connectDB();
  $sql = "SELECT * FROM order_details WHERE order_id='$id'";
  $result = $database->query($sql);
  $count = 0;
  while($row = mysqli_fetch_array($result)){
    $count++;
    $total_tmp = ($row["price"])*($row["quantity"]);
    $total_str = "";
    while ($total_tmp > 0) {
        $total_str = substr("$total_tmp", -3, 3) . '.' . $total_str;
        $total_tmp = substr("$total_tmp", 0, -3);
    }
    $price = "";
    $price_number = $row["price"];
    while ($price_number > 0) {
        $price = substr("$price_number", -3, 3) . '.' . $price;
        $price_number = substr("$price_number", 0, -3);
    }
    $sql = "SELECT * FROM products WHERE id='".$row["product_id"]."'";
    $result_product = $database->query($sql);
    $product = mysqli_fetch_array($result_product);
    echo "<tr>
          <th scope='row'>$count</th>
          <td>".$product["name"]."</td>
          <td>".trim($price,'.')."&#8363;</td>
          <td>{$row["quantity"]}</td>
          <td>".trim($total_str,'.')."&#8363;</td>
          </tr>";
  }
  echo "<tr>
  <th></th>
  <td></td>
  <td></td>
  <td>Mã Giảm Giá</td>
  <td id='discount_code'>20%</td>
  </tr>
  <tr>
  <th></th>
  <td></td>
  <td></td>
  <td class='total-price'>Thành Tiền</td>
  <td class='total-price' id='price-number'></td>
  </tr>
  <input type='hidden' id='id' value='$id'>";

  $database->close();
}
function order_change_status($id,$status){
  $database = new connectDB();
  $sql = "UPDATE orders SET status_id='$status' WHERE id='$id'";
  $database->execute($sql);
}
