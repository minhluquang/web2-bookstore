<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home page</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/account.css?v=<?php echo time(); ?> " />
</head>

<body>
    <form class="admin__content--body__filter">
        <h1>Lọc thông tin người dùng</h1>
        <p>* Lưu ý: Định dạng dữ liệu ngày đăng ký được hiển thị là dạng dd/mm/yyyy</p>
        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--nameClient" id="userNameClient">
                <p>Tên khách hàng</p>
                <input type="text" placeholder="Nhập tên khách hàng" />
            </div>
            <div class="body__filter--field body__filter--idClient" id="userIdClient">
                <p>Mã khách hàng</p>
                <input type="text" placeholder="Nhập mã khách hàng" />
            </div>

            <div class="body__filter--field body__filter--roleClient" id="userRoleClient">
                <p>Loại tài khoản</p>
                <select>
                    <option value="user" selected>Người dùng</option>
                    <option value="admin">Quản trị viên</option>
                </select>
            </div>
        </div>

        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--dateClient" id="userBeginDate">
                <label for="userDate">Từ ngày:</label>
                <input type="date" id="beginDate" />
            </div>

            <div class="body__filter--field body__filter--dateClient" id="userEndDate">
                <label for="userDate">Đến ngày:</label>
                <input type="date" id="endDate" />
            </div>
        </div>
        <div class="body__filter--actions">
            <button class="body__filter--action__add">Thêm tài khoản</button>
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
                    <th>Mã người dùng</th>
                    <th>Tên người dùng</th>
                    <th>Email</th>
                    <th>Loại tài khoản</th>
                    <th>Ngày đăng ký</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="table-content" id="content">
                <tr>
                    <td class="id">KH101</td>
                    <td class="name">Lữ Quang Minh</td>
                    <td class="email">minhlq2911@gmail.com</td>
                    <td class="type">Người dùng</td>
                    <td class="date-create">14/11/2023</td>
                    <td class="actions">
                        <button class="actions--edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
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