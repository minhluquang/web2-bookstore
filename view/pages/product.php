<?php
  // include_once('model/product.php');
  $items_per_page = 8;
  $current_page = 1;
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

        <div class="result">
          // Gonna render products here

          <!-- Start: Pagination -->
          <div class="pagination">
            
           
          </div>
          <!-- End: Pagination -->
        </div>
      </div>
      <!-- End: Main collection -->
    </div>
    <!-- End: Collection section -->
  </div>

  <script>
    $(document).ready(function() {
      // Hàm để render dữ liệu sản phẩm
      function renderProductsPerPage(current_page) {
        var items_per_page = <?php echo $items_per_page ?>;

        $.ajax({
          url: 'controller/product.controller.php',
          type: 'post',
          dataType: 'html',
          data: {
            itemsPerPage: items_per_page,
            currentPage: current_page
          }
        }).done(function(result) {
          $('.result').html(result);
        })
      }

      // Tự loadd sản phẩm ở lần đầu vào trang
      renderProductsPerPage(1);
      // $('.pagination-btn[data="1"]').addClass('active');

   
      // Sử dụng Event Delegation cho các nút phân trang
      $(document).on('click', '.pagination-btn', function() {
        // Remove all active, active current pagination-btn 
        $('.pagination-btn').removeClass('active');
        $(this).addClass('active');

        var current_page = $(this).attr('data');
        renderProductsPerPage(current_page);
      });
    });
  </script>
</body>

</html>