<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/home.css?v=<?php echo time(); ?>" />
</head>

<body>
    <div class="content">
        <div class="card">
            <div class="icon">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="card-content">
                <p>
                    <span class="number">$1.000</span>
                </p>
                <h2>Thu nhập</h2>
                <p>+8% so với hôm qua</p>
            </div>
        </div>

        <div class="card">
            <div class="icon">
                <i class="fa-brands fa-dochub"></i>
            </div>
            <div class="card-content">
                <p>
                    <span class="number">300</span>
                </p>
                <h2>Đơn hàng</h2>
                <p>+5% so với hôm qua</p>
            </div>
        </div>

        <div class="card">
            <div class="icon">
                <i class="fa-solid fa-tag"></i>
            </div>
            <div class="card-content">
                <p>
                    <span class="number">5</span>
                </p>
                <h2>Sản phẩm</h2>
                <p>+1,2% so với hôm qua</p>
            </div>
        </div>

        <div class="card">
            <div class="icon">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="card-content">
                <p>
                    <span class="number">8</span>
                </p>
                <h2>Thành viên</h2>
                <p>+0,5% so với hôm qua</p>
            </div>
        </div>
    </div>
    <div class="thongkechitiet__container">
        <h1>Thống kế theo thể loại</h1>
        <div class="content-container">
            <div class="date">
                <h3>Từ ngày:</h3>
                <input type="date" id="startdate" name="startdate">

            </div>
            <div class="date">
                <h3>Đến ngày:</h3>
                <input type="date" id="enddate" name="enddate">

            </div>
            <button type="button" id="filter">Lọc</button>
        </div>
        <div class="content-container" id="thongke-container">
            <div class="thongke">
                <h3 class="sanpham">Khoa học</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
            <div class="thongke">
                <h3 class="sanpham">Tôn giáo - tâm linh</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
            <div class="thongke">
                <h3 class="sanpham">Ngôn tình</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
            <div class="thongke">
                <h3 class="sanpham">Tâm lý</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
            <div class="thongke">
                <h3 class="sanpham">Tâm lý</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
            <div class="thongke">
                <h3 class="sanpham">Tâm lý</h3>
                <div class="money"> 0 VND</div>
                <div class="soluong">Số lượng bán được: 0</div>
                <button type="button" class="chitietbtn">Chi tiết</button>
            </div>
        </div>
    </div>
    <table class="thongke-chitiet">
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Ảnh</th>
                <th>Tên SP</th>
                <th>Giá gốc</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tr>
            <td>masp</td>
            <td class="image">
                <img src="../assets/image/products/image_1.jpg" alt="" />
            </td>
            <td>Ten sp</td>
            <td>400000</td>
            <td>5</td>
        </tr>
        <tr>
            <td>masp</td>
            <td class="image">
                <img src="../assets/image/products/image_1.jpg" alt="" />
            </td>
            <td>Ten sp</td>
            <td>400000</td>
            <td>5</td>
        </tr>
        <tr>
            <td>masp</td>
            <td class="image">
                <img src="../assets/image/products/image_1.jpg" alt="" />
            </td>
            <td>Ten sp</td>
            <td>400000</td>
            <td>5</td>
        </tr>
        <tr>
            <td>masp</td>
            <td class="image">
                <img src="../assets/image/products/image_1.jpg" alt="" />
            </td>
            <td>Ten sp</td>
            <td>400000</td>
            <td>5</td>
        </tr>
    </table>
</body>

</html>