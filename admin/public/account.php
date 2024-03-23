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


    <!-- Modal -->
    <div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Chỉnh sửa thông tin người dùng</h2>
        <form id="editForm">
        <div class="input-field">
            <label for="editUserId">Mã người dùng</label>
            <input type="text" id="editUserId" readonly>
        </div>
        <div class="input-field">
            <label for="editUserName">Tên người dùng</label>
            <input type="text" id="editUserName">
        </div>
        <div class="input-field">
            <label for="editUserEmail">Email</label>
            <input type="email" id="editUserEmail">
        </div>
        <div class="input-field">
            <label for="editUserRole">Loại tài khoản</label>
            <select id="editUserRole">
            <option value="user">Người dùng</op   tion>
            <option value="admin">Quản trị viên</option>
            </select>
        </div>
        <button type="submit" class="saveButton">Lưu</button>
        </form>
    </div>
    </div>
    <!-- End Modal -->


    <!-- Table -->
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

    <script>
    // Get the modal
    var modal = document.getElementById('editModal');

    // Get the button that opens the modal
    var editButtons = document.querySelectorAll('.actions--edit');

    // Get the <span> element that closes the modal
    var span = document.querySelector('.close');

    // When the user clicks the edit button, open the modal
    editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        modal.style.display = 'block';
        // Populate modal fields with user data from the corresponding row
        var row = button.closest('tr');
        var userId = row.querySelector('.id').textContent;
        var userName = row.querySelector('.name').textContent;
        var userEmail = row.querySelector('.email').textContent;
        var userRole = row.querySelector('.type').textContent;
        document.getElementById('editUserId').value = userId;
        document.getElementById('editUserName').value = userName;
        document.getElementById('editUserEmail').value = userEmail;
        var editUserRoleSelect = document.getElementById('editUserRole');
    for (var i = 0; i < editUserRoleSelect.options.length; i++) {
      if (editUserRoleSelect.options[i].text === userRole) {
        editUserRoleSelect.selectedIndex = i;
        break;
      }
    }

    // Open the select for editUserRole
    editUserRoleSelect.open = true;
    });
    });

    // When the user clicks on <span> (x), close the modal
    span.addEventListener('click', function() {
    modal.style.display = 'none';
    });

    // When the user clicks anywhere outside of the modal, close it
    window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
    });

    // Add event listener to the form for handling form submission
    document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    // Handle form submission (you may send an AJAX request to update the user data)
    // Once the data is updated, close the modal
    modal.style.display = 'none';
    });
    </script>

    </body>
    </html>