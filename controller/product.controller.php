<?php
  include_once('../model/product.php');
  
  if (isset($_POST['currentPage']) && isset($_POST['itemsPerPage'])) {
    $item_per_page = intval($_POST['itemsPerPage']);
    $page = intval($_POST['currentPage']);
    $result = getProductsForPagination($item_per_page, $page);
    if ($result->success) {
      while ($row = mysqli_fetch_array($result->data)) {
        $formatted_number = number_format($row['price'], 0, ',', '.') . 'đ';

        echo '
              <div class="product-item--wrapper">
              <div class="product-item">
                <div class="product-img">
                  <div class="product-action">
                    <div class="product-action--wrapper">
                      <form action="index.php?page=product_detail" method="post">
                        <input type="hidden" name="product_id" value="' . $row['id'] . '">
                        <input type="submit" class="product-action--btn product-action__detail" value="Chi tiết"/>
                      </form>
                      <form>
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
                  <a href="">
                    <p class="product-title">' . $row['name'] . '</p>
                    <p class="product-price">' . $formatted_number . '</p>
                  </a>
                </div>
              </div>
            </div>
          ';
      }
    } else {
      echo $result->message;    
    }
  }
?>