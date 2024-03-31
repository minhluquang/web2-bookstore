<?php
include_once('../../model/connect.php');
if(isset($_POST['function'])){
    $function = $_POST['function'];
    switch($function){
        case 'render' :
            render();
    }
}
function render(){
    if (isset($_POST['number_of_item']) && isset($_POST['current_page'])) {
        include_once('../../model/admin/pagnation.model.php');
        session_start();
        $render = $_SESSION["render"];
        $render->setNumberOfItem($_POST['number_of_item']);
        $render->setCurrentPage($_POST['current_page']);
        echo $render ->renderProduct();
      }
}