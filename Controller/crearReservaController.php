<?php
session_start();
require_once "./conexion.php";
$sql="SELECT `capacidad_mesa` FROM `tbl_mesa` WHERE Id_mesa=?";
$stmt=$pdo->prepare($sql);
$stmt -> bindparam( 1,$_POST['mesa']);
$stmt->execute();
$stmt=$stmt->fetch(PDO::FETCH_ASSOC);

if (($_POST['ocu']<$stmt['capacidad_mesa'] && $_POST['ocu']>0) || $_POST['ocu']!=null){
    if ($_SESSION['rol']=="cam"){

        if ($_POST['tiempo']=="-"){
            $tiempo=date("G:i");
        }else{
            $tiempo=$_POST['tiempo'];
        }
        if ($_POST['dia']==null){
            $dia=date("Y-m-d");
        }else{
            $dia=$_POST['dia'];
        }

        if ($tiempo<date("G:i") || $dia<date("Y-m-d")){

            echo "mal";
        }else {
            require_once "../Model/reservamesa.php";
            require_once "../Model/cliente.php";
            $cliente = Cliente::getIdbyDni($_POST['dni']);
            $clienteId = $cliente["Id_cli"];

            if ($clienteId == "" || !isset($clienteId)) ;
            {
                $clienteId = 11;
            }

            try {
                $reserva = ReservaMesa::crear($_POST['mesa'], $_SESSION['dni'], $cliente, $dia, $tiempo, $_POST['ocupacion']);
                echo "bien";
            }catch (Exception $e){

            }

        }
    }else{
        if ($_POST['tiempo']=="-"){
            $tiempo=date("G:i");
        }else{
            $tiempo=$_POST['tiempo'];
        }
        if ($_POST['dia']==null){
            $dia=date("Y-m-d");
        }else{
            $dia=$_POST['dia'];
        }
        if (( $dia==date("Y-m-d") && $tiempo<date("G:i")) || $dia<date("Y-m-d")){

            echo "mal";
        }else {
            require_once "../Model/reservamesa.php";
            require_once "../Model/cliente.php";
            $cliente = Cliente::getIdbyDni($_SESSION['dni']);
            $clienteId = $cliente["Id_cli"];

            if ($clienteId == "" || !isset($clienteId)) ;
            {
                $clienteId = 11;
            }

            try {
                $reserva = ReservaMesa::crear($_POST['mesa'],'Online' , $cliente, $dia, $tiempo, $_POST['ocupacion']);
                echo "bien";
            }catch (Exception $e){

            }

        }


    }
}else{
    echo "ocu";
}
