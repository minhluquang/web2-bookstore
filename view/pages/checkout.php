<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Form</title>
    <link rel="stylesheet" href="css/fonts/fonts.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/checkout/checkout.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/fontawesome-free-6.5.1-web/css/all.min.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="form-container">
        <form id="checkout-form" action="" method="post">
            <div class="container">
                <h3>Địa Chỉ Nhận Hàng</h3>
                <hr>
                <div class="form-group" style="flex-direction: column;">
                    <span id="diachi">
                        <?php
                        $conn = connectDB();

                        $sql = `SELECT * FROM delivery_infoes WHERE`
                        ?>
                        <b>Nguyễn Minh Trí (+84) 394080644</b> Số 907a, Âu Cơ, Phường Tân Sơn Nhì, Quận Tân Phú, TP. Hồ Chí Minh
                    </span>
                    <div class="popup">
                        <button type="button" class="popupbutton">Thay đổi</button>
                        <div class="popupwrapper" id="diachiMenu">
                            <div class="popupbg"></div>
                            <div class="popupmenu" id="addressMenu">
                                <div>
                                    <h3>Địa Chỉ Của Tôi</h3>
                                    <hr>
                                </div>

                                <div class="address-container">
                                    <label class="address-select">
                                        <input type="radio" name="address" checked />
                                        <span class="name">Nguyễn Minh Trí</span>
                                        <span class="sdt">(+84) 394080644</span>
                                        <span class="updatebig update">Cập nhật</span>
                                        <span class="diachi">Số 907a, Âu Cơ</span>
                                        <span class="tinh">Phường Tân Sơn Nhì, Quận Tân Phú, TP. Hồ Chí Minh</span>
                                        <span class="updatesmall update">Cập nhật</span>
                                    </label>
                                    <label class="address-select">
                                        <input type="radio" name="address" />
                                        <span class="name">Nguyễn Minh Trí</span>
                                        <span class="sdt">(+84) 123123123</span>
                                        <span class="updatebig update">Cập nhật</span>
                                        <span class="diachi">123 Âu Cơ</span>
                                        <span class="tinh">Phường Tân Sơn Nhì, Quận Tân Phú, TP. Hồ Chí Minh</span>
                                        <span class="updatesmall update">Cập nhật</span>
                                    </label>
                                    <form action="" method="post">
                                        <input type="button" class="addNewAddress" value="Thêm địa chỉ mới">
                                    </form>
                                </div>
                                <div style="display: flex;flex-direction:row-reverse;">
                                    <button type="button" class="confirm" id="confirm-popup">Xác Nhận</button>
                                    <button type="button" class="cancel" id="cancel-popup">Hủy</button>

                                </div>
                            </div>
                            <div class="popupmenu" id="changeAddressMenu">
                                <div>
                                    <h3>Cập nhật địa chỉ</h3>
                                    <hr>
                                </div>
                                <div>
                                    <div class="update-container">
                                        <fieldset style="flex:0 0 47%;">
                                            <legend>Họ và tên</legend>
                                            <input type="text" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%">
                                        </fieldset>
                                        <fieldset style="flex:0 0 47%;margin-left:auto;">
                                            <legend>Số điện thoại</legend>
                                            <input type="text" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%">
                                        </fieldset>

                                        <fieldset class="fieldselect" style="margin:0 auto 0 0;">
                                            <legend>Tỉnh/Thành phố</legend>
                                            <select id="tinhthanh" name="tinhthanh" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%;">


                                            </select>
                                        </fieldset>
                                        <fieldset class="fieldselect" style="margin:0 auto;">
                                            <legend>Quận/huyện</legend>
                                            <select id="quanhuyen" name="quanhuyen" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%">
                                            </select>
                                        </fieldset>
                                        <fieldset class="fieldselect" style="margin:0 0 0 auto;">
                                            <legend>Phường/xã</legend>
                                            <select id="phuongxa" name="phuongxa" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%">
                                            </select>

                                        </fieldset>
                                        <fieldset style="flex:0 0 100% ;margin-top:10px">
                                            <legend>Địa chỉ cụ thể</legend>
                                            <input type="text" style="border: none;outline:none;padding:0;font-size :1.1em;width:100%">
                                        </fieldset>
                                    </div>

                                </div>
                                <div style="display: flex;flex-direction:row-reverse;padding-top:5px">
                                    <button type="button" class="confirm change_address">Xác Nhận</button>
                                    <button type="button" class="cancel change_address"> Hủy</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="container">
                <h3>PHƯƠNG THỨC THANH TOÁN</h3>
                <hr>
                <div class="form-group"><input id="id4" type="radio" name="id_test" value="" checked />
                    <label for="id4"><i class="fa-solid fa-dong-sign"></i>Thanh toán bằng tiền mặt khi nhận hàng</label>
                </div>
            </div>
            <div class="container">
                <h3>MÃ KHUYẾN MÃI</h3>
                <hr>
                <div class="form-group d-flex">
                    <div id="promo-container">
                        <input type="promo" id="promotion" name="promotion" placeholder="Nhập mã khuyến mãi">
                        <button type="button">Áp dụng</button>
                    </div>
                    <!-- <div class="popup">
                        <u style="color:#2f80ed;" onclick="popupToggle()">Chọn mã khuyến mãi</u>
                        <div class="popupwrapper" id="menuKM">
                            <div class="popupbg" onclick="popupToggle()"></div>
                            <div class="popupmenu">
                                <div class="form-group" style="margin:10px;margin-left:20px" >
                                <i class="fa-solid fa-ticket" style="color:#2f80ed;float:left;font-size:20px;margin-right:10px"></i>
                                <span style="color:black;float:left;">CHỌN MÃ KHUYẾN MÃI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <label>&nbsp;</label>
                    <p>Có thể áp dụng đồng thời nhiều mã &nbsp;<i class="fa-solid fa-circle-exclamation"></i></p> -->
                </div>
            </div>
            <!-- make this a different php file -->
            <div class="container">
                <h3>KIỂM TRA LẠI ĐƠN HÀNG</h3>
                <hr>
                <div class="sanpham">
                    <span class="sanpham__info-title">Hình ảnh</span>
                    <span class="sanpham__info-bookname">Tên sản phẩm</span>
                    <div class="sanpham__info-cost">
                        <div class="book-price">
                            <span class="price">Đơn giá</span>
                            <!-- <span class="old-price">120.000 &#8363;</span> -->
                        </div>
                        <span class="soluong">Số lượng</span>
                        <span class="booktotal">Tổng tiền</span>
                    </div>
                </div>
                <hr>
                <div class="sanpham">
                    <img src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000" />
                    <span class="bookname">Book namenamenamenamenamename</span>
                    <div class="cost">
                        <div class="book-price">
                            <span class="price">70.200 &#8363;</span>
                            <!-- <span class="old-price">120.000 &#8363;</span> -->
                        </div>
                        <span class="soluong">1</span>
                        <span class="booktotal">70.200 &#8363;</span>
                    </div>
                </div>
                <hr>
                <div class="sanpham">
                    <img src="https://bizweb.dktcdn.net/100/363/455/products/bat-tre-dong-xanh-14x20-5.jpg?v=1708501310000" />
                    <span class="bookname">Book namenamenamenamenamename</span>
                    <div class="cost">
                        <div class="book-price">
                            <span class="price">70.200 &#8363;</span>
                            <!-- <span class="old-price">120.000 &#8363;</span> -->
                        </div>
                        <span class="soluong">1</span>
                        <span class="booktotal">70.200 &#8363;</span>
                    </div>
                </div>
                <div class="form-group">
                </div>
            </div>
            <div class="container" id="total-bottom">
                <div class="total">
                    <div class="chiphi">
                        <span class="cost-name">Thành tiền </span>
                        <span class="money">192.700 &#8363;</span><br>
                    </div>
                    <div class="chiphi">
                        <span class="cost-name">Giảm giá</span>
                        <span class="money">-10.000 &#8363;</span><br>
                    </div>
                    <div class="chiphi">
                        <span class="cost-name">Phí vận chuyển (Giao hàng tiêu chuẩn)</span>
                        <span class="money">19.000 &#8363;</span><br>
                    </div>
                    <div class="chiphi" id="tong">
                        <span class="cost-name">Tổng Số Tiền (gồm VAT)</span>
                        <span class="money" id="tong-tien">201.700 &#8363;</span><br>
                    </div>
                </div>
            </div>
            <div class="container" id="dieukhoan-bottom" style="display: flex;">
                <div class="dieukhoan">
                    <i class="fa-solid fa-square-check" style="color:#ca3f3f;font-size:20px;padding:7px;flex:0 0 5%;"></i>

                    <span style="word-wrap: break-word;flex:0 0 85%;">
                        Bằng việc tiến hành Mua hàng, Bạn đã đồng ý với
                        <a href="">Điều khoản & Điều kiện của Fahasa.com</a>
                    </span>
                </div>
            </div>
    </div>
    <div class="form-submit">
        <div class="total" id="total-fixed">
            <div class="chiphi">
                <span class="cost-name">Thành tiền </span>
                <span class="money">192.700 &#8363;</span><br>
            </div>
            <div class="chiphi">
                <span class="cost-name">Giảm giá</span>
                <span class="money">-10.000 &#8363;</span><br>
            </div>
            <div class="chiphi" id="tong">
                <span class="cost-name">Tổng Số Tiền (gồm VAT)</span>
                <span class="money" id="tong-tien">201.700 &#8363;</span><br>
            </div>
        </div>
        <hr style=" width: 100%;flex-shrink: 0;margin-bottom:5px;" id="line-fixed">
        <div class="dieukhoan" id="dieukhoan-fixed">
            <i class="fa-solid fa-square-check" style="color:#ca3f3f;font-size:20px;padding:7px"></i>
            <span>
                <span>Bằng việc tiến hành Mua hàng, Bạn đã đồng ý với</span> <br>
                <a href="">Điều khoản & Điều kiện của Fahasa.com</a>
            </span>
        </div>
        <button type="submit">Xác nhận thanh toán</button>
    </div>
    </form>
    </div>
    <script src="js/checkout.js?v=<?php echo time(); ?>"></script>

</body>

</html>