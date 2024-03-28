<?php
include_once('connect.php');
$conn = connectDB();
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql_details = 'DELETE FROM `order_details` WHERE order_id="' . $id . '"';
    $result_details = mysqli_query($conn, $sql_details);
    $sql_order = 'DELETE FROM `orders` WHERE id="' . $id . '"';
    $result_order = mysqli_query($conn, $sql_order);
}


header('location: ../admin/index.php?page=order');
