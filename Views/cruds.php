<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cruds</title>
    <script src="https://kit.fontawesome.com/20fb0bfa14.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/principal.css">
    <script src="./js/scriptCruds.js"></script>

</head>
<body>

<nav>
    <div class="nav_head">
        <i class="fa-solid fa-user"></i>
    </div>
    <div class="nav_fotter">
        <i class="fa-solid fa-right-from-bracket" id="logOut"></i>
    </div>
</nav>
<form id="frm">
    <select name="select" id="select">
        <option value="cli">-</option>
        <option value="cli">Clientes</option>
        <option value="cam">Camareros</option>
        <option value="mesas">Mesas</option>
    </select>

    <input type='text' id='buscar'>
    <input type="button" value="crear" id="registrar">
    <table class="table table-hover table-resposive" id="resultado">


    </table>


</form>

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="form-crear"  enctype="multipart/formdata"></form>

    </div>

</div>

<div id="myModal2" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="form-crear2">
            <input type='text' name='nombre' id='nombre' placeholder='nombre'>
            <input type='hidden' name='id' id='id'>

             <input type='text' name='apellido' id='apellido' placeholder='apellido'>
             <input type='text' name='dni' id='dni' placeholder='dni'>
             <input type='text' name='email' id='email' placeholder='email'>
             <input type='text' name='telf' id='telf' placeholder='telf'>
        </form>
        <input value="actualizar"  type='button' id='submit' onclick='editar()'>

    </div>
</div>

<div id="myModal3" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <form id="form-crear3">
            <input type='hidden' name='id' id='id2'>
            <select  name='estado' id='estado' placeholder='Estado'>   <option>ok</option> <option>mantenimiento</option>   </select>
            <input type='text' name='capacidad' id='capacidad' placeholder='capacidad'>
            <select name="salas" id="sala">
                <?php

                require_once "../Model/sala.php";
                $ListaSalas = Sala::getAll();
                foreach ($ListaSalas as $salas => $sala) {
                    echo "<option>{$sala['nombre_sala']}</option>";
                }
                ?>
            </select>

        </form>
        <input  value="actualizar"  type='button' id='submit' onclick='editar()'>
    </div>
</div>
</body>
</html>