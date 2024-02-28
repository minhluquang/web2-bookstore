<?php
  function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
      $conn = new PDO("mysql:host=$servername;dbname=backend_web2", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      // echo "Connected successfully";
    } catch (PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
  }

  function getAll($sql) {
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrProduct = $stmt->fetchAll();
    $conn = null;
    return $arrProduct;
  }

  function getOne($sql) {
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $arrProduct = $stmt->fetch();
    $conn = null;
    return $arrProduct;
  }

  function delete($sql) {
    $conn = connectDB();
    $conn->exec($sql);
    $conn = null;
  }

  function insert($sql) {
    $conn = connectDB();
    $conn->exec($sql);
    $conn = null;
  }

  function update($sql) {
    $conn = connectDB();
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $conn = null;
  }
?>
