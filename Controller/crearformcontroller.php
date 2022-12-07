<?php
if ($_POST['user']=='cli' || $_POST['user']=='cam'){
    echo "<input type='text' name='nombre' id='nombre' placeholder='nombre'>";
    echo "<input type='text' name='apellido' id='apellido' placeholder='apellido'>";
    echo "<input type='text' name='dni' id='dni' placeholder='dni'>";
    echo "<input type='text' name='email' id='email' placeholder='email'>";
    echo "<input type='text' name='telf' id='telf' placeholder='telf'>";
    echo "<input type='password' name='pwd' id='pwd' placeholder='password'>";
    echo "<input type='password' name='conf_pwd' id='conf_password' placeholder='conf_password'>";
    echo "<input type='hidden' name='user' value={$_POST['user']}>";

    echo "</form>";
    echo "<input type='submit' id='submit' onclick='crear()'>";
}else{
    echo "<input type='number' name='capacidad' id='capacidad' placeholder='capacidad'>";
    echo "<select type='text' name='sala' id='sala'>";
     require_once "../Model/sala.php";
                $ListaSalas = Sala::getAll();
                foreach ($ListaSalas as $salas => $sala) {
                    echo "<option value={$sala['Id_sala']}>{$sala['nombre_sala']}</option>";
                }
echo "</select>";
    echo "<input type='hidden' name='user' value={$_POST['user']}>";
    echo "<input type='file' name='img' id='img'>";
    echo "</form>";
    echo "<input type='submit' id='submit' onclick='crear()' >";
}