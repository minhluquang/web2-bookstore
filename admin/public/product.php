

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/account.css?v=<?php echo time(); ?> " />
    <script defer src="/admin.js/productAdmin.js"></script>
</head>

<body>

    <form class="admin__content--body__filter" id="product-filter-form">
        <h1>Lọc sản phẩm</h1>
        <p>* Lưu ý: Định dạng dữ liệu ngày được hiển thị là dạng dd/mm/yyyy</p>
        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--nameClient" id="">
                <p>Tên Sản phẩm</p>
                <input id="productName" type="text" placeholder="Nhập tên sản phẩm" />
            </div>
            <div class="body__filter--field body__filter--idClient" id="">
                <p>Mã Sản Phẩm</p>
                <input id="productCode" type="text" placeholder="Nhập mã sản phẩm" />
            </div>
            <div class="body__filter--field body__filter--status" id="">
                <p>Loại sản phẩm</p>
                <select name="category" id="categorySelect">
                    <option value="all">Tất cả</option>
                    <option value="mountain">Mountain</option>
                    <option value="road">Road</option>
                    <option value="touring">Touring</option>
                    <option value="kids">Kid</option>
                </select>
            </div>
        </div>

        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--status" id="">
                <p>Loại ngày</p>
                <select name="cateDate" id="cateDateSelect">
                    <option value="">Chọn loại ngày</option>
                    <option value="dateCreate">Ngày tạo</option>
                    <option value="dateUpdate">Ngày cập nhật</option>
                </select>
            </div>
            <div class="body__filter--field body__filter--datefrom" id="dateFrom">
                <label>Từ ngày</label>
                <input type="date" />
            </div>
            <div class="body__filter--field body__filter--dateto" id="dateTo">
                <label>Đến ngày</label>
                <input type="date" />
            </div>
        </div>

        <div class="body__filter--actions">
            <button class="body__filter--action__add">Thêm sản phẩm</button>
            <div>
                <button type="reset" class="body__filter--action__reset">Reset</button>
                <button class="body__filter--action__filter">Lọc</button>
            </div>
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
                    <th>Hành động</th>
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
                    <td class="actions ">
                        <button class="actions--edit" id="edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
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
                    <td class="actions ">
                        <button class="actions--edit" id="edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
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
                    <td class="actions ">
                        <button class="actions--edit" id="edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
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
                    <td class="actions ">
                        <button class="actions--edit" id="edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
                </tr>
                <!-- as -->
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
                    <td class="actions ">
                        <button class="actions--edit" id="edit" >Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
                </tr>
                <!-- as -->
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

    <div id="modal"></div>
    
    <script defer src="./admin.js/productAdmin.js"></script>
</body>

</html>