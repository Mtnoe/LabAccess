<?php
class plantel{

    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarPlantelesTodos(){
        try{
            $this->conexion->query = "SELECT P.id, P.LPlantel, P.Plantel 
                                      FROM ".$this->conexion->nombreBD.".plantel AS P ";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}