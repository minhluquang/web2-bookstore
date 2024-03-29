<?php
  include_once('model/product_detail.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="css/product_detail/product_detail.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="css/product_detail/product_detail.reponsive.css?v=<?php echo time(); ?>" />
    <script defer src="js/product_detail.js?v=<?php echo time(); ?>"></script>
  </head>
  <body>
    <!-- Start: Detail product -->
    <div class="modal">
      <div class="prev_page">
        <a href="?page=product">
          <i class="fa-solid fa-left-long"></i>Trở về
        </a>
      </div>
      <div class="modal-container">
        <div class="modal-content">
          <div class="modal-content__model-left">
            <img
              src=<?=$row['image_path']?>
              alt=""
            />
          </div>
          <div class="modal-content__model-right">
            <h2 class="modal-title"><?=$row['product_name']?></h2>
            <div class="modal-detail">
              <p class="modal-author">Tác giả: <strong><?=$row['author_names']?></strong></p>
              <p class="modal-category">Thể loại: <strong><?=$row['category_names']?></strong></p>
            </div>
            <h4 class="modal-publisher">Nhà xuất bản: <strong><?=$row['publisher_name']?></strong></h4>
            <span class="modal-price"><p>Giá: </p><?php echo number_format($row['price'], 0, ',', '.').'đ'?></span>
            <div class="modal-qnt">
              <div class="modal-qnt-select">
                <input type="button" value="-" class="modal-qnt__descrease" />
                <input
                  type="text"
                  value="1"
                  class="modal-qnt__value"
                  readonly
                />
                <input type="button" value="+" class="modal-qnt__increase" />
              </div>
              <div class="modal-qnt-number"><?php 
                if ($row['quantity'] > 0) {
                  echo "(Còn ".$row['quantity']." sản phẩm)";
                } else {
                  echo "(Hết hàng)";
                }
              ?></div>
            </div>
            <button class="modal-btn">Thêm vào giỏ</button>
          </div>
        </div>
      </div>
    </div>
    <!-- End: Detail product -->
  </body>
</html>
