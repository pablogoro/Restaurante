    <?php

class Mesa{
    private $id;
    private $capacidad;
    private $estado;
    private $sala;

    public function __construct($id,$capacidad,$estado,$sala){
        $this->id=$id;
        $this->capacidad=$capacidad;
        $this->esatdo=$estado;
        $this->sala=$sala;

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
     * Get the value of estado
     */ 
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set the value of estado
     *
     * @return  self
     */ 
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get the value of sala
     */ 
    public function getSala()
    {
        return $this->sala;
    }

    /**
     * Set the value of sala
     *
     * @return  self
     */ 
    public function setSala($sala)
    {
        $this->sala = $sala;

        return $this;
    }

    // public function cambiarEstadoMesa(){

    // }
    public static function getAll($filtro){
        require_once "../Controller/conexion.php";
        $filtro=$pdo->quote($filtro);
        $filtro=str_replace('\'','',$filtro);
        $stmt=$pdo->prepare("SELECT * FROM `tbl_mesa` INNER JOIN tbl_sala on tbl_sala.Id_sala=tbl_mesa.Sala WHERE Id_mesa LIKE '%".$filtro."%' OR capacidad_mesa LIKE '%".$filtro."%' OR Estado LIKE '%".$filtro."%' OR tbl_sala.nombre_sala LIKE '%".$filtro."%'");
        $stmt->execute();

        return $stmt;
    }
    public static function getAllBySalaId (int $id, $dia, $hora ){
        require "../controller/conexion.php";
        $idB= $pdo->quote($id);
        $idS=str_replace('\'','',$idB);
        $diaB= $pdo->quote($dia);
        if ($hora=="-"){
            $horaB=date("h:i:s");
        }else{
            $horaB= $pdo->quote($hora);

        }

        $horaS=str_replace('\'','',$horaB);

        $horaS=str_replace('\"','',$horaS);

        $min=explode(":",$horaS);
        $min[1]= $min[0]*60 + $min[1];
        $horaAtras=$min[1]-60;

        $horaAtras= $horaAtras/60;
        if (strpos($horaAtras, ".")){
            $horaAtras=explode(".",$horaAtras);
            $horaAtras=$horaAtras[0].".".($horaAtras[1]*60);

            $horaAtras=floor(($horaAtras*100))/100;
            $horaAtras=explode(".",$horaAtras);
            $horaAtras="'".$horaAtras[0].":".$horaAtras[1]."'";
        }else{
            $horaAtras="'".$horaAtras.":00"."'";
        }




        $horaAdelante=$min[1]+60;

        $horaAdelante= $horaAdelante/60;
        if (strpos($horaAdelante, ".")){
            $horaAdelante=explode(".",$horaAdelante);
            $horaAdelante=$horaAdelante[0].".".($horaAdelante[1]*60);

            $horaAdelante=floor(($horaAdelante*100))/100;
            $horaAdelante=explode(".",$horaAdelante);
            $horaAdelante="'".$horaAdelante[0].":".$horaAdelante[1]."'";

        }else{
            $horaAdelante="'".$horaAdelante.":00"."'";

        };



        try {
            $stmt=$pdo->prepare("SELECT  * FROM tbl_mesa where Sala=?");
            $stmt -> bindparam( 1,$idS);
            $stmt->execute();

            $stmt2=$pdo->prepare("SELECT * FROM tbl_mesa m INNER JOIN tbl_reserva_mesa rm on rm.Id_mesa=m.Id_mesa where m.Sala=? and rm.Dia_rm=$diaB and rm.Hora_ini_rm BETWEEN $horaAtras and $horaAdelante");
            $stmt2-> bindparam(1,$idS);
            $stmt2 ->execute();
            return [$stmt,$stmt2];
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las mesas de la sala '.$id)</script>";
        }


    }
    public function delete(int $id)
    {
        require "../Controller/conexion.php";
        $stmt=$pdo->prepare("DELETE FROM `tbl_mesa` WHERE Id_mesa=?");
        $stmt -> bindParam(1,$id);
        $stmt->execute();


    }
    public static function getById($id){
        require_once "../Controller/conexion.php";
        $stmt=$pdo->prepare("SELECT m.Id_mesa as Id_mesa, m.capacidad_mesa as capacidad , m.Estado as estado,s.nombre_sala as sala FROM `tbl_mesa` m INNER JOIN tbl_sala s on s.Id_sala=m.Sala  WHERE Id_mesa = $id ");
        $stmt->execute();
        $stmt=$stmt->fetch(PDO::FETCH_ASSOC);


        echo json_encode($stmt) ;
    }

public static function updateEstado (int $sala, int $id, string $est, int $ocu, int $id_cam){

        if ($est == "ocupada" ){
            require "../controller/conexion.php";

            /* $id_cam=1; */
            $dia=date("Y-m-d");
            $hora='00:00';


            try {
                $pdo -> beginTransaction();
                $sql="UPDATE `tbl_mesa` SET `Estado`=? WHERE Id_mesa=?";
                $stmt=$pdo->prepare($sql);
                $stmt -> bindparam( 1,$est);
                $stmt -> bindparam( 2,$id );
                $stmt->execute();

                $sql2="INSERT INTO `tbl_reserva_mesa`(`Id_reserva`, `Id_mesa`, `Id_cam`, `Dia_rm`, `Hora_ini_rm`, `Ocupacion_rm`, `Hora_final_rm`) VALUES (null,?,?,?,current_time,?,?)";
                $stmt= $pdo->prepare($sql2);
                $stmt->bindParam(1,$id);
                $stmt->bindParam(2,$id_cam);
                $stmt->bindParam(3,$dia);
                $stmt->bindParam(4,$ocu);
                $stmt->bindParam(5,$hora);
                $stmt->execute();


                $pdo -> commit();

                echo "<script>window.location.href='../view/mostrarmesas.php?sala=$sala'</script>";
                return $stmt;

            }catch (Exception $e){
                $pdo -> rollback();
                echo $e->getMessage();
                echo "<script>alert('Error al actualizar el estado de la mesa '.$id)</script>";
            }

        }else if ($est =="libre" ){
            try {
                require "../controller/conexion.php";
                $pdo -> beginTransaction();
                $sql="UPDATE `tbl_mesa` SET `Estado`=? WHERE Id_mesa=?";
                $stmt=$pdo->prepare($sql);
                $stmt -> bindparam( 1,$est);
                $stmt -> bindparam( 2,$id );
                $stmt->execute();

                $sql="UPDATE `tbl_reserva_mesa` SET `Hora_final_rm`=CURRENT_TIME WHERE Id_mesa=? and Hora_final_rm='00:00'    ";
                $stmt=$pdo->prepare($sql);
                $stmt -> bindparam( 1,$id);
                $stmt->execute();
                $pdo -> commit();
                echo "<script>window.location.href='../view/mostrarmesas.php?sala=$sala'</script>";

            }catch (Exception $e){
                $pdo -> rollback();
                echo $e->getMessage();
                echo "<script>alert('Error al actualizar el estado de la mesa '.$id)</script>";
            }



        }else if ($est=="mantenimiento" ){

        }else{
            echo "<script>alert('Estado introducido no válido')</script>";
            exit();
        }


}

public static function update(int $id,$cap,$estado,$sala){

    require "../Controller/conexion.php";
    $id=$pdo->quote($id);
    $cap=$pdo->quote($cap);
    $estado=$pdo->quote($estado);
    $sala=$pdo->quote($sala);
    $id=str_replace('\'','',$id);
    $cap=str_replace('\'','',$cap);
    $estado=str_replace('\'','',$estado);
    $sala=str_replace('\'','',$sala);
    $sql="UPDATE `tbl_mesa` SET `capacidad_mesa`=?,`Estado`=?,`Sala`=? WHERE Id_mesa=?  ";
    $stmt=$pdo->prepare($sql);
    $stmt -> bindparam( 1,$cap);
    $stmt -> bindparam( 2,$estado);
    $stmt -> bindparam( 3,$sala);
    $stmt -> bindparam( 4,$id);
    $stmt->execute();
    return $stmt;
}

public function create($cap,$sala,$img){

    require "../Controller/conexion.php";

    $cap=$pdo->quote($cap);
    $sala=$pdo->quote($sala);
    $sala=str_replace('\'','',$sala);
    $sql="INSERT INTO `tbl_mesa`(`Id_mesa`, `capacidad_mesa`, `img`, `Estado`, `Sala`) VALUES (null,?,?,'ok',?)  ";
    $stmt=$pdo->prepare($sql);
    $stmt -> bindparam( 1,$cap);
    $stmt -> bindparam( 2,$img);
    $stmt -> bindparam( 3,$sala);
    $stmt->execute();
    return $stmt;
}
}