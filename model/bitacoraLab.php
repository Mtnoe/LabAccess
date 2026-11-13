<?php
class bitacoraLab
{

    private $conexion;
    public $id, $fecha, $horaingreso, $horasalida;
    public $profesor, $cantalumnos, $nombrepractica;
    public $idperiodo, $periodoid;
    public $idcarrera, $carrera;
    public $idmateria, $materia;
    public $idaula, $aulaLab;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarRegistroLaboratorio()
    {
        try {
            $this->conexion->query = "INSERT INTO " . $this->conexion->nombreBD . ".bitacoralab
                (id, fecha, horaingreso, horasalida, profesor, idcarrera, idmateria, 
                    cantalumnos, nombrepractica, idperiodo, idaula) 
                VALUES (NULL,NOW(),$this->horaingreso,$this->horasalida, $this->profesor, 
                 $this->idcarrera, $this->idmateria,$this->cantalumnos,'$this->nombrepractica', 
                 (SELECT P.id FROM " . $this->conexion->nombreBD . ".periodos as P WHERE p.activo=1),
                 $this->idaula)";
            //echo $this->conexion->query;
            return $this->conexion->realizarInsert();
        } catch (Exception $x) {
            throw $x;
        }
    }
}