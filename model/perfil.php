<?php
class perfil{

    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarPerfilesTodos(){
        try{
            $this->conexion->query = "SELECT P.id, P.nombre, P.activo 
                                        FROM ".$this->conexion->nombreBD.".perfiles AS P";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}