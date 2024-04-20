<?php
  include_once('connect.php');
  $database = new connectDB();

  function getAllUserInfoByUserIdModel($userId) {
    global $database;
    if ($database->conn) {
      $sql = "SELECT * FROM delivery_infoes WHERE user_id = '$userId'";

      $result = $database->query($sql);
      return $result;
    } else {
      return false;
    }
  }

  function updateUserInfoByIdModel($id, $fullname, $phone_number, $address, $city, $district, $ward) {
    global $database;
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
      return false;
    }
  }
?>