<?php
if ($_POST['user']=="cli" || $_POST['user']=='-'){
    Require_once "../Model/cliente.php";
    $lista=Cliente::getAll($_POST['filtro']);
    $user="{$_POST['user']}";

    echo "
<thead class='thead-dar'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Email</th>
            <th>Telf</th>
        </tr>
        </thead>
        <tbody>";
    foreach ($lista as $item){
       echo "<tr>
          
            <td>{$item['Nombre_cli']}</td>
            <td>{$item['Apellido_cli']}</td>
            <td>{$item['Dni_cli']}</td>
            <td>{$item['email_cli']}</td>
            <td>{$item['Telf_cli']}</td>
            <input type='hidden' id='user'  value={$_POST['user']}>
            <td class='editar' onclick='FormEditar({$item['Id_cli']})'>Editar</td>
            <td class='borrar' onclick='confborrar({$item['Id_cli']})'>Borrar</td>
   </tr>";
    }

        echo "</tbody>";
}else if ($_POST['user']=='cam'){
    echo "<thead class='thead-dar'>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Telf</th>
        </tr>
        </thead>
        <tbody>";

        require_once "../Model/camarero.php";
        $lista=Camarero::getAll($_POST['filtro']);
        foreach ($lista as $item){
            echo  "<tr>
          
            <td>{$item['Nombre_cam']}</td>
            <td>{$item['Apellido_cam']}</td>
            <td>{$item['Dni_cam']}</td>
            <td>{$item['Telf_cam']}</td>
            
            <input type='hidden' id='user'  value={$_POST['user']}>
             <td class='editar' onclick='FormEditar({$item['Id_cam']})'>Editar</td>
             <td class='borrar' onclick='confborrar({$item['Id_cam']})'>Borrar</td>
   </tr>";
        }


    echo "</tbody>";
}else if ($_POST['user']='mesas'){
    echo "<thead class='thead-dar'>
        <tr>
            <th>Id</th>
            <th>Capacidad</th>
            <th>Estado</th>
            <th>Sala</th>
        </tr>
        </thead>
        <tbody>";

    require_once "../Model/mesa.php";
    $lista=Mesa::getAll($_POST['filtro']);
    foreach ($lista as $item){
        echo  "<tr>
          
            <td>{$item['Id_mesa']}</td>
            <td>{$item['capacidad_mesa']}</td>
            <td>{$item['Estado']}</td>
            <td>{$item['nombre_sala']}</td>
                  
            <input type='hidden' id='user'  value={$_POST['user']}>
            <td class='editar2' onclick='FormEditar({$item['Id_mesa']})'>Editar</td>
            <td class='borrar' onclick='confborrar({$item['Id_mesa']})'>Borrar</td>
   </tr>";
    }


    echo "</tbody>";
}


