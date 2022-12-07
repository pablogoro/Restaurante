<?php

class ReservaMesa{
    private $id;
    private $mesa;
    private $camarero;
    private $dia;
    private $hora;
    private $ocupacion;

    public function __construct($id,$mesa,$camarero,$dia,$hora,$ocupacion){
        $this->id=$id;
        $this->mesa=$mesa;
        $this->camarero=$camarero;
        $this->dia=$dia;
        $this->hora=$hora;
        $this->ocupacion=$ocupacion;    
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
     * Get the value of mesa
     */ 
    public function getMesa()
    {
        return $this->mesa;
    }

    /**
     * Set the value of mesa
     *
     * @return  self
     */ 
    public function setMesa($mesa)
    {
        $this->mesa = $mesa;

        return $this;
    }

    /**
     * Get the value of camarero
     */ 
    public function getCamarero()
    {
        return $this->camarero;
    }

    /**
     * Set the value of camarero
     *
     * @return  self
     */ 
    public function setCamarero($camarero)
    {
        $this->camarero = $camarero;

        return $this;
    }

    /**
     * Get the value of dia
     */ 
    public function getDia()
    {
        return $this->dia;
    }

    /**
     * Set the value of dia
     *
     * @return  self
     */ 
    public function setDia($dia)
    {
        $this->dia = $dia;

        return $this;
    }

    /**
     * Get the value of hora
     */ 
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * Set the value of hora
     *
     * @return  self
     */ 
    public function setHora($hora)
    {
        $this->hora = $hora;

        return $this;
    }

    /**
     * Get the value of ocupacion
     */ 
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set the value of ocupacion
     *
     * @return  self
     */ 
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    public static function getAll (){
        require "../controller/conexion.php";

        // echo "$alu->nombre";
        try {
            $stmt=$pdo->prepare("SELECT * FROM tbl_reserva_mesa rm  inner join tbl_mesa m on m.Id_mesa=rm.Id_mesa inner join tbl_sala s on s.Id_sala=m.Sala ORDER BY rm.Id_reserva DESC ");
           /*  $stmt -> bindparam(  $stmt->bindParam(1,$id)); */
            $stmt->execute();
            return $stmt;
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las mesas')</script>";
        }


    }

    public static function getbyId(int $id, $dia, $hora)
    {
        require "../controller/conexion.php";

        if ($hora=="-"){
            $hora=date("h:i");
        }
        $idB = $pdo->quote($id);
        $idS = str_replace('\'', '', $idB);
        $diaB = $pdo->quote($dia);
        $horaB = $pdo->quote($hora);
        $horaS = str_replace('\'', '', $horaB);
        $min = explode(":", $horaS);

        $min[1] = $min[0] * 60 + $min[1];
        $horaAtras = $min[1] - 60;

        $horaAtras = $horaAtras / 60;
        if (strpos($horaAtras, ".")) {
            $horaAtras = explode(".", $horaAtras);
            $horaAtras = $horaAtras[0] . "." . ($horaAtras[1] * 60);

            $horaAtras = floor(($horaAtras * 100)) / 100;
            $horaAtras = explode(".", $horaAtras);
            $horaAtras = "'" . $horaAtras[0] . ":" . $horaAtras[1] . "'";
        } else {
            $horaAtras = "'" . $horaAtras . ":00" . "'";
        }


        $horaAdelante = $min[1] + 60;

        $horaAdelante = $horaAdelante / 60;
        if (strpos($horaAdelante, ".")) {
            $horaAdelante = explode(".", $horaAdelante);
            $horaAdelante = $horaAdelante[0] . "." . ($horaAdelante[1] * 60);

            $horaAdelante = floor(($horaAdelante * 100)) / 100;
            $horaAdelante = explode(".", $horaAdelante);
            $horaAdelante = "'" . $horaAdelante[0] . ":" . $horaAdelante[1] . "'";

        } else {
            $horaAdelante = "'" . $horaAdelante . ":00" . "'";

        };


        try {
            $stmt2 = $pdo->prepare("SELECT * FROM tbl_reserva_mesa rm INNER JOIN tbl_cliente c on c.Id_cli=rm.Id_cli WHERE rm.Id_mesa=$idS and rm.Dia_rm=$diaB and rm.Hora_ini_rm BETWEEN $horaAtras and $horaAdelante");
            //$stmt2->bindparam(1, $idS);
            $stmt2->execute();
            return $stmt2;
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las mesas de la sala '.$id)</script>";
        }
    }
    public static function getbyId2(int $id, $dia, $hora)
    {
        require "../controller/conexion.php";

        if ($hora=="-"){
            $hora=date("h:i");
        }
        $idB = $pdo->quote($id);
        $idS = str_replace('\'', '', $idB);
        $diaB = $pdo->quote($dia);
        $horaB = $pdo->quote($hora);
        $horaS = str_replace('\'', '', $horaB);
        $min = explode(":", $horaS);

        $min[1] = $min[0] * 60 + $min[1];
        $horaAtras = $min[1] - 60;

        $horaAtras = $horaAtras / 60;
        if (strpos($horaAtras, ".")) {
            $horaAtras = explode(".", $horaAtras);
            $horaAtras = $horaAtras[0] . "." . ($horaAtras[1] * 60);

            $horaAtras = floor(($horaAtras * 100)) / 100;
            $horaAtras = explode(".", $horaAtras);
            $horaAtras = "'" . $horaAtras[0] . ":" . $horaAtras[1] . "'";
        } else {
            $horaAtras = "'" . $horaAtras . ":00" . "'";
        }


        $horaAdelante = $min[1] + 60;

        $horaAdelante = $horaAdelante / 60;
        if (strpos($horaAdelante, ".")) {
            $horaAdelante = explode(".", $horaAdelante);
            $horaAdelante = $horaAdelante[0] . "." . ($horaAdelante[1] * 60);

            $horaAdelante = floor(($horaAdelante * 100)) / 100;
            $horaAdelante = explode(".", $horaAdelante);
            $horaAdelante = "'" . $horaAdelante[0] . ":" . $horaAdelante[1] . "'";

        } else {
            $horaAdelante = "'" . $horaAdelante . ":00" . "'";

        };


        try {
            $stmt2 = $pdo->prepare("SELECT Dni_cli FROM `tbl_cliente` c INNER JOIN tbl_reserva_mesa rm on c.Id_cli=rm.Id_cli WHERE rm.Dia_rm=$diaB and rm.Hora_ini_rm BETWEEN $horaAtras and $horaAdelante");
            //$stmt2->bindparam(1, $idS);
            $stmt2->execute();
            //$stmt2=$stmt2->fetch(PDO::FETCH_ASSOC);
            return $stmt2;
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las mesas de la sala '.$id)</script>";
        }
    }
    public static function crear($id,$dniCam,$cli,$dia,$hora_ini,$ocu){
        require "../Controller/conexion.php";
        $idB = $pdo->quote($id);
        $idS = str_replace('\'', '', $idB);
        $cam= $pdo->prepare("SELECT `Id_cam` FROM `tbl_camarero` WHERE Dni_cam=?");
        $cam->bindparam(1,$dniCam);
        $cam->execute();
        $cam=$cam->fetch(PDO::FETCH_ASSOC);
        $cam=$cam['Id_cam'];
        $cliB = $pdo->quote($cli['Id_cli']);
        $cliS = str_replace('\'', '', $cliB);
        $dia = $pdo->quote($dia);
        $hora= $pdo->quote($hora_ini);
        $ocu= $pdo->quote($ocu);

        $stmt = $pdo->prepare("INSERT INTO `tbl_reserva_mesa`(`Id_reserva`, `Id_mesa`, `Id_cam`, `Id_cli`, `Dia_rm`, `Hora_ini_rm`, `Ocupacion_rm`) VALUES (null,$id,$cam,$cliS,$dia,$hora,$ocu)");
        //$stmt->bindparam(1, $idS);
        $stmt->execute();
        return $stmt;

    }

    public static function getFilter($camarero,$sala,$mesa,$dia,$horaInicial,$horaFinal){
        require "../controller/conexion.php";
        try {
            $camarero=str_replace('\'','',$camarero);
            $sala=str_replace('\'','',$sala);
            $mesa=str_replace('\'','',$mesa);
            $dia=str_replace('\'','',$dia);
            $horaInicial=str_replace('\'','',$horaInicial);
            $horaFinal=str_replace('\'','',$horaFinal);
            /* echo $camarero; */
/* echo $camarero=$camarero[1]; */
 /* $mesa=$mesa[1];
 echo $mesa; */
            if($camarero==null && $sala==null && $mesa==null && $dia==null && $horaInicial==null && $horaFinal==null){
                /* echo "hola"; */
                /* die(); */
                $sql="SELECT * FROM tbl_reserva_mesa rm  inner join tbl_mesa m on m.Id_mesa=rm.Id_mesa inner join tbl_sala s on s.Id_sala=m.Sala ORDER BY rm.Id_reserva DESC";
            }else{
                $sql="SELECT * FROM tbl_reserva_mesa rm  inner join tbl_mesa m on m.Id_mesa=rm.Id_mesa inner join tbl_sala s on s.Id_sala=m.Sala ";

                if($camarero==!null){
                    /* $camarero=$camarero[1]; */
                    $sql=$sql." WHERE Id_cam LIKE '%$camarero%' ";
                    if($sala==!null || $mesa==!null || $dia==!null || $horaInicial==!null || $horaFinal==!null){
                        $sql=$sql."AND";
                    }
                }
                if($sala==!null){
                    
                    if($camarero==!null){
                        $sql=$sql." s.nombre_sala LIKE '%$sala%' ";
                    }else{
                        $sql=$sql." WHERE s.nombre_sala LIKE '%$sala%' ";
                    }
                    if($mesa==!null || $dia==!null || $horaInicial==!null || $horaFinal==!null){
                        $sql=$sql."AND";
                    }
                }
                if($mesa==!null){
                    /* $mesa=$mesa[1]; */
                    
                    if($sala==!null || $camarero==!null){
                        $sql=$sql." m.Id_mesa LIKE '%$mesa%' ";
                    }else{
                        $sql=$sql." WHERE m.Id_mesa LIKE '%$mesa%' ";
                    }
                    if($dia==!null || $horaInicial==!null || $horaFinal==!null){
                        $sql=$sql."AND";
                    }
                }
                if($dia==!null){
                    /* $dia2=substr($dia,1);
                    echo $dia2; */
                    /* echo $dia; */
                    /* echo $dia; */
                    
                    if($sala==!null || $camarero==!null || $mesa==!null){
                        $sql=$sql." rm.Dia_rm LIKE '$dia' ";
                    }else{
                        $sql=$sql." WHERE rm.Dia_rm LIKE '$dia' ";
                    }
                    if($horaInicial==!null || $horaFinal==!null){
                        $sql=$sql."AND";
                    }
                }
                if($horaInicial==!null || $horaFinal==!null){
                    /* echo $horaInicial; */
                    /* die(); */
                    if($horaInicial==!null && $horaFinal==!null){
                        if($sala==!null || $camarero==!null || $mesa==!null || $dia==!null){
                            $sql=$sql." rm.Hora_ini_rm BETWEEN '$horaInicial' AND '$horaFinal' ";
                        }else{
                            $sql=$sql." WHERE rm.Hora_ini_rm BETWEEN '$horaInicial' AND '$horaFinal'";
                        }
                    }elseif($horaInicial==!null){
                        if($sala==!null || $camarero==!null || $mesa==!null || $dia==!null){
                            $sql=$sql." rm.Hora_ini_rm > '$horaInicial' ";
                        }else{
                            $sql=$sql." WHERE rm.Hora_ini_rm > '$horaInicial'";
                        }
                    }elseif($horaFinal==!null){
                        if($sala==!null || $camarero==!null || $mesa==!null || $dia==!null){
                            $sql=$sql." rm.Hora_final_rm < '$horaFinal' ";
                        }else{
                            $sql=$sql." WHERE rm.Hora_final_rm < '$horaFinal'";
                        }
                    }
                }
                $sql=$sql." ORDER BY rm.Id_reserva DESC";
            }
            /* echo $sql; */
            /* die(); */
            $stmt=$pdo->prepare($sql);
           /*  $stmt -> bindparam(  $stmt->bindParam(1,$id)); */
            $stmt->execute();
            return $stmt;
        }catch (Exception $e){
            echo "<script>alert('Error al mostrar datos de las mesas')</script>";
        }
    }
    public static function delete(int $id){
        REQUIRE "../Controller/conexion.php";
        $stmt=$pdo->prepare("DELETE FROM `tbl_reserva_mesa` WHERE Id_mesa=?");
        $stmt -> bindparam( 1,$id);
        $stmt->execute();

    }

    // public function subirRegistroMesa(){
        
    // }


    public function getMediasHora(){
        require "../controller/conexion.php";

        $sql="SELECT TIMEDIFF(rm.Hora_final_rm,rm.Hora_ini_rm) as 'mediaHoras', s.nombre_sala as nombre  FROM `tbl_reserva_mesa` rm INNER JOIN tbl_mesa m on rm.Id_mesa=m.Id_mesa INNER JOIN tbl_sala s on m.Sala=s.Id_sala GROUP by s.Id_sala ";
        $stmt=$pdo->prepare($sql);

        $stmt->execute();

        return $stmt;

    }


    public function getOcupaciones(){
        require "../controller/conexion.php";

        $sql="SELECT SUM(rm1.Ocupacion_rm)/count(DISTINCT rm1.Dia_rm) as suma, s.nombre_sala from tbl_reserva_mesa rm1 INNER Join tbl_mesa m on m.Id_mesa=rm1.Id_mesa INNER JOIN tbl_sala s on s.Id_sala=m.Sala GROUP by s.Id_sala";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();

        return $stmt;

    }

    public function getCantidadServiciosCamarero(){
        require "../controller/conexion.php";

        $sql="SELECT count(rm.Id_cam) as cuenta from tbl_reserva_mesa  rm GROUP by rm.Id_cam ";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();

        return $stmt;

    }
    public function getEstatsCamareros(){
        require "../controller/conexion.php";

        $sql="SELECT COUNT(rm.Id_cam)/count( DISTINCT rm.Dia_rm) as num, concat(c.Nombre_cam,c.Apellido_cam) as cam from tbl_reserva_mesa rm  INNER JOIN tbl_camarero c on c.Id_cam=rm.Id_cam GROUP BY rm.Id_cam;";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();

        return $stmt;

    }

    public function getUsosMesas(){
        require "../controller/conexion.php";

        $sql="SELECt COUNT(rm.Id_mesa)/count(DISTINCT rm.Dia_rm) as dato, rm.Id_mesa as mesa from tbl_reserva_mesa rm GROUP by rm.Id_mesa;        ";
        $stmt=$pdo->prepare($sql);
        $stmt->execute();

        return $stmt;

    }



    // public function subirRegistroMesa(){

    // }
}
