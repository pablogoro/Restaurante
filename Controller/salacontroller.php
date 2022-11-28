<?php
require_once "../Model/mesa.php";
require_once "../Controller/conexion.php";
session_start();
if (isset($_SESSION['rol']) && $_SESSION['rol']=='cam') {
    if (!isset($_POST['id']) || !isset($_POST['dia'])) {

        $mesas = Mesa::getAllBySalaId(1,date("Y-m-d"),date("h:i"));
        foreach ($mesas[0] as $mesa) {
            echo "<div class='mesas'>";


            echo "<img src='./img/4disponible.png' class='libre' onclick='reserva({$mesa['Id_mesa']})'>";
            echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
            echo "</div>";
        }
    }else{
        $id=$_POST['id'];
        $dia=$_POST['dia'];
        if ($dia==null){
            $dia=date("Y-m-d");
        }
        $fecha=$_POST['tiempo'];

        $mesas=Mesa::getAllBySalaId($id,$dia,$fecha);
        $reservadas=[];

        foreach ($mesas[1] as $mesa) {
            array_push($reservadas,$mesa['Id_mesa']);

            echo "<div class='mesas'>";
            echo "<img src='./img/4ocupado.png' class='ocupada' onclick='reserva({$mesa['Id_mesa']})'>";
            echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
            echo "</div>";
        }
        foreach ($mesas[0] as $mesa){
            if (!in_array($mesa['Id_mesa'],$reservadas)){

                echo "<div class='mesas'>";
                echo "<img src='./img/4disponible.png' class='libre' onclick='reserva({$mesa['Id_mesa']})'>";
                echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
                echo "</div>";
            }
        }


    }

} elseif (isset($_SESSION['rol']) && $_SESSION['rol']=='cli'){

    if (!isset($_POST['id']) || !isset($_POST['dia'])) {

        $mesas = Mesa::getAllBySalaId(1,date("Y-m-d"),date("h:i"));
        foreach ($mesas[0] as $mesa) {
            echo "<div class='mesas2'>";


            echo "<img src='./img/4disponible.png' class='libre' onclick='reserva({$mesa['Id_mesa']})'>";
            echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
            echo "</div>";
        }
    }else{
        $id=$_POST['id'];
        $dia=$_POST['dia'];
        if ($dia==null){
            $dia=date("Y-m-d");
        }
        $fecha=$_POST['tiempo'];

        $mesas=Mesa::getAllBySalaId($id,$dia,$fecha);
        $reservadas=[];

        foreach ($mesas[1] as $mesa) {
            array_push($reservadas,$mesa['Id_mesa']);

            echo "<div class='mesas2'>";
            echo "<img src='./img/4ocupado.png' class='ocupada' onclick='reserva({$mesa['Id_mesa']})'>";
            echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
            echo "</div>";
        }
        foreach ($mesas[0] as $mesa){
            if (!in_array($mesa['Id_mesa'],$reservadas)){

                echo "<div class='mesas2'>";
                echo "<img src='./img/4disponible.png' class='libre' onclick='reserva({$mesa['Id_mesa']})'>";
                echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
                echo "</div>";
            }
        }


    }


}
