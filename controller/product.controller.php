<?php
  include_once('../model/product.php');
  
  if (isset($_POST['currentPage']) && isset($_POST['itemsPerPage'])) {
    $items_per_page = intval($_POST['itemsPerPage']);
    $page = intval($_POST['currentPage']);
    $result = getProductsForPagination($items_per_page, $page);
    if ($result->success) {
      // Render products từ db
      echo '<div class="collection-product-list">';
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
      echo '</div>';  

      // Render buttons
      $total_records = getTotalRecords();
      $total_pages = ceil($total_records / $items_per_page);
      $paginationHTML = '<div class="pagination">';
      
      // Render prev btn
      if ($page > 1) {
        $prev = $page - 1;
        $paginationHTML .= '
          <button class="pagination-btn" data="'.$prev.'">
            <i class="fa-solid fa-angle-left"></i>
          </button>';
      }

      if ($page - 3 >= 1) {
        $paginationHTML .= '<button class="pagination-btn" data="1">1</button>';
        $paginationHTML .= '...';
      }

      // Render btns
      for ($i = 1; $i <= $total_pages; $i++) {
        $isActive = $page == $i ? 'active' : '';
        if ($i < $page + 3 && $i > $page - 3) {
          $paginationHTML .= '<button class="pagination-btn '.$isActive.'" data="' . $i . '">' . $i . '</button>';
        }
      }

      if ($page + 3 <= $total_pages) {
        $paginationHTML .= '...';
        $paginationHTML .= '<button class="pagination-btn" data="' . $total_pages . '">' . $total_pages . '</button>';
      }

      // Render next btn
      if ($page < $total_pages) {
        $next = $page + 1;
        $paginationHTML .= '
          <button class="pagination-btn" data="'.$next.'">
            <i class="fa-solid fa-angle-right"></i>
          </button>';
      }

      $paginationHTML .= '</div>';
      echo $paginationHTML;      

    } else {
      echo $result->message;    
    }
  }
?>