<?php

if (isset($_POST['delete_id'])) {
  $id = $_POST['delete_id'];
  $delete_result = product_delete($id);
  echo $delete_result->message;
}