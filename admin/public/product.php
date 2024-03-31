<!DOCTYPE html>
<html lang="en">
<?php
//   session_start();
$_SESSION["render"] ->setTable("products");
?>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý sản phẩm</title>
    <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> " />
    <link rel="stylesheet" href="../css/admin/account.css?v=<?php echo time(); ?> " />


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
    <div class='result'></div>

    <div id="modal">
        <div class="modal-edit-product-container" id="modal-edit-container">
            <div class="modal-edit-product">
                <div class="modal-header">
                    <h3>Thay Đổi thông tin sản phẩm</h3>
                    <button class="btn-close" id="btnClose"><i class="fa-solid fa-xmark"></i></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="edit-image">
                            <h4>Hình ảnh</h4>
                            <input type="radio" id="delete" value="delete" name="image">
                            <label for="delete">Xóa Hình</label>
                            <input type="radio" id="edit" value="edit" name="image">
                            <label for="edit">Sửa Hình</label>
                            <input type="radio" id="retain" value="retain" name="image">
                            <label for="retain">Giữ Hình</label>
                            <div class="choose-img hidden">
                                <label for="choose-img">Chọn hình ảnh:</label>
                                <div class="img">
                                    <img id="imagePreview" src="#" alt="Ảnh xem trước" style="display: none;">
                                </div>

                                <input type="file" name="choose-img" id="fileInput">
                            </div>

                        </div>
                        <div class="modal-body-2">
                            <div class="edit-name">
                                <label for="">Tên sản phẩm</label>
                                <input type="text" value="Tên sản phẩm">
                            </div>
                            <div class="edit-category">
                                <label for="">Thể loại</label>
                                <select name="" id="">
                                    <option value="science">Khoa học</option>
                                    <option value="psychology">Tâm Lý</option>
                                    <option value="novel">Tiểu thuyết</option>
                                </select>
                            </div>
                            <div class="edit-price">
                                <label for="">Giá sản phẩm</label>
                                <input type="text" value="Giá sản phẩm">
                            </div>
                            <div class="edit-id">
                                <label for="">Mã sản phẩm</label>
                                <input type="text" value="Mã sản phẩm">
                            </div>
                            <div class="edit-date-create">
                                <label for="">Ngày Tạo</label>
                                <input type="date" value="dateCreate">
                            </div>
                            <div class="edit-date-update">
                                <label for="">Ngày cập nhật</label>
                                <input type="date" value="dateUpdate">
                            </div>

                        </div>
                        <div>
                        </div>

                        <input type="submit" value="Xác nhận" class="btn-confirm">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script defer src="../js/admin/product.js?v=<?php echo time(); ?> "></script>
</body>

</html>