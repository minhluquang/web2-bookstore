
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function category_delete($id)
{
  global $database;
  $sql_cat = 'DELETE FROM categories WHERE id="' . $id . '"';
  $result_cat = $database->query($sql_cat);
  $sql_cat_Detail = 'DELETE FROM category_details WHERE category_id="' . $id . '"';
  $result_cat_Detail = $database->query($sql_cat_Detail);

  
  if ($result_cat && $result_cat_Detail) {
    return (object) array(
      'success' => true,
      'message' => "<span class='success'>Xóa thể loại với mã $id thành công</span>"
    );
  } else {
    $error = "<span class='failed'>Xóa thể loại với mã $id KHÔNG thành công</span>\n";
    if (!$result_cat) {
      $error += "Lỗi khi xử lý bảng categories\n";
    }
    
    if (!$result_cat_Detail) {
      $error += "Lỗi khi xử lý bảng category_details\n";
    }
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}

function category_create($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from categories WHERE name = '" . $field['name'] . "'";

  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row == null) {
    $sql = "INSERT INTO categories ( name, create_date, update_date) 
          VALUES ('" . $field['name'] . "', '" . $date  . "', '" . $date  . "') ";
    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Tạo thể loại thành công</span>";
    } else $result = "<span class='failed'>Tạo thể loại không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Thể loại" . $row['name'] . " đã tồn tại</span>";
}
function category_edit($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from categories WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row != null) {
    $sql = "UPDATE categories
          SET name= '" . $field['name'] . "',update_date= '" . $date  .  "' 
        WHERE id=".$field['id'];

    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Sửa thể loại thành công</span>";
    } else $result = "<span class='failed'>Sửa thể loại không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Thể loại " . $row['id'] . " không tồn tại</span>";
}
