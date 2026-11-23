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
            $this->conexion->query = "
                SELECT b.idaula,
                    COUNT(*) AS total_usos,
                    COALESCE(SUM(b.cantalumnos), 0) AS total_alumnos,
                    COALESCE(SUM(b.horasalida - b.horaingreso), 0) AS total_horas
                FROM ".$this->conexion->nombreBD.".bitacoralab b
                WHERE b.idperiodo = {$periodoId}
                GROUP BY b.idaula
                ORDER BY b.idaula ASC";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}