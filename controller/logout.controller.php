<?php
  session_start();
  ob_start();

  if (isset($_POST['logoutRequest']) && $_POST['logoutRequest'] == true) {
    session_unset();
    session_destroy();
  }
?>