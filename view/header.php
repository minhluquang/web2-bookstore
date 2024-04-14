<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>"
    />
    <link rel="stylesheet" href="css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/headerfooter/headerfooter.css?v=<?php echo time(); ?>" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="js/logout.js?v=<?php echo time(); ?>"></script>
  </head>
  <body>
    <header>
      <div class="header">
        <div class="headerLeft">
          <a href="index.php">
            <img
              src="https://cdn0.fahasa.com/skin/frontend/ma_vanese/fahasa/images/fahasa-logo.png"
              alt=""
            />
          </a>
        </div>
        <div class="headerCenter">
          <div class="search-container">
            <div class="input-wrapper">
              <input
                type="text"
                placeholder="Search.."
                name="search"
                id="searchInput"
              />
              <button type="submit" id="searchButton">
                <i class="fa fa-search"></i>
              </button>
            </div>
            <div class="notification">
              <div class="category-section">
                <h2>Thể loại</h2>
                <ul class="categories">
                  <li>Văn học</li>
                  <li>Tâm lý</li>
                  <li>Kinh tế</li>
                  <li>Nuôi dạy con</li>
                  <li>Sách thiếu nhi</li>
                  <li>Giáo khoa</li>
                </ul>
              </div>
              <div class="book-section">
                <div class="books">
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 1"
                    />
                    <p>Cuốn sách 1</p>
                  </div>
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 2"
                    />
                    <p>Cuốn sách 2</p>
                  </div>
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 3"
                    />
                    <p>Cuốn sách 3</p>
                  </div>
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 4"
                    />
                    <p>Cuốn sách 4</p>
                  </div>
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 5"
                    />
                    <p>Cuốn sách 5</p>
                  </div>
                  <div class="book">
                    <img
                      src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20%20alt="
                      alt="Book 6"
                    />
                    <p>Cuốn sách 6</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="headerRight">
          <div class="cart">
            <a href="index.php?page=cart">
              <i class="fa-solid fa-cart-shopping"></i>
              <span >Giỏ hàng</span>
            </a>
          </div>
          <div class="account">
            <i class="fa-solid fa-user"></i>
            <span>
            <?php 
              if (isset($_SESSION['username'])) {
                echo $_SESSION['username'];
              } else {
                echo "Tài khoản";
              }
            ?>
            </span>
            <!-- Đây là bẳng đăng kí,đăng nhập -->
            <?php
              if (!isset($_SESSION['username'])) {
                $isHide = "";
                if (isset($_GET['page']) && $_GET['page'] == 'signup') {
                  $isHide = "hide";
                }

                echo '
                <div class="account-options '.$isHide.'">
                  <a href="index.php?page=signup" class="btnDangNhapAccountOption">Đăng nhập</a>
                  <a href="index.php?page=signup&luachon=dangky" class="btnDangKyAccountOption">Đăng ký</a>
                </div>';
              } else {
                

                echo '
                <div class="account-options">
                  <button class="btnDangXuat">Đăng xuất</button>
                </div>';
              }
            ?>

            <!-- <div class="account-notification">
              <div class="user-info">
                <p>Nguyen Quoc Khanh</p>
              </div>
              <ul class="account-links">
                <li>
                  <a href="#" onclick="showNotification()">Thông tin của tôi</a>
                </li>
                <li><a href="#">Đổi mật khẩu</a></li>
                <li><a href="#">Lịch sử mua hàng</a></li>
                <li><a href="#">Đăng xuất</a></li>
              </ul>
            </div> -->

            <div
              class="overlay"
              id="overlay"
              onclick="hideNotification()"
            ></div>

            <div class="notification-box" id="notificationBox">
              <span class="close-btn" onclick="hideNotification()">x</span>
              <div class="user-info">
                <div class="input-field">
                  <label for="newName">Họ và tên:</label>
                  <input type="text" id="newName" />
                </div>
                <div class="input-field">
                  <label for="newPhone">Số điện thoại:</label>
                  <input type="text" id="newPhone" />
                </div>
                <div class="input-field">
                  <label for="newAddress">Địa chỉ:</label>
                  <input type="text" id="newAddress" />
                </div>
              </div>
              <button class="save-btn" onclick="saveInfo()">Lưu</button>
            </div>
          </div>
        </div>
      </div>
    </header>
  </body>
</html>
