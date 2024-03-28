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

        <!-- THỂ LOẠI 1 -->
        <?php
            include_once('model/category.php');
            include_once('model/product.php');
            $categoryList = getCategoryList();
            while ($row = mysqli_fetch_array($categoryList)) {
                echo '
                <div class="genre">
                    <div class="genre-name">'.$row['name'].'</div>
                    <div class="product-list">';
                
                $productList = getProductsById($row['id']);
                $count = 0;
                while (($row_product = mysqli_fetch_array($productList)) && ($count < 5)) {
                    $count++;

                    $price_formatted = number_format($row_product['price'], '0', ',', '.').'đ';
                    echo '<div class="product">
                        <img src="'.$row_product['image_path'].'" alt="">
                        <span class="name-product">'.$row_product['product_name'].'</span>
                        <span class="price">'. $price_formatted.'</span>
                    </div>';
                }
                
                echo '
                    </div>
                    <div  class="see-more" >
                    <a href="#">Xem thêm </a>
                    </div>
                </div>';
            }
        ?>
        
        
        <!-- END -->

        <!-- THỂ LOẠI 2 -->
        <!-- <div class="genre">
            <div class="genre-name">Huyền Bí - Giả Tưởng - Kinh Dị</div>
            <div class="product-list">
                <div class="product">
                    <img src="assets/image/pageHome/huyền bí/img1.jpg" alt="">

                    <span class="name-product">Sĩ Số Lớp Vắng 0</span>
                    <span class="price">74.460 đ</span>
                    <span class="old-price">66.880 đ</span>

                </div>
                <div class="product">
                    <img src="assets/image/pageHome/huyền bí/img2.jpg" alt="">
                    <span class="name-product">Tết Ở Làng Địa Ngục</span>
                    <span class="price">126.750 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="assets/image/pageHome/huyền bí/img3.jpg" alt="">
                    <span class="name-product">Người Dọn Dẹp Hiện Trường Án Mạng</span>
                    <span class="price">68.620 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/huyền bí/img4.jpg" alt="">
                    <span class="name-product">Điều Kỳ Diệu Của Tiệm Tạp Hóa Namiya (Tái Bản 2018)</span>
                    <span class="price">81.900 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/huyền bí/img5.jpg" alt="">
                    <span class="name-product">Tổng Đài Kể Chuyện Lúc 0h</span>
                    <span class="price">122.640 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
            </div>
            <div  class="see-more" >
            <a href="#">Xem thêm </a>
            </div>
        </div> -->
        <!-- END -->


        <!-- THỂ LOẠI 3 -->
        <!-- <div class="genre">
            <div class="genre-name">Văn học</div>
            <div class="product-list">
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">

                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>

                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img1.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/huyền bí/img3.jpg" alt="">
                    <span class="name-product">Người Dọn Dẹp Hiện Trường Án Mạng</span>
                    <span class="price">68.620 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
            </div>
            <div  class="see-more" >
            <a href="#">Xem thêm </a>
            </div>
        </div> -->
        <!-- END -->

        <!-- THỂ LOẠI 4 -->
        <!-- <div class="genre">
            <div class="genre-name">Văn học</div>
            <div class="product-list">
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">

                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>

                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img1.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/huyền bí/img3.jpg" alt="">
                    <span class="name-product">Người Dọn Dẹp Hiện Trường Án Mạng</span>
                    <span class="price">68.620 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
                <div class="product">
                    <img src="../../assets/image/pageHome/Văn học/img2.jpg" alt="">
                    <span class="name-product">Tô Bình Yên Vẽ Hạnh Phúc (Tái Bản 2022)</span>
                    <span class="price">66.880 đ</span>
                    <span class="old-price">66.880 đ</span>
                </div>
            </div>
            <div  class="see-more" >
            <a href="#">Xem thêm </a>
            </div>
        </div> -->
        <!-- END -->

    </div>

</body>

</html>