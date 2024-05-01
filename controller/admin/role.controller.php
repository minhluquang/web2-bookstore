<?php
include_once('../../model/connect.php');
include_once('../../model/admin/role.model.php');
if (isset($_POST['function'])) {
  $function = $_POST['function'];
  switch ($function) {
    case 'delete':
      deleteRole();
      break;
    case 'create':
      createRole();
      break;
    case 'edit':
      editRole();
      break;
  }
}
function deleteRole()
{
  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $delete_result = role_delete($id);
    echo $delete_result;
  }
}
function createRole()
{
  if (isset($_POST['field'])) {
    echo role_create($_POST['field']);
  }
}
function editRole()
{
  if (isset($_POST['field'])) {
    echo role_edit($_POST['field']);
  }
}
