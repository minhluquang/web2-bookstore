
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function role_delete($id)
{
  $date = date('Y-m-d', time());
  global $database;
  $sql = "SELECT * FROM functions WHERE id= ". $id ."";
  $result = $database->query($sql);
  $row = $result->fetch_assoc();

  if ($row != null) {
    $sql = "UPDATE functions
    SET status = ". 0 .", delete_date = '". $date ."' WHERE id = ". $id ."";
  $result = $database->execute($sql);
  if($result) {
    $result = "<span class='success'>Xoá Quyền thành công</span>";
  } else {
    $result = "<span class='failed'>Xoá Quyền không thành công</span>";
  }
  return $result;
  } else {
     return $result = "<span class='failed'>Quyền '. $id .' không tồn tại</span>";
  }
  


}

function role_create($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from functions WHERE name = '" . $field['name'] . "'";

  $result = null;
  $result = $database->query($sql);
  $row = $result->fetch_assoc();
  if ($row == null) {
    $sql = "INSERT INTO functions ( name,status,delete_date , update_date) 
          VALUES ('" . $field['name'] . "','" . 1 . "',NULL, '" . $date  . "') ";
    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Tạo Quyền thành công</span>";
    } else $result = "<span class='failed'>Tạo Quyền không thành công</span>";
    return ($result);
  } else return "<span class='failed'>Quyền" . $row['name'] . " đã tồn tại</span>";
}
function role_edit($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from functions WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = $result->fetch_assoc();
  if ($row != null) {
    
    $sql = "UPDATE functions SET name = ' ". $field['name'] ." ', update_date = '". $date ."' WHERE id = '". $field['id'] ."'";

    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Sửa Quyền thành công</span>";
    } else $result = "<span class='failed'>Sửa Quyền không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Quyền " . $row['id'] . " không tồn tại</span>";
}
