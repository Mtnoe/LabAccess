<?php
class periodos{

    public $id, $nombre, $anio, $activo;
    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarPeriodo(){
        try
        {
            $this->conexion->query = "
                INSERT INTO ".$this->conexion->nombreBD.".periodos
                            (id, nombre, anio, activo) 
                        VALUES (NULL,'$this->nombre',$this->anio, 0); ";
            echo $this->conexion->query;
            return $this->conexion->realizarInsert();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function ModificarPeriodos(){
        try
        {
            $this->conexion->query = "     
                UPDATE ".$this->conexion->nombreBD.".periodos 
                SET
                    nombre = '$this->nombre',
                    anio = $this->anio, 
                    activo = $this->activo 
                WHERE id=$this->id";
            //echo $this->conexion->query;
            return $this->conexion->realizarOperacion();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarPeriodoById($idPeriodo){
        try{
            $this->conexion->query = "SELECT C.id, C.nombre, C.anio, C.activo
                                            
                                      FROM ".$this->conexion->nombreBD.".periodos AS C 
                                        WHERE C.id = $idPeriodo ";
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->nombre = $row["nombre"];
                    $this->anio = $row["anio"];
                    $this->activo = $row["activo"];
                }
                return true;
            }else{
                return false;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }



    function consultarPeriodos(){
        try{
            $this->conexion->query = "SELECT C.id, C.nombre, C.anio, C.activo,
                                            CASE
                                                WHEN C.activo = 1 THEN 'ACTIVO'
                                                ELSE 'CERRADO'
                                                END as estado,
                                            CONCAT(C.nombre,' ',C.anio) as periodo 
                                      FROM ".$this->conexion->nombreBD.".periodos AS C 
                                      ORDER BY periodo";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
    function consultarPeriodosByActivo($activo){
        try{
            $extra = "";
            if ($activo>=0){
                $extra = "WHERE C.activo = $activo";
            }
            $this->conexion->query = "SELECT C.id, CONCAT(C.nombre,' ',C.anio) as periodo 
                                      FROM ".$this->conexion->nombreBD.".periodos AS C 
                                      $extra
                                      ORDER BY C.nombre";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}