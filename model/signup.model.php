<?php
  function checkLogin($username, $password)
  {
    include_once('connect.php');
    $conn = connectDB();
    $query = "SELECT *
              FROM accounts
              WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    // Kiểm tra xem có tồn tại không?
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $db_password = $row['password'];

      // So sánh mật khẩu nhập vào với mật khẩu trong cơ sở dữ liệu
      if ($password == $db_password) {
        mysqli_close($conn);
        return true;
      } else {
        mysqli_close($conn);
        return false;
      }
    } else {
      mysqli_close($conn);
      return false;
    }
  }

  function checkRegister($username, $fullname, $phoneNumber, $address, $password) {
    include_once('connect.php');
    $conn = connectDB();
    // Kiểm tra username có tồn tại hay chưa
    $query_check_exist_username = "SELECT * FROM accounts WHERE username = '$username'";
    $result_username = mysqli_query($conn, $query_check_exist_username);
    if (mysqli_num_rows($result_username) > 0) {
      return (object) array (
        'success' => false,
        'message' => "Hệ thống đã tồn tại username: $username"
      );
    }

    // Nếu như username chưa tồn tại, thì tạo tài khoản
    $query_insert_account = "INSERT INTO accounts (username, password, role_id) 
                        VALUES ('$username', '$password', 1)";
    $query_insert_user_info = "INSERT INTO user_infoes (user_id, fullname, phone_number, address)
                              VALUES ('$username', '$fullname', '$phoneNumber', '$phoneNumber')";
    $result_account = mysqli_query($conn, $query_insert_account);
    $result_user_info = mysqli_query($conn, $query_insert_user_info);  
   
    // Nếu như insert thành công vào database
    if ($result_account && $result_user_info) {
      return (object) array (
        'success' => true,
        'message' => "Đăng ký thành công"
      );
    } else {
      return (object) array (
        'success' => false,
        'message' => "Đã xảy ra lỗi khi đăng ký"
      );
    }
  }
?>