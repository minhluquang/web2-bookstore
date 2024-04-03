<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/fonts/fonts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pageHome/pageHome.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/pageHome/pageHome.reponsive.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="silder-01">
            <div class="left-sider">
                <a href="#"><img src="assets/image/pageHome/img1.jpg" alt=""></a>
            </div>
            <div class="right-slider">
                <a href="#"><img src="assets//image//pageHome/img2.png" alt=""></a>
                <a href="#"><img src="assets/image/pageHome/img3.jpg" alt=""></a>
            </div>
        </div>

        <div class="silder-02">
            <a href="#"><img src="assets/image/pageHome/img4.jpg" alt=""></a>
            <a href="#"><img src="assets/image/pageHome/img5.png" alt=""></a>
            <a href="#"><img src="assets/image/pageHome/img6.jpg" alt=""></a>
            <a href="#"><img src="assets/image/pageHome/img7.png" alt=""></a>
        </div>

        <!-- NỘI DUNG BÁN HÀNG -->
        <?php
            include_once('controller/category.controller.php');
            include_once('controller/product.controller.php');
            echo $_SESSION['username'];
            $categories = getCategoryList();
            foreach ($categories as $category) {
                echo '
                <div class="genre">
                    <div class="genre-name">'.$category['name'].'</div>
                <div class="product-list">';

                $products = getProductsByIdCategory($category['id']);
                $index = 0;
                foreach ($products as $product) {
                    if ($index == 5) break;
                    $index++;
                    $price_formatted = number_format($product['price'], '0', ',', '.').'đ';
                    echo '
                    <div class="product">
                        <img src="'.$product['image_path'].'" alt="">
                        <span class="name-product">'.$product['product_name'].'</span>
                        <span class="price">'. $price_formatted.'</span>
                    </div>';
                }
                echo '
                    </div>
                    <div class="see-more" >
                        <a class="see-more-btn">Xem thêm </a>
                    </div>
                </div>';
            }
        ?>
        <!-- END -->
    </div>
</body>
</html>