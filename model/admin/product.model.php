
<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");
$database = new connectDB();
function product_delete($id)
{
  global $database;
  $sql_cat = 'DELETE FROM category_details WHERE product_id="' . $id . '"';
  $result_cat = $database->query($sql_cat);
  $sql_au = 'DELETE FROM author_details WHERE product_id="' . $id . '"';
  $result_au = $database->query($sql_au);
  $sql_receipt = 'DELETE FROM goodsreceipt_details WHERE product_id="' . $id . '"';
  $result_receipt = $database->query($sql_receipt);
  $sql_order = 'DELETE FROM order_details WHERE product_id="' . $id . '"';
  $result_order = $database->query($sql_order);
  $sql_product = 'DELETE FROM products WHERE id="' . $id . '"';
  $result_product = $database->query($sql_product);

  if ($result_cat && $result_au && $result_receipt && $result_order && $result_product) {
    return (object) array(
      'success' => true,
      'message' => "<span class='success'>Xóa sản phẩm với mã $id thành công</span>"
    );
  } else {
    $error = "<span class='failed'>Xóa sản phẩm với mã $id KHÔNG thành công</span>\n";
    if (!$result_cat) {
      $error += "Lỗi khi xử lý bảng category_details\n";
    }
    if (!$result_au) {
      $error += "Lỗi khi xử lý bảng author_details\n";
    }
    if (!$result_receipt) {
      $error += "Lỗi khi xử lý bảng goodsreceipt_details\n";
    }
    if (!$result_order) {
      $error += "Lỗi khi xử lý bảng order_details\n";
    }
    if (!$result_product) {
      $error += "Lỗi khi xử lý bảng products\n";
    }
    return (object) array(
      'success' => false,
      'message' => $error
    );
  }
}
function product_getCategories()
{
  global $database;
  $sql = 'SELECT * FROM categories';
  $result = $database->query($sql);
  $ans = "<option value=''>Chọn thể loại</option>";
  while ($row = mysqli_fetch_array($result)) {
    $ans = $ans . "<option value=" . $row["id"] . ">" . $row["name"] . "</option>\n";
  }
  return $ans;
}
function product_getAuthors()
{
  global $database;
  $sql = 'SELECT * FROM authors';
  $result = $database->query($sql);
  $ans = "<option value=''>Chọn tác giả</option>";
  while ($row = mysqli_fetch_array($result)) {
    $ans = $ans . "<option value=" . $row["id"] . ">" . $row["name"] . "</option>\n";
  }
  return $ans;
}
function product_getPublishers()
{
  global $database;
  $sql = 'SELECT * FROM publishers';
  $result = $database->query($sql);
  $ans = "<option value=''>Chọn nhà xuất bản</option>";
  while ($row = mysqli_fetch_array($result)) {
    $ans = $ans . "<option value=" . $row["id"] . ">" . $row["name"] . "</option>\n";
  }
  return $ans;
}
function product_create($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from products WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row == null) {
    $sql = "INSERT INTO products (id, name, publisher_id, image_path, create_date, update_date, price, quantity) 
          VALUES ('" . $field['id'] . "', '" . $field['name'] . "', '" . $field['publisher_id'] . "', '" . $field['image_path'] .
      "', '" . $date  . "', '" . $date  . "', '" . $field['price'] . "', '" . $field['quantity'] . "') ";
    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Tạo sản phẩm thành công</span>";
    } else $result = "<span class='failed'>Tạo sản phẩm không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Sản phẩm" . $row['id'] . " đã tồn tại</span>";
}
function product_edit($field)
{
  global $database;
  date_default_timezone_set('Asia/Ho_Chi_Minh');
  $date = date('Y-m-d', time());
  $sql = "SELECT * from products WHERE id = " . $field['id'] . "";
  $result = null;
  $result = $database->query($sql);
  $row = mysqli_fetch_array($result);
  if ($row != null) {
    $sql = "UPDATE products
          SET name= '" . $field['name'] . "',publisher_id= '" . $field['publisher_id'] . "',image_path= '" . $field['image_path'] .
          "',update_date= '" . $date  . "',price= '" . $field['price'] . "',quantity= '" . $field['quantity'] . "' 
        WHERE id=".$field['id'];

    $result = $database->execute($sql);
    if ($result) {
      $result = "<span class='success'>Sửa sản phẩm thành công</span>";
    } else $result = "<span class='failed'>Sửa sản phẩm không thành công</span>";

    return ($result);
  } else return "<span class='failed'>Sản phẩm " . $row['id'] . " không tồn tại</span>";
}
