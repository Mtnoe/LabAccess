<?php
class aulas {

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarAulasByTipo($tipo, $plantelId){
        try{
            $this->conexion->query = "SELECT A.id, A.nombre, A.categoriaid, A.plantelid, A.edificioid, 
                                              A.aforonormal, A.aforocovid, A.activo 
                                      FROM ".$this->conexion->nombreBD.".aulas AS A 
                                      WHERE A.categoriaid = $tipo 
                                            AND A.plantelid = $plantelId 
                                            AND A.activo = 1
                                    ORDER BY A.nombre ";
            //echo  $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                return $resultado;
            }else{
                $this->id = 0;
                return false;
            }
        }
        catch (Exception $x)
        {
            return false;
        }
    }
    
    function consultarAulas(){
        try{
            $this->conexion->query = "SELECT A.id, A.siglas,A.nombre, A.plantelid, A.edificioid, 
                                    (SELECT P.Plantel FROM plantel AS P WHERE P.id = A.plantelid) AS plantelnombre,
                                    (SELECT E.nombre FROM edificios as E WHERE E.id = A.edificioid) AS edificionombre,
                                              A.activo 
                                      FROM ".$this->conexion->nombreBD.".aulas AS A 
                                      WHERE A.activo = 1
                                    ORDER BY A.nombre ";
            //echo  $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                return $resultado;
            }else{
                $this->id = 0;
                return false;
            }
        }
        catch (Exception $x)
        {
            return false;
        }
    }
    // function para consultar laboratorios por plantel
    function consultarLaboratoriosByPlantel($plantelId = 0) {
    try {
        $plantelId = (int)$plantelId;

        $sql = "SELECT A.id, A.siglas, A.nombre, A.plantelid, A.edificioid,
                       (SELECT P.Plantel FROM " . $this->conexion->nombreBD . ".plantel AS P WHERE P.id = A.plantelid) AS plantelnombre,
                       (SELECT E.nombre FROM " . $this->conexion->nombreBD . ".edificios AS E WHERE E.id = A.edificioid) AS edificionombre,
                       A.activo
                FROM " . $this->conexion->nombreBD . ".aulas AS A
                WHERE A.activo = 1";

        if ($plantelId > 0) {
            $sql .= " AND A.plantelid = " . $plantelId;
        }

        $sql .= " ORDER BY A.nombre ASC";

        $this->conexion->query = $sql;
        $resultado = $this->conexion->consultarDatos();

        if ($resultado && $resultado->num_rows > 0) {
            return $resultado;
        } else {
            return false;
        }
    } catch (Exception $x) {
        return false;
    }
}


}