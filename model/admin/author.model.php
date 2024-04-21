
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function author_delete($id)
{
    global $database;

    // Delete rows from author_details table
    $sql_delete_au = 'DELETE FROM author_details WHERE author_id = "' . $id . '"';
    $result_delete_au = $database->query($sql_delete_au);

    if ($result_delete_au !== false) {
        // Proceed with deleting the author from the authors table
        $sql_author = 'DELETE FROM authors WHERE id = "' . $id . '"';
        $result_author = $database->query($sql_author);

        if ($result_author !== false) {
            return (object) array(
                'success' => true,
                'message' => "<span class='success'>Xóa tác giả với mã $id thành công</span>"
            );
        } else {
            return (object) array(
                'success' => false,
                'message' => "<span class='failed'>Xóa tác giả với mã $id KHÔNG thành công - Lỗi khi xử lý bảng authors</span>\n"
            );
        }
    } else {
        return (object) array(
            'success' => false,
            'message' => "<span class='failed'>Xóa tác giả với mã $id KHÔNG thành công - Lỗi khi xử lý bảng author_details</span>\n"
        );
    }
}





function author_create($field)
{
    global $database;

    // Lấy giá trị từ mảng $field
    $name = $field['name'];
    $email = $field['email'];

    // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
    $sql_check = "SELECT * FROM authors WHERE email = '$email'";
    $result_check = $database->query($sql_check);

    if ($result_check->num_rows > 0) {
        return "<span class='failed'>Tác giả với email $email đã tồn tại</span>";
    } else {
        // Thực hiện thêm tác giả mới
        $sql_insert = "INSERT INTO authors (name, email) VALUES ('$name', '$email')";
        $result_insert = $database->query($sql_insert);
        
        if ($result_insert) {
            return "<span class='success'>Tạo tác giả thành công</span>";
        } else {
            return "<span class='failed'>Tạo tác giả không thành công</span>";
        }
    }
}





function author_edit($field) {
    global $database; // Sử dụng biến global $database trong hàm này
    $sql = "SELECT * from authors WHERE id = " . $field['id'] . "";
    $result = null;
    $result = $database->query($sql);
    $row = mysqli_fetch_array($result);
    if ($row != null) {
        $sql = "UPDATE authors
              SET name= '" . $field['name'] . "',email= '" . $field['email'] . "' 
            WHERE id=".$field['id'];
        
        $result = $database->execute($sql);
        if ($result) {
          $result = "<span class='success'>Sửa tác giả thành công</span>";
        } else $result = "<span class='failed'>Sửa tác giả không thành công</span>";
    
        return ($result);
      } else return "<span class='failed'>Tác giả " . $row['id'] . " không tồn tại</span>";


}
