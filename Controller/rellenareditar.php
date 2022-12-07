<?php


if ($_POST['user']=="cli"){
    require_once "../Model/Cliente.php";
    Cliente::getById($_POST['id']);
}else if ($_POST['user']=='cam'){
    require_once "../Model/camarero.php";
    Camarero::getById($_POST['id']);
}else if ($_POST['user']=="mesas"){
    require_once "../Model/mesa.php";
    Mesa::getById($_POST['id']);
}
