<?php
include_once('../../model/connect.php');

if (isset($_POST['function'])) {
    $function = $_POST['function'];
    switch ($function) {
        case 'render':
            render();
            break;
        case 'renderAuthor':
            renderAuthor();
             break;
    }
    
}
function render()
{
    if (isset($_POST['number_of_item']) && isset($_POST['current_page'])) {
        include_once('../../model/admin/pagnation.model.php');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $render = $_SESSION["render"];

        if(isset($_POST["filter"])) $render->setFilter(getFilterSQL($_POST["filter"]));
        else $render->setFilter("");
        $render->setNumberOfItem($_POST['number_of_item']);
        $render->setCurrentPage($_POST['current_page']);
        echo $render->render();
    }
}
function renderAuthor()
{
    if (isset($_POST['number_of_item']) && isset($_POST['current_page'])) {
        include_once('../../model/admin/pagnation.model.php');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $render = $_SESSION["render"];

        if(isset($_POST["filter"])) $render->setFilter(getAuthorFilterSQL($_POST["filter"]));
        else $render->setFilter("");
        $render->setNumberOfItem($_POST['number_of_item']);
        $render->setCurrentPage($_POST['current_page']);
        echo $render->getFilter();
        echo $render->render();
    }
}
