<?php
include_once('../../model/connect.php');
include_once('../../model/admin/product.model.php');

if (isset($_POST['function'])) {
  $function = $_POST['function'];
  switch ($function) {
    case 'delete':
      delete();
      break;
    case 'getCategories':
      getCategories();
      break;
  }
}
function delete()
{
  if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $delete_result = product_delete($id);
    echo $delete_result->message;
  }
}
function getCategories()
{
  echo product_getCategories();
}
