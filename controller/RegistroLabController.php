<?php
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/bitacoraLab.php");


class RegistroLabController
{
    function registrarUsoLaboratorio()
    {
        try {
            $model = new bitacoraLab();
            $model->profesor = $_POST["txtUsuario"];
            $model->horaingreso = $_POST["cbHoraEntrada"];
            $model->horasalida = $_POST["cbHoraSalida"];
            $model->idcarrera = $_POST["cbCarrera"];
            $model->idmateria = $_POST["cbMateria"];
            $model->idaula = $_POST["cbLaboratorio"];
            $model->cantalumnos = $_POST["txtCantAlumnos"];
            $model->nombrepractica = $_POST["txtPractica"];
            $id = $model->InsertarRegistroLaboratorio();
            if ($id > 0):
                $obJson['resultado'] = "success";
                $obJson['mensaje'] = "Operaci&oacute;n realizada.";
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al generar el registro. Pongase en contacto con el administrador del Sistema.";
            endif;

            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud. Pongase en contacto con el administrador del Sistema.";
            print json_encode($obJson);
        }
    }
}


if(isset($_POST["operacion"])) {
    switch ($_POST["operacion"]) {
        case "registrarUsoLaboratorio":
            $Controller = new RegistroLabController();
            $Controller->registrarUsoLaboratorio();
            break;
    }
}