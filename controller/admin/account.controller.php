<?php
include_once('../../model/connect.php');
include_once('../../model/admin/account.model.php');
if (isset($_POST['function'])) {
  $function = $_POST['function'];
  switch ($function) {
    case 'edit':
      editAccount();
      break;
    case 'password':
      changePass();
      break;
  }
}
function changePass() {
  if(isset($_POST['field'])) {
    echo passEdit($_POST['field']);
  }
}
function editAccount()
{
  if (isset($_POST['field'])) {
    echo account_edit($_POST['field']);
  }
}
