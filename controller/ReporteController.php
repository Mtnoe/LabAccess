<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/labAccessError/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/labAccessError/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/labAccessError/model/reportes.php");

class ReporteController
{
    public function reporteUsoLabPerCarrera($idPeriodo)
    {
        try {
            $objReporte = new reportes();
            return $objReporte->consultarUsoLabPerCarrera($idPeriodo);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function reporteUsoLabPerLaboratorio($idPeriodo)
    {
        try {
            $objReporte = new reportes();
            return $objReporte->consultarUsoLabPerLaboratorio($idPeriodo);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
