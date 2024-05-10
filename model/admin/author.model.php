
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function author_delete($id)
{
    global $database;

    // Delete rows from author_details table
    $sql = "SELECT * FROM authors WHERE id= ". $id ."";

    $result = $database->query($sql);
    $row = $result->fetch_assoc();

    if ($row != null) {
        $sql = "UPDATE authors
    SET status = ". 0 . " WHERE id = ". $id ."";
         $result = $database->query($sql);

         if($result) {
            $result = "<span class='success'>Xoá tác giả thành công</span>";
          } else {
            $result = "<span class='failed'>Xoá tác giả  không thành công</span>";
          }
          return $result;
          } else {
             return $result = "<span class='failed'>Tác giả  '. $id .' không tồn tại</span>";
          }
}





function getMaximumAuthorId() {
    global $database;

    // Query to get the maximum author ID
    $sql_max_id = "SELECT MAX(id) AS max_id FROM authors";
    $result_max_id = $database->query($sql_max_id);

    if ($result_max_id->num_rows > 0) {
        $row = $result_max_id->fetch_assoc();
        return $row['max_id'];
    }

    return 0; // Return 0 if no ID found
}

// Updated author_create function
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
        return ;
    } else {
        // Lấy ID tác giả lớn nhất
        $maxId = getMaximumAuthorId();

        // Tăng ID lên 1 để tạo ID mới
        $newId = $maxId + 1;

        // Thực hiện thêm tác giả mới với ID mới
        $sql_insert = "INSERT INTO authors (id, name, email, status) VALUES ('$newId', '$name', '$email', '" . 1 . "')";
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
        SET name = '" . $field['name'] . "', email = '" . $field['email'] . "', status = 1 
        WHERE id = " . $field['id'];
        
        $result = $database->execute($sql);
        if ($result) {
          $result = "<span class='success'>Sửa tác giả thành công</span>";
        } else $result = "<span class='failed'>Sửa tác giả không thành công</span>";
    
        return ($result);
      } else return "<span class='failed'>Tác giả " . $row['id'] . " không tồn tại</span>";


}
