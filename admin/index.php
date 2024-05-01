<?php
session_start();
ob_start();
include_once('../model/connect.php');
include_once('../model/admin/pagnation.model.php');
$_SESSION["render"] = new pagnation(5, 1, "products");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="../css/admin/index.css?v=<?php echo time(); ?>">
</head>

<body>
  <div class="topbar">
    <h1>AdmminHub</h1>
    <div class="topbar__admin-info">
      <div class="topbar__admin-info__detail">
        <i class="fa-solid fa-user-shield"></i>
        <h2>Lữ Quang Minh</h2>
      </div>
      <i class="fa-solid fa-caret-down"></i>
      <div class="topbar__admin-info--logout">
        <form action="">
          <input type="submit" value="Đăng xuất" />
        </form>
      </div>
    </div>
  </div>
  <div class="sidebar">
    <div class="sidebar__logo">
      <img src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/fahasa-logo.png" alt="Logo">
    </div>
    <ul class="sidebar__items">
      <li class="sidebar__item <?php
                                if (isset($_GET['page'])) {
                                  if ($_GET['page'] == 'home') echo 'active';
                                } else echo 'active';
                                ?>">
        <a href="?page=home"><i class="fa-solid fa-house"></i>Trang chủ</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'product') echo 'active';
                                ?>">
        <a href="?page=product"><i class="fa-solid fa-book"></i>Sản phẩm</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'order') echo 'active';
                                ?>">
        <a href="?page=order"><i class="fa-solid fa-cart-shopping"></i>Đơn hàng</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'account') echo 'active';
                                ?>">
        <a href="?page=account"><i class="fa-solid fa-user"></i>Thành viên</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'publisher') echo 'active';
                                ?>">
        <a href="?page=publisher"><i class="fa-solid fa-upload"></i></i>Nhà xuất bản</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'author') echo 'active';
                                ?>">
        <a href="?page=author"><i class="fa-solid fa-book-open-reader"></i>Tác giả</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'category') echo 'active';
                                ?>">
        <a href="?page=category"><i class="fa-solid fa-list"></i>Thể loại sách</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'supplier') echo 'active';
                                ?>">
        <a href="?page=supplier"><i class="fa-solid fa-industry"></i>Nhà cung cấp</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'receipt') echo 'active';
                                ?>">
        <a href="?page=receipt"><i class="fa-solid fa-file-invoice"></i>Nhập hàng</a>
      </li>
      <li class="sidebar__item <?php
                                if (isset($_GET['page']))
                                  if ($_GET['page'] == 'role') echo 'active';
                                ?>">
        <a href="?page=role"><i class="fa-solid fa-gavel"></i>Phân quyền</a>
      </li>
    </ul>
    
  </div>
  <div class="container">
    <!-- Render các page tương ứng -->
    <?php
    if (isset($_GET['page']) && $_GET['page'] != '') {
      $page = $_GET['page'];

      switch ($page) {
        case 'home':
          require_once('public/home.php');
          break;
        case 'product':
          require_once('public/product.php');
          break;
        case 'order':
          require_once('public/order.php');
          break;
        case 'account':
          require_once('public/account.php');
          break;
        case 'publisher':
          require_once('public/publisher.php');
          break;
        case 'author': 
          require_once('public/author.php');
          break;
        case 'category': 
          require_once('public/category.php');
          break;
        case 'supplier': 
          require_once('public/supplier.php');
          break;
        case 'role':
          require_once('public/role.php');
          break;
        default:
          // Xử lý trường hợp không khớp với bất kỳ trang nào
          require_once('notFound.php');
          break;
      }
    } else {
      // Trang chủ
      require_once('public/home.php');
    }
    ?>
  </div>
</body>

</html>