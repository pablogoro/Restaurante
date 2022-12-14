<?php
Require_once "persona.php";
require_once "iuser.php";
final class Cliente extends Persona implements IUser
{
    protected $email;


    public function __construct($id, $nombre, $apellido, $dni, $telf, $password, $email)
    {
        $this->email = $email;
        parent::__construct($id, $nombre, $apellido, $dni, $telf, $password);
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public static function getAll($filtro){
        require_once "../Controller/conexion.php";
        $filtro=$pdo->quote($filtro);
        $filtro=str_replace('\'','',$filtro);
        $stmt=$pdo->prepare("SELECT * FROM `tbl_cliente` WHERE Id_cli LIKE '%".$filtro."%' OR Nombre_cli LIKE '%".$filtro."%' OR Apellido_cli LIKE '%".$filtro."%' OR Dni_cli LIKE '%".$filtro."%' OR email_cli LIKE '%".$filtro."%' OR telf_cli LIKE '%".$filtro."%'");
        $stmt->execute();

        return $stmt;
    }

    public static function getById($id){
        require_once "../Controller/conexion.php";
        $stmt=$pdo->prepare("SELECT `Id_cli` as id, `Nombre_cli` as nombre, `Apellido_cli` as apellido, `Dni_cli` as dni, `email_cli` as email, `Telf_cli` as telf FROM `tbl_cliente` WHERE Id_cli = $id ");
        $stmt->execute();
        $stmt=$stmt->fetch(PDO::FETCH_ASSOC);


        echo json_encode($stmt) ;
    }

    public static function getIdbyDni($dni){
        require "../Controller/conexion.php";
        $dni1=$pdo->quote($dni);
        $stmt=$pdo->prepare("SELECT Id_cli FROM `tbl_cliente` WHERE Dni_cli=$dni1");
        //$stmt -> bindParam(1,$dni1);
        $stmt->execute();
        $stmt=$stmt->fetch(PDO::FETCH_ASSOC);
        return $stmt;
    }
    public function create( $nombre, $apellido, $dni, $telf, $password, $email)
    {
        require "../Controller/conexion.php";

        new Cliente(null,$nombre,$apellido,$dni,$telf,$password,$email);
        // echo "$alu->nombre";
        $stmt=$pdo->prepare("INSERT INTO `tbl_cliente`(`Id_cli`, `Nombre_cli`, `Apellido_cli`, `Dni_cli`, `email_cli`, `Telf_cli`, `Password_cli`) VALUES (null,?,?,?,?,?,?)");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$dni);
        $stmt -> bindParam(4,$email);
        $stmt -> bindParam(5,$telf);
        $stmt -> bindParam(6,$password);
        $stmt->execute();



    }

    public function delete(int $id)
    {
        require "../Controller/conexion.php";
        $stmt=$pdo->prepare("DELETE FROM `tbl_cliente` WHERE Id_cli=?");
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
        $stmt=$pdo->prepare("UPDATE `tbl_cliente` SET `Nombre_cli`=?,`Apellido_cli`=?,`Dni_cli`=?,`email_cli`=?,`Telf_cli`=? WHERE Id_cli=? ");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$dni);
        $stmt -> bindParam(4,$email);
        $stmt -> bindParam(5,$telf);
        $stmt -> bindParam(6,$id);
        $stmt->execute();
    }
    public function update2(int $id, $nombre, $apellido,$telf,$email)
    {
        require "../Controller/conexion.php";
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
        $stmt=$pdo->prepare("UPDATE `tbl_cliente` SET `Nombre_cli`=?,`Apellido_cli`=?,`email_cli`=?,`Telf_cli`=? WHERE Id_cli=? ");
        $stmt -> bindParam(1,$nombre);
        $stmt -> bindParam(2,$apellido);
        $stmt -> bindParam(3,$email);
        $stmt -> bindParam(4,$telf);
        $stmt -> bindParam(5,$id);
        $stmt->execute();
    }
}