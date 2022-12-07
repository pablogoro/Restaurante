<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="https://kit.fontawesome.com/20fb0bfa14.js" crossorigin="anonymous"></script>
    <script src="./js/script.js"></script>
        <link rel="stylesheet" href="./css/principal.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
<div class="content">


    <div class="left">
        <form>
            <div class="inputs">
                <input type="date" id="date">
                <select name="time" id="time">
                    <option>-</option>
                    <option>12:00</option>
                    <option>12:30</option>
                    <option>13:00</option>
                    <option>13:30</option>
                    <option>14:00</option>
                    <option>14:30</option>
                    <option>15:00</option>
                    <option>15:30</option>
                    <option>20:00</option>
                    <option>20:30</option>
                    <option>21:00</option>
                    <option>22:00</option>
                    <option>22:30</option>
                </select>
                <select name="salas" id="sala">
                <?php

                require_once "../Model/sala.php";
                $ListaSalas = Sala::getAll();
                foreach ($ListaSalas as $salas => $sala) {
                    echo "<option value={$sala['Id_sala']}>{$sala['nombre_sala']}</option>";
                }
                ?>
                </select>
            </div>
        </form>

        <div class="info-box" id="info-box"></div>
    </div>
    <div class="rigth">
        <div class="contenedor " id="contenedor">

            <?php
            require_once "../Controller/salacontroller.php";
            ?>
        </div>
    </div>

 </div>


<?php

//echo $_SESSION['rol'];
?>
</body>
</html>