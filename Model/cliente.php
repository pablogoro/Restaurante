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

        // TODO: Implement delete() method.
    }

    public function update(int $id)
    {
        // TODO: Implement update() method.
    }
}