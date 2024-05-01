$(document).ready(function () {
  $(".btnLogoutAdmin").click(function () {
    $.ajax({
      type: "post",
      url: "../controller/admin/index.controller.php",
      dataType: "html",
      data: {
        isLogout: true,
      },
    }).done(function (result) {
      if (result) {
        alert("Đăng xuất thành công!");
        location.reload();
      } else {
        alert("Hệ thống gặp sự cố không thể đăng xuất!");
      }
    });
  });
});
