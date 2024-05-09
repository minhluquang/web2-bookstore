<!DOCTYPE html>
<html lang="en">
<?php
//   session_start();
$_SESSION["render"] ->setTable("accounts");
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home page</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/account.css?v=<?php echo time(); ?> " />
    <script defer src="../js/admin/account.js?v=<?php echo time(); ?> "></script>
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
                    <option value="all" selected>Tất cả</option>
                    <option value="customer" >Người dùng</option>
                    <option value="admin">Quản trị viên</option>
                    <option value="staff">Nhân viên</option>
                </select>
            </div>

            <div class="body__filter--field body__filter--statusClient" id="userStatus">
                <p>Loại tài khoản</p>
                <select>
                    <option value="all" selected>Tất cả</option>
                    <option value="active">Hoạt động</option>
                    <option value="nonActive">Ngưng hoạt động</option>
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

    <div class="result"></div>
    <!-- Start: Modal Edit -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">
                <i class="fa-solid fa-xmark"></i>
            </span>
            <div class="form">
                <!-- Code will be render here -->
                <!-- ... -->
            </div>
            <div class="form-actions">
                <button class="editFunctionButton">Đổi mật khẩu</button>
                <button class="editAccountButton d-none">Chỉnh thông tin tài khoản</button>
                <button type="submit" class="saveButton">Lưu</button>
            </div>
        </div>
    </div>
    <!-- End: Modal Edit -->
</body>
</html>