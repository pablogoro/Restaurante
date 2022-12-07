<?php
if ($_POST['user']=="cli"){
    require_once "../Model/cliente.php";
    try {
        Cliente::delete($_POST['id']);
        echo "ok";
    }catch (Exception $e){
        echo "mal";
    }
}else if ($_POST['user']=='cam'){
    require_once "../Model/camarero.php";
    try {
        Camarero::delete($_POST['id']);
        echo "ok";
    }catch (Exception $e){
        echo "mal";
    }
}else if ($_POST['user']=="mesas"){
    require_once "../Model/mesa.php";
    try {
        Mesa::delete($_POST['id']);
        echo "ok";
    }catch (Exception $e){
        echo "mal";
    }

}