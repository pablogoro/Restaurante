<?php

if ($_POST['user'] == 'cli') {

} else if ($_POST['user'] == 'cam') {
    echo "<input type='text' name='nombre' id='nombre' placeholder='nombre'>";
    echo "<input type='text' name='apellido' id='apellido' placeholder='apellido'>";
    echo "<input type='text' name='dni' id='dni' placeholder='dni'>";
    echo "<input type='text' name='telf' id='telf' placeholder='telf'>";
    echo "<input type='hidden' name='user' value={$_POST['user']}>";
    echo "</form>";
    echo "<input type='submit' id='submit' onmouseover='crear()'>";
} else {
    echo "<input type='text' name='capacidad' id='capacidad' placeholder='capacidad'>";
    echo "<select type='text' name='estado' id='dni' placeholder='dni'>";
    require_once "../Model/sala.php";
    $ListaSalas = Sala::getAll();
    foreach ($ListaSalas as $salas => $sala) {
        echo "<option value={$sala['Id_sala']}>{$sala['nombre_sala']}</option>";
    }
    echo "</select>";
    echo "<input type='hidden' name='user' value={$_POST['user']}>";
    echo "</form>";
    echo "<input type='submit' id='submit' onmouseover='crear()' >";
}