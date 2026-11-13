<?php
class reportes{

    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarUsoLabPerCarrera($periodoId){
        try{
            $this->conexion->query = "";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarUsoLabPerLaboratorio($periodoId){
        try{
            $this->conexion->query = "";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}