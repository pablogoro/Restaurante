<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LOGVAL</title>
</head>
<body>
<?php

if(isset($_GET['error'])){
    if($_GET['error']=='camposvacios'){
        echo "<script>Swal.fire({
            icon: 'warning',
            title: 'CAMPOS VACIOS',
            text: 'Recuarda rellenarlos todos',
            showConfirmButton: false,
            timer: 2000
          })</script>";
        echo "<script>function vuelta(){
            window.location.href = '../Index.php' 
            }
            setTimeout(vuelta,2000)</script>";
    }
}

// if(isset($_GET['error'])){
//     if($_GET['error']=='erroremail'){
//         echo "email no es correcto. ";
//     }
// }

// if(isset($_GET['error'])){
//     if($_GET['error']=='checkemail'){
//         echo "El email ya esta introducido en la base de datos. ";
//     }
// }

if(isset($_GET['error'])){
    if($_GET['error']=='errorconexion'){
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'ERROR DE CONEXION',
            text: 'La base de datos esta fallando',
            showConfirmButton: false,
            timer: 2000
          })</script>";
        echo "<script>function vuelta(){
            window.location.href = '../Index.php' 
            }
            setTimeout(vuelta,2000)</script>";
    }
}

if(isset($_GET['error'])){
    if($_GET['error']=='validadni'){
        echo "<script>Swal.fire({
            icon: 'warning',
            title: 'DNI INCORRECTO',
            text: 'Introduce un dni valido',
            showConfirmButton: false,
            timer: 2000
          })</script>";
        echo "<script>function vuelta(){
            window.location.href = '../Index.php' 
            }
            setTimeout(vuelta,2000)</script>";
    }
}
?>

</body>
</html>