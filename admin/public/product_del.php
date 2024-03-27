<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password, "backend_web2");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_cat = 'DELETE FROM `category_details` WHERE product_id="' . $id . '"';
    $result_cat = mysqli_query($conn, $sql_cat);    
    $sql_au = 'DELETE FROM `author_details` WHERE product_id="' . $id . '"';
    $result_au = mysqli_query($conn, $sql_au);
    $sql_receipt = 'DELETE FROM `goodsreceipt_details` WHERE product_id="' . $id . '"';
    $result_receipt = mysqli_query($conn, $sql_receipt);
    $sql_product = 'DELETE FROM `products` WHERE id="' . $id . '"';
    $result_product = mysqli_query($conn, $sql_product);
}


header('location: ../index.php?page=product');
