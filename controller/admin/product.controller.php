<?php

include_once('../../model/admin/product.model.php');


if (isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $delete_result = product_delete($id);
  echo $delete_result->message;
}
if (!isset($_POST['delete_id'])) {
  $ds = DIRECTORY_SEPARATOR;
  $base_dir = realpath(dirname(__FILE__)  . $ds . '..'. $ds . '..'. $ds . 'model') . $ds;
  include_once("{$base_dir}connect.php");
  $conn = connectDB();

  $sql = 'SELECT * FROM `products`';
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_array($result)) {
    // masp
    echo '<tr>
      <td class="id">' . $row[0] . '</td>';
    // img
    echo '<td class="image">
      <img src="../' . $row[3] . '" alt="image not found" />';
    //name
    echo '<td class="name">' . $row[1] . '</td>';
    //catagory
    $cat_sql = "SELECT name  FROM `categories` WHERE id IN (SELECT category_id  FROM `category_details` WHERE product_id = '" . $row[0] . "')";
    $cat_result = mysqli_query($conn, $cat_sql);

    echo '<td class="type">';
    $category = mysqli_fetch_array($cat_result);
    if ($category) echo "$category[0]";
    while ($category = mysqli_fetch_array($cat_result)) echo ", $category[0]";
    echo '</td>';
    // date
    echo '<td class="date-update">14/11/2023</td>
      <td class="date-creat">14/11/2023</td>';
    //price and amount
    echo '<td class="price">' . $row[4] . '</td>
          <td class="amount">' . $row[5] . '</td>';
    // button
    echo '<td class="actions ">
      <button class="actions--edit" >Sửa</button>
      <button class="actions--delete" >Xoá</button>
      </td>';
    echo '</tr>';
  }
  mysqli_close($conn);
}
