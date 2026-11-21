<?php
class reportes{

    private $conexion;
    function __construct()
    {
        $this->conexion = new conexion();
    }
// hacia falta hacer las consultas para los reportes, se agregaron las funciones consultarUsoLabPerCarrera y consultarUsoLabPerLaboratorio
    function consultarUsoLabPerCarrera($periodoId){
        try{
            $this->conexion->query = "
                SELECT c.nombre, COUNT(*) as usoLab, SUM(horasalida - horaingreso) as usoHoras, SUM(cantalumnos) as usoAlumnos
                FROM ".$this->conexion->nombreBD.".bitacoralab b
                JOIN ".$this->conexion->nombreBD.".carreras c ON b.idcarrera = c.id
                WHERE b.idperiodo = $periodoId
                GROUP BY c.id, c.nombre";
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