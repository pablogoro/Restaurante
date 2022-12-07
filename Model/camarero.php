<?php
Require_once "persona.php";
require_once "iuser.php";
final class Camarero extends Persona implements IUser
{



    public function __construct($id, $nombre, $apellido, $dni, $telf, $password, $email)
    {
        parent::__construct($id, $nombre, $apellido, $dni, $telf, $password);
    }

    public static function getAll($filtro){
        require_once "../Controller/conexion.php";
        $filtro=$pdo->quote($filtro);
        $filtro=str_replace('\'','',$filtro);
        $stmt=$pdo->prepare("SELECT * FROM `tbl_camarero` WHERE Id_cam LIKE '%".$filtro."%' OR Nombre_cam LIKE '%".$filtro."%' OR Apellido_cam LIKE '%".$filtro."%' OR Dni_cam LIKE '%".$filtro."%' OR telf_cam LIKE '%".$filtro."%'");
        $stmt->execute();

        return $stmt;
    }

    public static function getById($id){
        require_once "../Controller/conexion.php";
        $stmt=$pdo->prepare("SELECT Id_cam as id, `Nombre_cam` as nombre, `Apellido_cam` as apellido, `Dni_cam` as dni, `Telf_cam` as telf FROM `tbl_camarero`WHERE Id_cam = $id ");
        $stmt->execute();
        $stmt=$stmt->fetch(PDO::FETCH_ASSOC);


        echo json_encode($stmt) ;
    }

    public function create( $nombre, $apellido, $dni, $telf, $password, $email)
    {
        require "../Controller/conexion.php";

        new Camarero(null,$nombre,$apellido,$dni,$telf,$password,$email);
        // echo "$alu->nombre";
        $stmt=$pdo->prepare("INSERT INTO `tbl_camarero`(`Id_cam`, `Nombre_cam`, `Apellido_cam`, `Dni_cam`, `Telf_cam`, `email_cam`,`Password_cam`) VALUES (null,?,?,?,?,?,?)");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$dni);
        $stmt -> bindParam(4,$telf);
        $stmt -> bindParam(5,$email);
        $stmt -> bindParam(6,$password);
        $stmt->execute();



    }
    public function delete(int $id)
    {
        require "../Controller/conexion.php";
        $stmt=$pdo->prepare("DELETE FROM `tbl_camarero` WHERE Id_cam=?");
        $stmt -> bindParam(1,$id);
        $stmt->execute();


    }



    public function update(int $id, $nombre, $apellido,$dni,$telf,$email)
    {
        require "../Controller/conexion.php";
        $id=$pdo->quote($id);
        $nombre=$pdo->quote($nombre);
        $apellido=$pdo->quote($apellido);
        $dni=$pdo->quote($dni);
        $telf=$pdo->quote($telf);
        $email=$pdo->quote($email);
        $id=str_replace('\'','',$id);
        $nombre=str_replace('\'','',$nombre);
        $apellido=str_replace('\'','',$apellido);
        $dni=str_replace('\'','',$dni);
        $telf=str_replace('\'','',$telf);
        $email=str_replace('\'','',$email);
        $stmt=$pdo->prepare("UPDATE `tbl_camarero` SET `Nombre_cam`=?,`Apellido_cam`=?,`Dni_cam`=?,`email_cam`=?,`Telf_cam`=? WHERE Id_cam=? ");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$dni);
        $stmt -> bindParam(4,$email);
        $stmt -> bindParam(5,$telf);
        $stmt -> bindParam(6,$id);
        $stmt->execute();
    }
    public function update2(int $id, $nombre, $apellido,$telf,$email)
    { require "../Controller/conexion.php";
        $id=$pdo->quote($id);
        $nombre=$pdo->quote($nombre);
        $apellido=$pdo->quote($apellido);
        $telf=$pdo->quote($telf);
        $email=$pdo->quote($email);
        $id=str_replace('\'','',$id);
        $nombre=str_replace('\'','',$nombre);
        $apellido=str_replace('\'','',$apellido);
        $telf=str_replace('\'','',$telf);
        $email=str_replace('\'','',$email);
        $stmt=$pdo->prepare("UPDATE `tbl_camarero` SET `Nombre_cam`=?,`Apellido_cam`=?,`email_cam`=?,`Telf_cam`=? WHERE Id_cam=? ");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$email);
        $stmt -> bindParam(4,$telf);
        $stmt -> bindParam(5,$id);
        $stmt->execute();

    }


}