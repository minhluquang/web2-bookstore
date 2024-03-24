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