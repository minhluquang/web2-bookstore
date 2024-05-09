
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function publisher_delete($id)
{
  global $database;
  $sql_product = "SELECT * FROM products WHERE publisher_id=$id";
  $result_product = $database->query($sql_product);
    if(mysqli_num_rows($result_product) > 0) {
        $error = "<span class='failed'>Xóa nhà xuất bản với mã $id KHÔNG thành công do có ràng buộc với bảng Products</span>\n";
        return (object) array(
            'success' => false,
            'message' => $error
          );
    }
  $sql_cat = 'DELETE FROM publishers WHERE id="' . $id . '"';
  $result_cat = $database->query($sql_cat);
  if ($result_cat) {
    return (object) array(
      'success' => true,
      'message' => "<span class='success'>Xóa nhà xuất bản với mã $id thành công</span>"
    );
  } else {
    $error = "<span class='failed'>Xóa nhà xuất bản với mã $id KHÔNG thành công</span>\n";
    if (!$result_cat) {
      $error += "Lỗi khi xử lý bảng publishers\n";
    }
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}

function publisher_create($field)
{
  global $database;
  $sql = "SELECT * from publishers WHERE name = '" . $field['name'] . "'";

  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row == null) {
    $sql = "INSERT INTO publishers ( name, email) 
          VALUES ('" . $field['name'] . "', '" . $field['email']  . "') ";
    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Tạo thể loại thành công</span>";
    } else $result = "<span class='failed'>Tạo thể loại không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Thể loại" . $row['name'] . " đã tồn tại</span>";
}
function account_edit($field)
{
    global $database;
    $username = mysqli_real_escape_string($database->conn, $field['username']);
    $role = mysqli_real_escape_string($database->conn, $field['role']);
    $status = $field['status'] == "active" ? 1 : 0;

    // Query to check if the account exists
    $sql_select = "SELECT * FROM accounts WHERE username = '$username'";
    $result_select = $database->query($sql_select);

    if ($result_select && $result_select->num_rows > 0) {
        // Account exists, perform the update
        $sql_update = "UPDATE accounts SET role_id = '$role', status = '$status' WHERE username = '$username'";
        $result_update = $database->query($sql_update);

        if ($result_update) {
            return "<span class='success'>Sửa tài khoản thành công</span>";
        } else {
            return "<span class='failed'>Sửa tài khoản không thành công</span>";
        }
    } else {
        // Account does not exist
        return "<span class='failed'>Tài khoản $username không tồn tại</span>";
    }
}

function passEdit($field) {
  global $database;
  $username = $field['username'];
  $sql_select = "SELECT * FROM accounts WHERE username = '$username'";
  $result = mysqli_fetch_array($database->query($sql_select));

  $userOldPass = $field['currentPassword'];
  $database_pass =  $result['password'];

  if(!password_verify($userOldPass,$database_pass)) {
    return "<span class='failed'>Sai mật khẩu hiện tại !</span>";
  }
  $newPass = $field['NewPassword'];
  $newPass_hash = password_hash($newPass,PASSWORD_DEFAULT);

  $sql_update = "UPDATE accounts SET password = '$newPass_hash' WHERE username ='$username'"; 

  $result_update = $database -> query($sql_update);

  if ($result_update) {
    return "<span class='success'>Thay đổi mật khẩu thành công</span>";
} else {
    return "<span class='failed'>Thay đổi mật khẩu thất bại</span>";
}
}
