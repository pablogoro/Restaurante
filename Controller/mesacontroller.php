<?php
require_once "../Model/reservamesa.php";
session_start();
if ($_SESSION['rol']=='cam'){

    $id=(int)$_POST['id'];

    if ($_POST['dia']==null){
        $dia=date("Y-m-d");
    }else{
        $dia=$_POST['dia'];
    }
    $mesas=ReservaMesa::getbyId($id,$dia,$_POST['tiempo']);
    foreach ($mesas as $info){
        $reserva=true;
        echo "<div class='info-content'>
    <h5>MESA:{$info['Id_mesa']}<h5>
    <p>Ocupacion:{$info['Ocupacion_rm']}<p>
    <p>{$info['Nombre_cli']}<p>
    <p>{$info['Apellido_cli']}<p>
    <p>{$info['Dni_cli']}<p>
    <p>{$info['email_cli']}<p>
    <p>{$info['Telf_cli']}<p>
    
</div>";
        echo "<div class='info-footter'>
     
    <button onclick='cerrar({$info['Id_mesa']})'>Cerrar Reserva</button>
</div>";
    }


    if (!isset($reserva)){
        echo "<div class='info-content'>
<form id='formreserva'>
    <h5>MESA:{$_POST['id']}</h5>
    <input type='text' placeholder='DNI' name='dni'>
    <input type='text' placeholder='telf' name='telf'>
    <input type='text' placeholder='ocupacion' name='ocupacion'>
    <input type='hidden' value={$_POST['id']} id='mesa_id'>
</form>
</div>";
        echo "<div class='info-footter'>
    <button id='crearReserva' onclick='crearReserva({$_POST['id']})'>Crear Reserva</button>
</div>";
    }
}else{

    $id=(int)$_POST['id'];

    if ($_POST['dia']==null){
        $dia=date("Y-m-d");
    }else{
        $dia=$_POST['dia'];
    }
    $mesas=ReservaMesa::getbyId($id,$dia,$_POST['tiempo']);
    foreach ($mesas as $info){
        $reserva=true;
        echo "<div class='info-content'>
    <h5>MESA:{$info['Id_mesa']}<h5>
    <p>Ocupacion:{$info['Ocupacion_rm']}<p>
    <p>{$info['Nombre_cli']}<p>
    <p>{$info['Apellido_cli']}<p>
    <p id='dni'>{$info['Dni_cli']}<p>
    <p>{$info['email_cli']}<p>
    <p>{$info['Telf_cli']}<p>
    
</div>";
        echo "<div class='info-footter'>
     
    <button onclick='cerrar({$info['Id_mesa']})'>Cerrar Reserva</button>
</div>";
    }


    if (!isset($reserva)){
        echo "<div class='info-content'>
<form id='formreserva'>
    <h5>MESA:{$_POST['id']}</h5>
    <p class='reserva-info'>{$_SESSION['dni']}</p>
    <p class='reserva-info'></p>
    <input type='text' placeholder='telf' name='telf' value='{$_SESSION['telf']}'>
    <input type='number' placeholder='ocupacion' id='ocu' name='ocupacion'>
    <input type='hidden' value={$_POST['id']} id='mesa_id'>
</form>
</div>";
        echo "<div class='info-footter'>
    <button id='crearReserva' onclick='crearReserva({$_POST['id']})'>Crear Reserva</button>
</div>";
    }
}

