<?php

include_once('../../model/admin/order.model.php');


if (isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $delete_result = order_delete($id);
  echo $delete_result-> message;
}
if(!isset($_POST['delete_id'])){
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..'. $ds . '..'. $ds . 'model') . $ds;
  include_once("{$base_dir}connect.php");
  $conn = connectDB();
  $sql = 'SELECT * from orders';
  $result = mysqli_query($conn, $sql);


  while ($row = mysqli_fetch_array($result)) {
      echo '<tr>';
      echo '<td class="order_id" id="order_id'.$row[0].'">' . $row[0] . '</td>';
      echo '<td class="customer_id">' . $row[1] . '</td>';
      echo '<td class="staff_id">' . $row[2] . '</td>';
      echo '<td class="date-update">' . $row[4] . '</td>';
      echo '<td class="total_price">' . $row[5] . '</td>';
      $sql_address = 'SELECT * from delivery_infoes WHERE id="' . $row[3] . '"';
      $result_address = mysqli_query($conn, $sql_address);
      $row_address = mysqli_fetch_array($result_address);

      echo '<td class="address">' . $row_address['address'] . '</td>';

      $sql_status = 'SELECT * from order_statuses WHERE id="' . $row[6] . '"';
      $result_status  = mysqli_query($conn, $sql_status);
      $row_status = mysqli_fetch_array($result_status);

      echo '<td class="status">' . $row_status['name'] . '</td>';
      echo '<td class="discount_code">' . $row[7] . '</td>';
      echo '<td class="actions">
      <button class="actions--view">Chi tiết hoá đơn</button>
      <button class="actions--delete">Xoá</button>
      </td>
      </tr>';
  }
  mysqli_close($conn);

}
