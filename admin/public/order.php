<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> ">
    <link rel="stylesheet" href="../css/admin/order.css?v=<?php echo time(); ?> ">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <form class="admin__content--body__filter">
        <h1>Lọc đơn hàng</h1>
        <p>* Lưu ý: Định dạng dữ liệu ngày tạo đơn được hiển thị là dạng dd/mm/yyyy</p>
        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--idOrder">
                <p>Mã đơn hàng</p>
                <input type="text" placeholder="Nhập mã sản phẩm" />
            </div>
            <div class="body__filter--field body__filter--idClient">
                <p>Mã khách hàng</p>
                <input type="text" placeholder="Nhập mã khách hàng" />
            </div>

            <div class="body__filter--field body__filter--idClient">
                <p>Mã nhân viên</p>
                <input type="text" placeholder="Nhập mã khách hàng" />
            </div>
        </div>

        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field w-30 body__filter--status">
                <p>Trạng thái</p>
                <select name="" id="">
                    <option value="all">Tất cả</option>
                    <option value="valid">Đã xử lý</option>
                    <option value="invalid">Chưa xử lý</option>
                </select>
            </div>
            <div class="body__filter--field w-30 body__filter--orderDate">
                <label>Từ ngày:</label>
                <input type="date" />
            </div>

            <div class="body__filter--field w-30 body__filter--orderDate">
                <label>Đến ngày:</label>
                <input type="date" />
            </div>
        </div>
        <div class="body__filter--actions d-flex-right">
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
                    <th>Mã đơn</th>
                    <th>Mã KH</th>
                    <th>Mã NV</th>
                    <th>Ngày tạo</th>
                    <th>Tổng giá</th>
                    <th>Địa chỉ giao</th>
                    <th>Trạng thái</th>
                    <th>Mã giảm giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="table-content" id="content">

            </tbody>
        </table>
    </div>
    <div class="pagination">
        <span href="#">&laquo;</span>
        <span href="#">1</span>
        <span href="#" class="active">2</span>
        <span href="#">3</span>
        <span href="#">4</span>
        <span href="#">5</span>
        <span href="#">6</span>
        <span href="#">&raquo;</span>
    </div>
    <!-- delete button  -->
    <div class="delete-modal hidden">
        <button class="close-modal">&times;</button>

        <div class="modal-header">
            <h2>Xác nhận xóa hóa đơn</h2>
        </div>
        <div>
            <span style="font-weight: bold;">Bạn có thực sự muốn xóa hóa đơn có mã là :</span>
            <span id="order-delete-id">ERROR</span>
        </div>

        <div class="del-btn-container">
            <input type="button" value="Hủy" class="del-cancel">
            <input type="button" value="Xác nhận" class="del-confirm">
        </div>


    </div>

    <!-- Modal  -->
    <div class="order-modal hidden">
        <button class="close-modal">&times;</button>
        <div class="modal-content">
            <div class="modal-header">
                <h2>Chi tiết hóa đơn</h2>
            </div>
            <table class="orderdetail-table">
                <thead>
                    <tr>
                        <th scope="col">Stt</th>
                        <th scope="col">Tên Sản Phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số Lượng</th>
                        <th scope="col">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Tên Sách</td>
                        <td>Giá Tiền</td>
                        <td>5</td>
                        <td>50000đ</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Tên Sách</td>
                        <td>Giá Tiền</td>
                        <td>5</td>
                        <td>50000đ</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Tên Sách</td>
                        <td>Giá Tiền</td>
                        <td>5</td>
                        <td>50000đ</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Tên Sách</td>
                        <td>Giá Tiền</td>
                        <td>5</td>
                        <td>50000đ</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td>Tiền Hóa Đơn</td>
                        <td>50000đ</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td>Mã Giảm Giá</td>
                        <td>20%</td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                        <td></td>
                        <td class="total-price">Thành Tiền</td>
                        <td class="total-price">40000đ</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="overlay hidden"></div>

    <script defer src="../js/admin/order.js?v=<?php echo time(); ?>"></script>
</body>

</html>