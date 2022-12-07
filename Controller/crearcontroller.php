<?php

if ($_POST['user']=='cli'){
    require_once "../Controller/conexion.php";
    $nombre=$pdo->quote($_POST['nombre']);
    $apellido=$pdo->quote($_POST["apellido"]);
    $dni=$pdo->quote($_POST["dni"]);
    $telf=$pdo->quote($_POST["telf"]);
    $email=$pdo->quote($_POST["email"]);
    $password=$pdo->quote($_POST["pwd"]);
    $conf=$pdo->quote($_POST["conf_pwd"]);
    $nombre=str_replace('\'','',$nombre);
    $apellido=str_replace( '\'','',$apellido);
    $dni=str_replace('\'','',$dni);
    $telf=str_replace('\'','',$telf);
    $email=str_replace('\'','',$email);
    $password=str_replace('\'','',$password);
    $conf=str_replace('\'','',$conf);

    $stmt = $pdo->prepare("SELECT email_cli, Dni_cli FROM `tbl_cliente` WHERE Dni_cli=? or email_cli=?");
    $stmt -> bindParam(1,$dni);
    $stmt -> bindParam(2,$password);
    $stmt ->execute();
    $stmt->fetchAll(PDO::FETCH_OBJ);
    if (empty($nombre) or empty($apellido) or empty($dni) or empty($telf) or empty($email) or empty($password) or empty($conf)){
        echo "camposVacios";
    } else if ($stmt -> rowCount() ==0 && ($password===$conf) ){
        try {
            require_once "../Model/cliente.php";
            Cliente::create($nombre,$apellido,$dni,$telf,$password,$email);
            echo "OK";
        }catch (Exception $e){
            echo "falseCreate";
        }

    }else if ($password !== $conf && $stmt -> rowCount() ==0){
        echo "contraseña";

    }else if ($stmt -> rowCount() >0){
        echo "usuarioExiste";
    }else{
        echo "Otro error";
    }

}else if ($_POST['user']=='cam'){
    require_once "../Controller/conexion.php";
    $nombre=$pdo->quote($_POST['nombre']);
    $apellido=$pdo->quote($_POST["apellido"]);
    $dni=$pdo->quote($_POST["dni"]);
    $telf=$pdo->quote($_POST["telf"]);
    $email=$pdo->quote($_POST["email"]);
    $password=$pdo->quote($_POST["pwd"]);
    $conf=$pdo->quote($_POST["conf_pwd"]);
    $nombre=str_replace('\'','',$nombre);
    $apellido=str_replace( '\'','',$apellido);
    $dni=str_replace('\'','',$dni);
    $telf=str_replace('\'','',$telf);
    $email=str_replace('\'','',$email);
    $password=str_replace('\'','',$password);
    $conf=str_replace('\'','',$conf);

    $stmt = $pdo->prepare("SELECT email_cam, Dni_cam FROM `tbl_camarero` WHERE Dni_cam=? or email_cam=?");
    $stmt -> bindParam(1,$dni);
    $stmt -> bindParam(2,$email);
    $stmt ->execute();
    $stmt->fetchAll(PDO::FETCH_OBJ);
    if (empty($nombre) or empty($apellido) or empty($dni) or empty($telf) or empty($email) or empty($password) or empty($conf)){
        echo "camposVacios";
    } else if ($stmt -> rowCount() ==0 && ($password===$conf) ){
        try {
            require_once "../Model/camarero.php";
            Camarero::create($nombre,$apellido,$dni,$telf,$password,$email);
            echo "OK";
        }catch (Exception $e){
            echo "falseCreate";
        }

    }else if ($password !== $conf && $stmt -> rowCount() ==0){
        echo "contraseña";

    }else if ($stmt -> rowCount() >0){
        echo "usuarioExiste";
    }else{
        echo "Otro error";
    }

}else if ($_POST['user']=="mesas"){
    require_once "../Model/mesa.php";


    if (empty($_POST['capacidad']) or empty($_POST['sala']) or empty($_POST['img'])){
        echo "camposVacios";
    }else{

        $nombre= $_FILES['img']['name'];
        $type=explode("/",$_FILES['img']['type']);
        $formato=$type[1];
        if ($formato != "jpeg" && $formato != "jpg" && $formato != "png"){
            echo "formato";
        }else{


            if (!file_exists("../Views/img/$nombre")){
                move_uploaded_file( $_FILES['img']['tmp_name'],"../Views/img/$nombre");
            }
        }
        try {
            Mesa::create($_POST['capacidad'],$_POST['sala'],$nombre);
            echo "OK";
        }catch (Exception $e){
            echo "falseCreate";

        }
    }

}
