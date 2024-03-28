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
    <link rel="stylesheet" href="../css/admin/author.css?v=<?php echo time(); ?> " />
    <script defer src="../js/admin/author.js?v=<?php echo time(); ?> "></script>
</head>

<body>
    <form class="admin__content--body__filter"> 
        <h1>Lọc thông tin tác giả</h1>
        <div class="admin__content--body__filter--gr1">
            <div class="body__filter--field body__filter--nameClient" id="authorNameClient">
                <p>Tên tác giả</p>
                <input type="text" placeholder="Nhập tên tác giả" />
            </div>
            <div class="body__filter--field body__filter--idClient" id="authorIdClient">
                <p>Mã tác giả</p>
                <input type="text" placeholder="Nhập mã tác giả" />
            </div>
            <div class="body__filter--field body__filter--idClient" id="authorIdClient">
                <p>Email tác giả</p>
                <input type="text" placeholder="Nhập email tác giả" />
            </div>

          
        </div>

     
        <div class="body__filter--actions">
            <button class="body__filter--action__add">Thêm tác giả</button>
            <div>
                <button type="reset" class="body__filter--action__reset">Reset</button>
                <button class="body__filter--action__filter">Lọc</button>
            </div>
        </div>
    </form>

    <!-- Table -->
    <div class="table__wrapper">
        <table id="content-product">
            <thead class="menu">
                <tr>
                    <th>Mã tác giả</th>
                    <th>Tên tác giả</th>
                    <th>Email tác giả</th>
                    <th>Thể loại viết</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="table-content" id="content">
                <tr>
                    <td class="id">KH101</td>
                    <td class="name">Lữ Quang Minh</td>
                    <td class="email">minhlq2911@gmail.com</td>
                    <td class="genres">Trinh thám,Trinh thám,Trinh thám,Trinh thám,</td>

                    <td class="actions">
                        <button class="actions--edit">Sửa</button>
                        <button class="actions--delete">Xoá</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- End Table -->

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
                <button class="editAuthorButton d-none">Chỉnh thông tin tác giả</button>
                <button type="submit" class="saveButton">Lưu</button>
            </div>
        </div>
    </div>
    <!-- End: Modal Edit -->
</body>

</html>