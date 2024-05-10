<?php
  include_once('connect.php');
  $database = new connectDB();

  function checkLogin($username, $password)
  {
    global $database;
    $sql = "SELECT *
              FROM accounts
              WHERE username = '$username'";
    $result = $database->query($sql);

    // Kiểm tra xem có tồn tại không?
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $db_password = $row['password'];

      // So sánh mật khẩu nhập vào với mật khẩu trong cơ sở dữ liệu
      if (password_verify($password, $db_password)) {
        $database->close();
        if ($row['status'] == 0) {
          $reponse = (object) array (
            "success" => false,
            "status" => $row["status"],
            "message" => "Tài khoản của bạn đã bị khoá!"
          );
          return $reponse;
        } else {
          $reponse = (object) array (
            "success" => true,
            "status" => $row["status"],
            "message" => "Đăng nhập thành công!"
          );
          return $reponse;
        }
      } else {
        $database->close();
        $reponse = (object) array (
          "success" => false,
          "message" => "Tài khoản hoặc mật khẩu không chính xác!"
        );
        return $reponse;
      }
    } else {
      $database->close();
      $reponse = (object) array (
        "success" => false,
      );
      return $reponse;
    }
  }

  function checkRegister($username, $fullname, $phoneNumber, $address, $password, $city, $district, $ward) {
    global $database;
    // Kiểm tra username có tồn tại hay chưa
    $sqlCheckExistUsername = "SELECT * FROM accounts WHERE username = '$username'";
    $resultCheckExistUsername = $database->query($sqlCheckExistUsername);
    if (mysqli_num_rows($resultCheckExistUsername) > 0) {
      return (object) array (
        'success' => false,
        'existUsername' => true,
        'message' => "Hệ thống đã tồn tại username: $username"
      );
    }

    // Nếu như username chưa tồn tại, thì tạo tài khoản
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sqlInsertAccount = "INSERT INTO accounts (username, password, role_id, status) 
                        VALUES ('$username', '$hashedPassword', 3, 1)";
    $sqlInsertUserInfo = "INSERT INTO delivery_infoes (user_id, fullname, phone_number, address, city, district, ward)
                              VALUES ('$username', '$fullname', '$phoneNumber', '$address', '$city', '$district', '$ward')";

    $resultInsertAccount = $database->execute($sqlInsertAccount);
    $resultInsertUserInfo = $database->execute($sqlInsertUserInfo);
   
    // Nếu như insert thành công vào database
    if ($resultInsertAccount && $resultInsertUserInfo) {
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