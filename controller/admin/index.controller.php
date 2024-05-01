<?php
  session_start();

  if (isset($_POST['isLogout']) && $_POST['isLogout']) {
    try {
      unset($_SESSION['usernameAdmin']);
      echo true;
    } catch (\Throwable $th) {
      echo false;
    }
  }
?>