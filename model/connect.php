<?php
function connectDB()
{
  $servername = "localhost";
  $username = "root";
  $databasename = "backend_web2";
  $password = "";

  $conn = mysqli_connect($servername, $username, $password, $databasename);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully";

  return $conn;
}