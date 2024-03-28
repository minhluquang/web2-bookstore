<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Sign Up</title>
    <link rel="stylesheet" href="css/signup/signup.css?v=<?php echo time(); ?>">
    <script defer src="js/home.js?v=<?php echo time(); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="backGround">
        <div class="container">
            <div class="button-container">
                <!-- Button to open the login form -->
                <button onclick="showForm('loginForm', this)" class="button active">Đăng nhập</button>

                <!-- Button to open the sign-up form -->
                <button onclick="showForm('signupForm', this)" class="button">Đăng ký</button>
            </div>

            <!-- Login form -->
            <div id="loginForm" class="form-container active">
                <!-- <h2>Form Đăng nhập</h2> -->
                <!-- Your login form goes here -->
                <form action="" method="POST">
                    <div class="form-row">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Nhập tên tài khoản" name="username" id="loginUsername" required>
                    </div>
                    <div class="form-row">
                        <label for="psw">Mật khẩu</label>
                        <input type="password" placeholder="Nhập Mật khẩu" name="password" id="loginPassword" required>
                    </div>
                    <input class="btnSubmit btnDangNhap" type="submit" value="Đăng nhập" />
                </form>
                <div class="result"></div>
            </div>

            <!-- Sign-up form -->
            <div id="signupForm" class="form-container">
                <!-- <h2>Form Đăng ký</h2> -->
                <!-- Your sign-up form goes here -->
                <form action="" method="POST">
                    <div class="form-row">
                        <label for="username">Username</label>
                        <input type="text" placeholder="Nhập tên tài khoản" id="registerUsername" name="username" required>
                    </div>
                    <div class="form-row">
                        <label for="name">Họ và tên</label>
                        <input type="text" placeholder="Nhập Họ và tên" id="registerFullname" name="name" required>
                    </div>
                    <div class="form-row">
                        <label for="number">Số điện thoại</label>
                        <input type="text" placeholder="Nhập Số điện thoại" id="registerPhoneNumber" name="number" required>
                    </div>
                    <div class="form-row">
                        <label for="address">Địa chỉ</label>
                        <input type="text" placeholder="Nhập địa chỉ" id="registerAddress" name="address" required>
                    </div>

                    <div class="form-row">
                        <label for="psw">Mật khẩu</label>
                        <input type="password" placeholder="Nhập Mật khẩu" id="registerPassword" name="psw" required id="psw">
                    </div>
                    <div class="form-row">
                        <label for="psw-repeat">Lặp lại Mật khẩu</label>
                        <input type="password" placeholder="Nhập lại Mật khẩu" id="registerConfirmPassword" name="psw-repeat" required id="psw-repeat">
                    </div>
                    <input class="btnSubmit btnDangKy" type="submit" value="Đăng ký" />
                   <div class="result"></div>
                </form>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('.btnDangNhap').click(function(e) {
                e.preventDefault();
                var $username = $('#loginUsername').val();
                var $password = $('#loginPassword').val();
                $.ajax({
                    url: 'controller/signup.controller.php',
                    type: "post",
                    dataType: 'html',
                    data: {
                        usernameLogin: $username,
                        passwordLogin: $password
                    }
                }).done(function (result) {
                    $('.result').html(result);
                })
            })
        })

        $(document).ready(function () {
            $('.btnDangKy').click(function (e) { 
                e.preventDefault();
                var $username = $('#registerUsername').val();
                var $fullname = $('#registerFullname').val();
                var $phoneNumber = $('#registerPhoneNumber').val();
                var $address = $('#registerAddress').val();
                var $password = $('#registerPassword').val();
                var $confirmPassword = $("#registerConfirmPassword").val();
                $.ajax({
                    url: 'controller/signup.controller.php',
                    type: 'post',
                    dataType: 'html',
                    data: {
                        usernameRegister: $username,
                        fullnameRegister: $fullname,
                        phoneNumberRegister: $phoneNumber,
                        addressRegister: $address,
                        passwordRegister: $password,
                        confirmPasswordRegister: $confirmPassword
                    }
                }).done(function(result) {
                    $('.result').html(result);
                })
            })
        })
    </script>
</body>

</html>