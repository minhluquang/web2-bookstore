<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home page</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css" />
    <link rel="stylesheet" href="../css/admin/adminProduct.css?v=<?php echo time(); ?> " />
</head>

<body>

    <form action="" class="filter-product">
        <p>Lọc sản phẩm</p>
        <div class="filter_by_id">
            <label for="">Mã sản phẩm</label>
            <input type="text" name="" id="">
        </div>
        <div class="filter_by_name">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="" id="">
        </div>
        <div class="filter_by_supplier">
            <label for="">Nhà cung cấp</label>
            <input type="text" name="" id="">
        </div>
        <div class="btn">
            <input type="submit" value="Thêm sản phẩm" class="btn_add">
            <input type="submit" name="" id="" value="Lọc" class="btn_filter">
            <input type="submit" name="" id="" value="Reset" class="btn_reset">
        </div>
    </form>

    <!-- end -->
    <div class="table__wrapper">
        <table id="content-product">
            <thead class="menu">
                <tr>
                    <th>Mã SP</th>
                    <th>Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Phân loại</th>
                    <th>Ngày cập nhật</th>
                    <th>Ngày tạo</th>
                    <th>Giá</th>
                    <th>Sửa</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="table-content" id="content">
                <tr>
                    <td class="id">MASP</td>
                    <td class="image">
                        <img src="../assets/image/products/image_1.jpg" alt="" />
                    </td>
                    <td class="name">Fuel EXe 9.9 XX AXS T-TYPE</td>
                    <td class="type">abc</td>
                    <td class="date-update">14/11/2023</td>
                    <td class="date-creat">14/11/2023</td>
                    <td class="price">100000</td>
                    <td class="edit"><a href="#!">Sửa</a></td>
                    <td class="delete"><a href="#!">Xóa</a></td>
                </tr>
                <!-- asd -->
                <tr>
                    <td class="id">MASP</td>
                    <td class="image">
                        <img src="../assets/image/products/image_2.jpg" alt="" />
                    </td>
                    <td class="name">Fuel EXe 9.9 XX AXS T-TYPE</td>
                    <td class="type">abc</td>
                    <td class="date-update">14/11/2023</td>
                    <td class="date-creat">14/11/2023</td>
                    <td class="price">100000</td>
                    <td class="edit"><a href="#!">Sửa</a></td>
                    <td class="delete"><a href="#!">Xóa</a></td>
                </tr>
                <!-- as -->
                <tr>
                    <td class="id">MASP</td>
                    <td class="image">
                        <img src="../assets/image/products/image_3.jpg" alt="" />
                    </td>
                    <td class="name">Fuel EXe 9.9 XX AXS T-TYPE</td>
                    <td class="type">abc</td>
                    <td class="date-update">14/11/2023</td>
                    <td class="date-creat">14/11/2023</td>
                    <td class="price">100000</td>
                    <td class="edit"><a href="#!">Sửa</a></td>
                    <td class="delete"><a href="#!">Xóa</a></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#" class="active">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
    </div>

</body>

</html>