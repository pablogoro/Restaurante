<?php

class Sala{
    private $id;
    private $capacidad;
    private $nombre;

    public function __construct($id,$capacidad,$nombre){
        $this->id=$id;
        $this->capacidad=$capacidad;
        $this->nombre=$nombre;

    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of capacidad
     */ 
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set the value of capacidad
     *
     * @return  self
     */ 
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    public static function getAll (){
        require "../controller/conexion.php";


        try {
            $stmt=$pdo->prepare("SELECT  * FROM tbl_sala");
            $stmt->execute();
            return $stmt;
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las salas')</script>";
        }


    }

   public static function nameById(int $id){
       require "../controller/conexion.php";


       try {
           $stmt=$pdo->prepare("SELECT nombre_sala FROM tbl_sala where Id_sala=?");
           $stmt -> bindparam( 1,$id);
           $stmt->execute();
           $resultado= $stmt -> fetch(PDO::FETCH_ASSOC);
           return $resultado;
       }catch (Exception $e){
           echo "<script>alert('Error al mostrar datos de las salas')</script>";
       }

   }
}