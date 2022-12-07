<?php
if ($_POST['user']=="cli"){
    require_once "../Model/Cliente.php";


        require "./conexion.php";
        $email=$pdo->quote($_POST['email']);
        $dni=$pdo->quote($_POST['dni']);
        $email=str_replace('\'','',$email);
        $dni=str_replace('\'','',$dni);
        $stmt = $pdo->prepare("SELECT email_cli, Dni_cli FROM `tbl_cliente` WHERE Dni_cli=?");
        $stmt -> bindParam(1,$dni);
        $stmt ->execute();
        $stmt->fetchAll(PDO::FETCH_OBJ);

        if (empty ($_POST['id']) or empty( $_POST['nombre'])  or empty( $_POST['apellido']) or empty($_POST['telf']) or empty($_POST['email'])){
            echo "camposVacios";
        } else if ($stmt -> rowCount() ==0){
            if (empty($_POST['dni'])){
                try {
                    require_once "../Model/cliente.php";
                    Cliente::update2($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['telf'],$_POST['email']);
                    echo "OK";
                }catch (Exception $e){
                    echo "falseCreate";
                }
            }else{
                try {
                    require_once "../Model/cliente.php";
                    Cliente::update($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['telf'],$_POST['email']);
                    echo "OK";
                }catch (Exception $e){
                    echo "falseCreate";
                }
            }

        }else if ($stmt -> rowCount() >0){
            echo "usuarioExiste";
        }else{
            echo "Otro error";
        }

}else if ($_POST['user']=='cam'){
    require_once "../Model/camarero.php";
    require "./conexion.php";
    $email=$pdo->quote($_POST['email']);
    $dni=$pdo->quote($_POST['dni']);
    $email=str_replace('\'','',$email);
    $dni=str_replace('\'','',$dni);
    $stmt = $pdo->prepare("SELECT Dni_cam FROM `tbl_camarero` WHERE Dni_cam=?");
    $stmt -> bindParam(1,$dni);
    $stmt ->execute();
    $stmt->fetchAll(PDO::FETCH_OBJ);

    if (empty ($_POST['id']) or empty( $_POST['nombre'])  or empty( $_POST['apellido']) or empty($_POST['telf']) or empty($_POST['email'])){
        echo "camposVacios";
    } else if ($stmt -> rowCount() ==0){
        if (empty($_POST['dni'])){
            try {
                require_once "../Model/camarero.php";
                $update=Camarero::update2($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['telf'],$_POST['email']);
                echo "OK";
            }catch (Exception $e){
                echo "falseCreate";
            }
        }else{
            try {
                require_once "../Model/camarero.php";
                Camarero::update($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['dni'],$_POST['telf'],$_POST['email']);
                echo "OK";
            }catch (Exception $e){
                echo "falseCreate";
            }
        }

    }else if ($stmt -> rowCount() >0){
        echo "usuarioExiste";
    }else{
        echo "Otro error";
    }
}else if ($_POST['user']=="mesas"){
    require_once "../Model/mesa.php";

    if (empty($_POST['id2']) or empty($_POST['cap']) or empty($_POST['estado']) or empty($_POST['sala'])){
        echo "camposVacios";
    }else{


        $img=explode("fakepath",$_POST['img']);
        $type=explode(".",$img[1]);
        $formato=$type[1];
        if ($formato != "jpeg" && $formato != "jpg" && $formato != "png"){
            echo "formato";
        }
        try {

            require_once "./conexion.php";
            $stmt = $pdo->prepare("SELECT Id_sala FROM `tbl_sala` WHERE nombre_sala=?");
            $stmt -> bindParam(1,$_POST['sala']);
            $stmt ->execute();
            foreach ($stmt as $id){
                $sala=$id;
            }
            Mesa::update($_POST['id2'],$_POST['cap'],$_POST['estado'],$sala['Id_sala'],$img[1]);
            echo "OK";
        }catch (Exception $e){
            echo "falseCreate";

        }
    }

}