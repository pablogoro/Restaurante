<?php

function registroCamposVacios($correo,$contraseña){
    if(empty($correo)||empty($contraseña)){
        $error = true;
    }else{
        $error=false;
    }
    return $error;
}

function errorEmail($correo){
    if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
        $error = true;
    }else{
        $error=false;
    }
    return $error;
}

function checkusername($username,$conexion){
   $sql3="SELECT * FROM tbl_profesores WHERE correo_profe = ? and contraseña_profe = ?";
   $stmt=mysqli_stmt_init($conexion);
   
   if(!mysqli_stmt_prepare($stmt,$sql3)){
       header('Location:../registro.php?error=errorconexion');
    exit();

}
   mysqli_stmt_bind_param($stmt,"s",$correo,$passwordHash);
    mysqli_stmt_execute($stmt);
    $resultadoconsulta=mysqli_stmt_get_result($stmt);
    if($row=mysqli_fetch_assoc($resultadoconsulta)){
        $row=true;
    }else{
        $error=false;
    }
    mysqli_stmt_close($stmt);
    return $error;
}

function checkEmail($correo_alu) {
    $connection = mysqli_connect("localhost", "root", "", "bd_sintesi");
    $sql4="SELECT * FROM tbl_alumnos WHERE correo_alu = $correo_alu";
    $resultado1 = mysqli_query($connection,$sql4);
    if($resultado1==true){
        $error=true;
    }else{
        $error=false;
    }
    return $error;
}

function validaDNI($dni) {
    if (strlen($dni)<9){
        $error=true;
    }else{
        $partes = str_split($dni,8);
        $numeros = $partes[0];
        $letra = strtoupper($partes[1]);
        if (substr("TRWAGMYFPDXBNJZSQVHLCKE",$numeros%23,1) == $letra){
            $error=false;
        }else{
            $error=true;
        }

    }
    return $error;
    }
