<?php
require_once('connect.php');
$conn = connectDB();
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


header('location: ../admin/index.php?page=product');
