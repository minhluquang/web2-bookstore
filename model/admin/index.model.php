<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;
include_once("{$base_dir}connect.php");

function getRoleIdByUsernameModel($username)
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT *
              FROM accounts
              WHERE username = '$username'";
    $result = $database->query($sql);
    $database->close();
    return $result;
  } else {
    $database->close();
    return false;
  }
}

function getTotalIncome()
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT SUM(o.total_price) AS total_income FROM orders o WHERE o.status_id = 5";
    $result = $database->query($sql);
    $database->close();
    return $result;
  } else {
    $database->close();
    return false;
  }
}

function getTotalOrders()
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT COUNT(id) AS order_count FROM orders";
    $result = $database->query($sql);
    $database->close();
    return $result;
  } else {
    $database->close();
    return false;
  }
}

function getTotalProducts()
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT COUNT(id) AS product_count FROM products";
    $result = $database->query($sql);
    $database->close();
    return $result;
  } else {
    $database->close();
    return false;
  }
}

function getTotalAccounts()
{
  $database = new connectDB();
  if ($database->conn) {
    $sql = "SELECT COUNT(username) AS member_count FROM accounts";
    $result = $database->query($sql);
    $database->close();
    return $result;
  } else {
    $database->close();
    return false;
  }
}
function getStats($date_start, $date_end)
{
  $database = new connectDB();
  $sql = 'SELECT * FROM categories';
  $result = $database->query($sql);
  $total = 0;
  while ($row = mysqli_fetch_array($result)) {
    echo '<div class="thongke">';
    echo '<h3 class="sanpham" >' . $row['name'] . '</h3>';
    $sql = "SELECT 
    p.id AS product_id,
    p.name,
    o.id,
    od.quantity,
    p.price AS original_price,
    CASE 
        WHEN d.type = 'PR' THEN p.price - (p.price * d.discount_value / 100)
        WHEN d.type = 'AR' THEN p.price - (d.discount_value / SUM(od.quantity) OVER (PARTITION BY od.order_id))
        ELSE p.price
    END AS discounted_price,
    SUM(od.quantity) OVER (PARTITION BY od.order_id) as sum
    FROM 
        products p
    INNER JOIN 
        category_details cd ON p.id = cd.product_id
    INNER JOIN 
        order_details od ON p.id = od.product_id
    INNER JOIN 
        orders o ON od.order_id = o.id
    LEFT JOIN 
        discounts d ON o.discount_code = d.discount_code
    WHERE 
    cd.category_id = '" . $row["id"] . "' and o.status_id = 5 and o.date_create between '$date_start' and DATE_ADD('$date_end',INTERVAL 0 DAY)
    ORDER BY p.id ASC";
    $detail_result = $database->query($sql);
    $sum = 0;
    $quantity = 0;
    while ($detail = mysqli_fetch_array($detail_result)) {
      $sum += $detail["discounted_price"] * $detail["quantity"];
      $quantity += $detail["quantity"];
    }
    $total += $sum;
    echo '<div class="money"> ' . $sum . ' VND</div>
          <div class="soluong">Số lượng bán được: ' . $quantity . '</div>
          <button type="button" class="chitietbtn" data-id="' . $row['id'] . '">Chi tiết</button>
          </div>';
  }

  $database->close();
}
function searchForValue($id, $array,$str) {
  foreach ($array as $key => $val) {
      if ($val[$str] == $id) {
          return $key;
      }
  }
  return -1;
}
function getStatDetails($id, $date_start, $date_end,$order,$type)
{
  $database = new connectDB();
  $sql = "SELECT 
        p.id AS product_id,
        p.name,
        p.image_path,
        o.id,
        od.quantity,
        p.price AS original_price,
        CASE 
            WHEN d.type = 'PR' THEN p.price - (p.price * d.discount_value / 100)
            WHEN d.type = 'AR' THEN p.price - (d.discount_value / SUM(od.quantity) OVER (PARTITION BY od.order_id))
            ELSE p.price
        END AS discounted_price,
        SUM(od.quantity) OVER (PARTITION BY od.order_id) as sum
        FROM 
            products p
        INNER JOIN 
            category_details cd ON p.id = cd.product_id
        INNER JOIN 
            order_details od ON p.id = od.product_id
        INNER JOIN 
            orders o ON od.order_id = o.id
        LEFT JOIN 
            discounts d ON o.discount_code = d.discount_code
        WHERE 
        cd.category_id = ' $id ' and o.status_id = 5 and o.date_create between '$date_start' and DATE_ADD('$date_end',INTERVAL 0 DAY)
        ORDER BY p.id ASC";
  $detail_result = $database->query($sql);
  $sum = 0;
  $quantity = 0;
  $arr = array();
  while ($detail = mysqli_fetch_array($detail_result)) {
    $key = searchForValue($detail["product_id"],$arr,"id");
    if ($key!=-1) {
      $arr[$key]["total"] += $detail["discounted_price"] * $detail["quantity"];
      $arr[$key]["quantity"] += $detail["quantity"];
    } else $arr[] = 
    array(
      "id"=>$detail["product_id"],
      "img"=>$detail["image_path"], 
      "name"=>$detail["name"], 
      "price"=>$detail["original_price"], 
      "total"=>$detail["discounted_price"] * $detail["quantity"], 
      "quantity"=>$detail["quantity"]);
    $sum += $detail["discounted_price"] * $detail["quantity"];
    $quantity += $detail["quantity"];
  }
  if(count($arr)<1){
    echo "<div id='zero-item'><h2>Không bán được sản phẩm nào</h2></div>";
    return ;
  }
  echo '
  <table id="content-product">
  <thead class="menu">
      <tr>
          <th data-order="id">Mã SP <i class="fas fa-sort-up ASC hidden"></i> <i class="fas fa-sort-down DESC hidden"></i></th>
          <th>Ảnh</th> <th data-order="name">Tên Sản Phẩm <i class="fas fa-sort-up ASC hidden"></i> <i class="fas fa-sort-down DESC hidden"></i></th>
          <th data-order="price">Giá <i class="fas fa-sort-up ASC hidden"></i> <i class="fas fa-sort-down DESC hidden"></i></th>
          <th data-order="total">Tổng doanh thu <i class="fas fa-sort-up ASC hidden"></i> <i class="fas fa-sort-down DESC hidden"></th>
          <th data-order="quantity">Số lượng <i class="fas fa-sort-up ASC hidden"></i> <i class="fas fa-sort-down DESC hidden"></i></th>
      </tr>
  </thead>
    <tbody class="table-content" id="content">';
    $key_values = array_column($arr, $order); 
    if($type=="ASC")array_multisort($key_values, SORT_ASC, $arr);
    else if($type=="DESC")array_multisort($key_values, SORT_DESC, $arr);
  foreach ($arr as $value) {
    echo '<tr>
    <td class="id">' . $value["id"] . '</td>
    <td class="image">
        <img src="../' . $value["img"] . '" alt="image not found">
    </td>
    <td class="name">' . $value["name"] . '</td>
    <td class="price">' . $value["price"] . '</td>
    <td class="total">' . $value["total"] . '</td>
    <td class="amount">' . $value["quantity"] . '</td>
</tr>';
  }
  echo '<tr><td></td><td></td><td></td><td></td><td>' . $sum . '</td><td>' . $quantity . '</td></tr>;';
  echo '</tbody></table>';
  echo print_r($arr);
  $database->close();
}
