<?php
  include_once('connect.php');

  function getAllUserInfoByUserIdModel($userId) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "SELECT * FROM delivery_infoes WHERE user_id = '$userId'";

      $result = $database->query($sql);
      $database->close();
      return $result;
    } else {
      $database->close();
      return false;
    }
  }

  function updateUserInfoByIdModel($id, $fullname, $phone_number, $address, $city, $district, $ward) {
    $database = new connectDB();
    if ($database->conn) {
      $sql = "UPDATE delivery_infoes
              SET 
                  fullname = '$fullname',
                  phone_number = '$phone_number',
                  address = '$address',
                  city = '$city',
                  district = '$district',
                  ward = '$ward'
              WHERE 
                  user_info_id = $id;
              ";

      $result = $database->execute($sql);
      $database->close();
      return (object) array (
        "success" => $result,
        "id" => $id,
        "fullname" => $fullname,
        "phone_number" => $phone_number,
        "address" => $address,
        "city" => $city,
        "district" => $district,
        "ward" => $ward        
      );
    } else {
      $database->close();
      return false;
    }
  }
?>