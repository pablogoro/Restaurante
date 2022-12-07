<?php
require_once "../Model/mesa.php";
require_once "../Controller/conexion.php";
session_start();
if (isset($_SESSION['rol']) && $_SESSION['rol']=='cam') {
    if (!isset($_POST['id']) || !isset($_POST['dia'])) {
        $reservadas=[];

        $mesas = Mesa::getAllBySalaId(1,date("Y-m-d"),date("h:i"));
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
    }else{
        $id=$_POST['id'];
        $dia=$_POST['dia'];
        if ($dia==null){
            $dia=date("Y-m-d");
        }
        $fecha=$_POST['tiempo'];
        $id=(int)$id;
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
        $reservadas=[];
        $cont=0;
        $dnis=[];
        require_once "../Model/reservamesa.php";
        $info=ReservaMesa::getbyId2(1,date("Y-m-d"),date("h:i"));
        foreach ($info as $i){
            array_push($dnis,$i['Dni_cli']);
        }

        $mesas = Mesa::getAllBySalaId(1,date("Y-m-d"),date("h:i"));
        foreach ($mesas[1] as $mesa) {
            array_push($reservadas,$mesa['Id_mesa']);

            if (isset($dnis[$cont])){
                $ruta="../Views/img/".$mesa['img'];
                if ($dnis[$cont]==$_SESSION["dni"]){
                    echo "<div class='mesas2 reservada'>";
                    echo "<div class='check'><p class='flex'>MESA: $mesa[Id_mesa]</p><input type='radio' name='mesa'  id='check' value={$mesa['Id_mesa']} onclick='reserva({$mesa['Id_mesa']})'></div>";
                    echo "<p class='flex'>Capacidad: $mesa[capacidad_mesa]</p>";
                    echo "<img src={$ruta}>";
                    echo "</div>";
                }else{
                    echo "<div class='mesas2 reservada'>";
                    echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
                    echo "<p class='flex'>Capacidad: $mesa[capacidad_mesa]</p>";
                    echo "<img src={$ruta}>";
                    echo "</div>";
                }
            }
            $cont ++;
        }
        foreach ($mesas[0] as $mesa){
            if (!in_array($mesa['Id_mesa'],$reservadas)){
                $ruta="../Views/img/".$mesa['img'];
                echo "<div class='mesas2'>";
                echo "<div class='check'><p class='flex'>MESA: $mesa[Id_mesa]</p><input type='radio' name='mesa'  id='check' value={$mesa['Id_mesa']} onclick='reserva({$mesa['Id_mesa']})'></div>";
                echo "<p class='flex'>Capacidad: $mesa[capacidad_mesa]</p>";
                echo "<img src={$ruta}>";

                echo "</div>";
            }
        }
    }else{
        $id=$_POST['id'];
        $dia=$_POST['dia'];
        if ($dia==null){
            $dia=date("Y-m-d");
        }
        $fecha=$_POST['tiempo'];

        $dnis=[];
        require_once "../Model/reservamesa.php";
        $info=ReservaMesa::getbyId2($id,$dia,$_POST['tiempo']);
        foreach ($info as $i){
            array_push($dnis,$i['Dni_cli']);
        }
        $mesas=Mesa::getAllBySalaId($id,$dia,$fecha);
        $reservadas=[];
        $cont=0;

        foreach ($mesas[1] as $mesa) {
            array_push($reservadas,$mesa['Id_mesa']);

            $id=(int)$_POST['id'];

            if ($_POST['dia']==null){
                $dia=date("Y-m-d");
            }else{
                $dia=$_POST['dia'];
            }
            $ruta="../Views/img/".$mesa['img'];
             if (isset($dnis[$cont])){
                 if ($dnis[$cont]==$_SESSION["dni"]){
                     echo "<div class='mesas2 reservada'>";
                     echo "<div class='check'><p class='flex'>MESA: $mesa[Id_mesa]</p><input type='radio' name='mesa'  id='check' value={$mesa['Id_mesa']} onclick='reserva({$mesa['Id_mesa']})'></div>";
                     echo "<p class='flex'>MESA: $mesa[capacidad_mesa]</p>";
                     echo "<img src={$ruta}>";
                     echo "</div>";
                 }else{
                     echo "<div class='mesas2 reservada'>";
                     echo "<p class='flex'>MESA: $mesa[Id_mesa]</p>";
                     echo "<img src={$ruta}>";
                     echo "<p class='flex'>Capacidad: $mesa[capacidad_mesa]</p>";
                     echo "</div>";
                 }
             }


            $cont ++;
        }
        foreach ($mesas[0] as $mesa){
            if (!in_array($mesa['Id_mesa'],$reservadas)){
                $ruta="../Views/img/".$mesa['img'];
                echo "<div class='mesas2'>";
                echo "<div class='check'><p class='flex'>MESA: $mesa[Id_mesa]</p><input type='radio' name='mesa'  id='check' value={$mesa['Id_mesa']} onclick='reserva({$mesa['Id_mesa']})'></div>";
                echo "<p class='flex'>MESA: $mesa[capacidad_mesa]</p>";
                echo "<img src={$ruta}>";
                echo "</div>";
            }
        }


    }


}
