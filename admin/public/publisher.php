<!DOCTYPE html>
<html lang="en">
<?php
//   session_start();
$_SESSION["render"] ->setTable("publishers");
?>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home page</title>
  <link rel="stylesheet" href="../css/fonts/fonts.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="../assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>" />
  <link rel="stylesheet" href="../css/admin/product.css?v=<?php echo time(); ?> " />
  <link rel="stylesheet" href="../css/admin/filter.css?v=<?php echo time(); ?> " />
  <link rel="stylesheet" href="../css/admin/author.css?v=<?php echo time(); ?> " />
  <link rel="stylesheet" href="../css/admin/publisher.css?v=<?php echo time(); ?> " />
  <script defer src="../js/admin/author.js?v=<?php echo time(); ?> "></script>
</head>

<body>
  <form class="admin__content--body__filter">
    <h1>Lọc thông tin nhà xuất bản</h1>
    <div class="admin__content--body__filter--gr1">
      <div class="body__filter--field body__filter--nameClient" id="publisherName">
        <p>Tên nhà xuất bản</p>
        <input type="text" placeholder="Nhập tên nhà xuất bản" />
      </div>
      <div class="body__filter--field body__filter--idClient" id="publisherId">
        <p>Mã nhà xuất bản</p>
        <input type="text" placeholder="Nhập mã nhà xuất bản" />
      </div>
      <div class="body__filter--field body__filter--idClient" id="publisherEmail">
        <p>Email nhà xuất bản</p>
        <input type="text" placeholder="Nhập email nhà xuất bản" />
      </div>

    </div>


    <div class="body__filter--actions">
      <button class="body__filter--action__add">Thêm nhà xuất bản</button>
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
        <button class="editAuthorButton d-none">Chỉnh thông tin tác giả</button>
        <button type="submit" class="saveButton">Lưu</button>
      </div>
    </div>
  </div>
  <!-- End: Modal Edit -->
  <script defer src="../js/admin/publisher.js?v=<?php echo time(); ?> "></script>

</body>

</html>