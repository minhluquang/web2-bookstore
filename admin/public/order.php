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
    <script defer src="../js/admin/order.js?v=<?php echo time(); ?>"></script>
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
                <?php
                $conn = connectDB();
                $sql = 'SELECT * from orders';
                $result = mysqli_query($conn, $sql);


                while ($row = mysqli_fetch_array($result)) {
                    echo '<tr>';
                    echo '<td class="order_id">' . $row[0] . '</td>';
                    echo '<td class="customer_id">' . $row[1] . '</td>';
                    echo '<td class="staff_id">' . $row[2] . '</td>';
                    echo '<td class="date-update">' . $row[4] . '</td>';
                    echo '<td class="total_price">' . $row[5] . '</td>';
                    $sql_address = 'SELECT * from delivery_infoes WHERE id="' . $row[3] . '"';
                    $result_address = mysqli_query($conn, $sql_address);
                    $row_address = mysqli_fetch_array($result_address);

                    echo '<td class="address">' . $row_address['address'] . '</td>';

                    $sql_status = 'SELECT * from order_statuses WHERE id="' . $row[6] . '"';
                    $result_status  = mysqli_query($conn, $sql_status);
                    $row_status = mysqli_fetch_array($result_status);

                    echo '<td class="status">' . $row_status['name'] . '</td>';
                    echo '<td class="discount_code">' . $row[7] . '</td>';
                    echo '<td class="actions">
                    <button class="actions--view">Chi tiết hoá đơn</button>
                    <button class="actions--delete">Xoá</button>
                    </td>
                    </tr>';
                }
                ?>


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
    <!-- delete button  -->
    <div class="delete-modal hidden">
        <button class="close-modal">&times;</button>

        <div class="modal-header">
            <h2>Xác nhận xóa hóa đơn</h2>
        </div>
        <div>
            <span style="font-weight: bold;">Bạn có thực sự muốn xóa hóa đơn có mã là :</span>
            <span class="delete-id">ERROR</span>
        </div>

        <form action="../model/order_del.php">
            <input type="hidden" value="" name="id" class="hidden_input"/>

            <div class="del-btn-container">
                <input type="button" value="Hủy" class="del-cancel">
                <input type="button" value="Xác nhận" class="del-confirm">
            </div>
        </form>

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

</body>

</html>