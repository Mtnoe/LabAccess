<?php
class carrera{

    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarCarrerasTodas(){
        try{
            $this->conexion->query = "SELECT C.id, C.nombre, C.lcarrera 
                                      FROM ".$this->conexion->nombreBD.".carreras AS C 
                                      WHERE C.activo = 1
                                      ORDER BY C.Nombre";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}