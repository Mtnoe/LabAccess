<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 17/08/2021
 * Time: 17:49
 */

class Docente{

    public $Nodocente;
    public $Nombre;
    public $ApellidoPaterno;
    public $ApellidoMaterno;
    public $YY_Ingreso;

    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarDatosDocente(){
        try
        {
            $this->conexion->query = "select D.CveDocente, SUBSTRING_INDEX(SUBSTRING_INDEX(D.Docente, ' ', 1), ' ', -1) AS primerapellido,
                                       If(  length(D.Docente) - length(replace(D.Docente, ' ', ''))>1,  
                                           SUBSTRING_INDEX(SUBSTRING_INDEX(D.Docente, ' ', 2), ' ', -1) ,NULL) as segundoapellido,
                                       SUBSTRING_INDEX(SUBSTRING_INDEX(D.Docente, ' ', 3), ' ', -1) AS nombre,
                                       SUBSTRING_INDEX(SUBSTRING_INDEX(D.Docente, ' ', 4), ' ', -1) as segundonombre, 
                                       D.Docente, YEAR(D.FechaIngreso) as ingreso
                                    from ".$this->conexion->nombreBDConsulta.".cgo_docentes AS D
                                    where CveDocente = $this->Nodocente";

            //echo $this->conexion->query;
            $datosAlumno = $this->conexion->consultarDatos();
            if($datosAlumno->num_rows>0){
                $row = $datosAlumno->fetch_assoc();
                $this->Nodocente = $row["CveDocente"];
                $this->ApellidoPaterno = $row["primerapellido"];
                $this->ApellidoMaterno = $row["segundoapellido"];
                if ($row["nombre"] != $row["segundonombre"])
                    $this->Nombre = $row["nombre"]." ".$row["segundonombre"];
                else
                    $this->Nombre = $row["nombre"];
                $this->YY_Ingreso = $row["ingreso"];
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

}