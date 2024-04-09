
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function author_delete($id)
{
    global $database;

    $sql_author = 'DELETE FROM authors WHERE id="' . $id . '"';
    $result_author = $database->query($sql_author);
    $sql_au = 'DELETE FROM author_details WHERE author_id="' . $id . '"';
    $result_au = $database->query($sql_au);

    if ($result_au && $result_author) {
        return (object) array(
            'success' => true,
            'message' => "<span class='success'>Xóa tác giả với mã $id thành công</span>"
        );
    } else {
        $error = "<span class='failed'>Xóa tác giả với mã $id KHÔNG thành công</span>\n";

        if (!$result_au) {
            $error .= "Lỗi khi xử lý bảng author_details\n";
        }

        if (!$result_author) {
            $error .= "Lỗi khi xử lý bảng authors\n";
        }
        return (object) array(
            'success' => false,
            'message' => $error
        );
    }
}




function author_create($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from authors WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row == null) {
    $sql = "INSERT INTO authors (id, name, email) 
          VALUES ('" . $field['id'] . "', '" . $field['name'] . "', '" . $field['email'] . "') ";
    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Tạo tác giả thành công</span>";
    } else $result = "<span class='failed'>Tạo tác giả không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Tác giả" . $row['id'] . " đã tồn tại</span>";
}
function author_edit($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from authors WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row != null) {
    $sql = "UPDATE authors
          SET name= '" . $field['id'] . "', '" . $field['name'] . "', '" . $field['email'] . "' 
        WHERE id=".$field['id'];

    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Sửa tác giả thành công</span>";
    } else $result = "<span class='failed'>Sửa tác giả không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Tác giả " . $row['id'] . " không tồn tại</span>";
}
