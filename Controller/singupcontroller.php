<?php
//var_dump($_POST);
require_once "./conexion.php";

$nombre=$pdo->quote($_POST['nombre']);
$apellido=$pdo->quote($_POST["apellido"]);
$dni=$pdo->quote($_POST["dni"]);
$telf=$pdo->quote($_POST["telf"]);
$email=$pdo->quote($_POST["email"]);
$password=$pdo->quote($_POST["password"]);
$conf=$pdo->quote($_POST["conf_password"]);
$nombre=str_replace('\'','',$nombre);
$apellido=str_replace( '\'','',$apellido);
$dni=str_replace('\'','',$dni);
$telf=str_replace('\'','',$telf);
$email=str_replace('\'','',$email);
$password=str_replace('\'','',$password);
$conf=str_replace('\'','',$conf);

$stmt = $pdo->prepare("SELECT email_cli Dni_cli FROM `tbl_cliente` WHERE Dni_cli=? or email_cli=?");
$stmt -> bindParam(1,$dni);
$stmt -> bindParam(2,$password);
$stmt ->execute();
$stmt->fetchAll(PDO::FETCH_OBJ);
if (empty($nombre) or empty($apellido) or empty($dni) or empty($telf) or empty($email) or empty($password) or empty($conf)){
  echo "camposVacios";
} else if ($stmt -> rowCount() ==0 && ($password===$conf) ){
    try {
        require_once "../Model/cliente.php";
        Cliente::create($nombre,$apellido,$dni,$telf,$password,$email);
        echo "OK";
    }catch (Exception $e){
        echo "falseCreate";
    }

}else if ($password !== $conf && $stmt -> rowCount() ==0){
   echo "contraseña";

}else if ($stmt -> rowCount() >0){
    echo "usuarioExiste";
}else{
    echo "Otro error";
}