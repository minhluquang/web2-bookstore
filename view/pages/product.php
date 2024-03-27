<?php
  if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    echo $productId;
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sản phẩm</title>
  <link rel="stylesheet" href="assets/fontawesome-free-6.5.1-web/css/all.min.css" />
  <link rel="stylesheet" href="css/fonts/fonts.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="css/product/product.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="css/product/product.reponsive.css?v=<?php echo time(); ?>" />
  <script defer src="js/product.js?v=<?php echo time(); ?>"></script>
</head>

<body>
  <div class="container">
    <!-- Start: Banner section -->
    <div class="banner-section">
      <img src="assets/images/thumbnail/banner-col.webp" alt="banner-col" />
    </div>
    <!-- End: Banner section -->

    <!-- Start: Collection section -->
    <div class="collection-section">
      <!-- Start: Sidebar items -->
      <div class="sidebar-items">
        <div class="sidebar-item">
          <h2 class="sidebar-item__title">Quốc gia</h2>
          <ul class="sidebar-item__list">
            <li>
              <input type="checkbox" id="quocgia_vietnam" /><label for="quocgia_vietnam">Việt Nam</label>
            </li>
            <li>
              <input type="checkbox" id="quocgia_trungquoc" /><label for="quocgia_trungquoc">Trung Quốc</label>
            </li>
          </ul>
        </div>
        <div class="sidebar-item">
          <h2 class="sidebar-item__title">Giá bán</h2>
          <ul class="sidebar-item__list">
            <li>
              <input type="radio" name="giaban" id="giaban_duoi100" /><label for="giaban_duoi100">Dưới 50,000đ</label>
            </li>
            <li>
              <input type="radio" name="giaban" id="giaban_tu50duoi100" /><label for="giaban_tu50duoi100">50,000đ - 100,000đ</label>
            </li>
            <li>
              <input type="radio" name="giaban" id="giaban_tu100duoi200" /><label for="giaban_tu100duoi200">100,000đ - 200,000đ</label>
            </li>
            <li>
              <input type="radio" name="giaban" id="giaban_tren200" /><label for="giaban_tren200">Trên 200,000đ</label>
            </li>
          </ul>
        </div>
      </div>
      <!-- End: Sidebar items -->

      <!-- Start: Main collection -->
      <div class="main-collection">
        <div class="collection-top-bar">
          <h1 class="top-bar__title">NGÔN TÌNH</h1>
          <div class="top-bar__sort">
            <label for="">Sắp xếp: </label>
            <ul class="top-bar__sort-filter">
              <li><a href="?sortby=manual">Mặc định</a></li>
              <li><a href="?sortby=(price:product:asc)">Giá: Tăng dần</a></li>
              <li>
                <a href="?sortby=(price:product:desc)">Giá: Giảm dần</a>
              </li>
              <li><a href="?sortby=(title:product:asc)">A-Z</a></li>
              <li><a href="?sortby=(price:product:desc)">Z-A</a></li>
            </ul>
          </div>

          <div class="top-bar__sort--reponsive">
            <label for="">Sắp xếp: </label>
            <div class="top-bar__sort-filter--reponsive">
              <select name="" id="" class="sort-filter__select">
                <option value="manual" selected>Mặc định</option>
                <option value="(price:product:asc)">Giá: Tăng dần</option>
                <option value="(price:product:desc)">Giá: Giảm dần</option>
                <option value="(title:product:asc)">A-Z</option>
                <option value="(title:product:desc)">Z-A</option>
              </select>
            </div>
          </div>
        </div>
        <div class="collection-product-list">
          <?php
          $conn = connectDB();
          $query = "SELECT * 
                      FROM products
                      ORDER BY id ASC
                      LIMIT 8 OFFSET 0;";
          $result = mysqli_query($conn, $query);
          while ($row = mysqli_fetch_array($result)) {
            $formatted_number = number_format($row['price'], 0, ',', '.') . 'đ';

            echo '
                  <div class="product-item--wrapper">
                  <div class="product-item">
                    <div class="product-img">
                      <div class="product-action">
                        <div class="product-action--wrapper">
                          <form action="" method="post">
                            <input type="hidden" name="product_id" value="' . $row['id'] . '">
                            <input type="submit" class="product-action--btn product-action__detail" value="Chi tiết"/>
                            <input
                              type="submit"
                              class="product-action--btn product-action__addToCart"
                              value="Thêm vào giỏ"
                            />
                          </form>
                        </div>
                      </div>
                      <a href="" class="img-resize">
                        <img
                        src="' . $row['image_path'] . '"
                        alt="' . $row['name'] . '" />
                      </a>
                    </div>
                    <div class="product-detail">
                      <a href="" class="product-title"
                        >' . $row['name'] . '
                        <p class="product-price">' . $formatted_number . '</p>
                      </a>
                    </div>
                  </div>
                </div>
              ';
          }
          ?>
        </div>

        <!-- Start: Pagination -->
        <div class="pagination">
          <button class="pagination-btn">
            <i class="fa-solid fa-angle-left"></i>
          </button>
          <button class="pagination-btn active" data="1">1</button>
          <button class="pagination-btn" data="2">2</button>
          <button class="pagination-btn" data="3">3</button>
          <button class="pagination-btn" data="4">4</button>
          <button class="pagination-btn" data="5">5</button>
          <button class="pagination-btn">
            <i class="fa-solid fa-angle-right"></i>
          </button>
        </div>
        <!-- End: Pagination -->
      </div>
      <!-- End: Main collection -->
    </div>
    <!-- End: Collection section -->
  </div>

  
</body>

</html>