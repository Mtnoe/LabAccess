<?php

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/periodos.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/materias.php");

class AdmonController{

    public $objPeriodo;
    public $objMateria;
    function insertarPeriodo(){
        try {
            $model = new periodos();
            $model->nombre = $_POST["cbPeriodo"];
            $model->anio = $_POST["cbAnio"];
            $id = $model->InsertarPeriodo();
            if ($id > 0):
                $obJson['resultado'] = "success";
                $obJson['mensaje'] = "Operaci&oacute;n realizada.";
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al generar el periodo";
            endif;
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }

    function insertarMateria(){
        try {
            $model = new materias();
            $model->clave = $_POST["txtClaveMat"];
            $model->nombre = $_POST["txtNombreMat"];
            $model->idcarrera = $_POST["cbCarrera"];
            $model->activo = $_POST["cbActivo"];
            $id = $model->InsertarMateria();
            if ($id > 0):
                $obJson['resultado'] = "success";
                $obJson['mensaje'] = "Operaci&oacute;n realizada.";
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al generar la materia";
            endif;
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }

    function modificarPeriodo(){
        try {
            try {
                $model = new periodos();
                $model->nombre = $_POST["cbPeriodo"];
                $model->anio = $_POST["cbAnio"];
                $model->id = base64_decode($_POST["periodoId"]);
                $model->activo = $_POST["cbActivo"];
                $id = $model->ModificarPeriodos();
                if ($id > 0):
                    $obJson['resultado'] = "success";
                    $obJson['mensaje'] = "Operaci&oacute;n realizada.";
                else:
                    $obJson['resultado'] = "error";
                    $obJson['mensaje'] = "Error al generar el periodo";
                endif;
                print json_encode($obJson);
            }
            catch  (Exception $e){
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al procesar la solicitud";
                print json_encode($obJson);
            }
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }

    function modificarMateria(){
        try {
            $model = new materias();
            $model->clave = $_POST["txtClaveMat"];
            $model->nombre = $_POST["txtNombreMat"];
            $model->idcarrera = $_POST["cbCarrera"];
            $model->activo = $_POST["cbActivo"];
            $model->id = base64_decode($_POST["materiaId"]);
            $id = $model->ModificarMateria();
            if ($id > 0):
                $obJson['resultado'] = "success";
                $obJson['mensaje'] = "Operaci&oacute;n realizada.";
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al generar la materia";
            endif;
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }
    public function obtenerPeriodos(){
        try{
            $objPeriodos = new periodos();
            $data = $objPeriodos->consultarPeriodos();
            return $data;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerMaterias(){
        try{
            $obj = new materias();
            $data = $obj->consultarMaterias();
            return $data;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerPeriodoById($idPeriodo){
        try{
            $this->objPeriodo = new periodos();
            $this->objPeriodo->consultarPeriodoById($idPeriodo);
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerMateriaById($idMateria){
        try{
            $this->objMateria = new materias();
            $this->objMateria->consultarMateriaById($idMateria);
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }
}


if(isset($_POST["operacion"])) {
    switch ($_POST["operacion"]) {
        case "registrarPeriodo":
            $Controller = new AdmonController();
            if(base64_decode($_POST["periodoId"])>0){
                $Controller->modificarPeriodo();
            }else{
                $Controller->insertarPeriodo();
            }

            break;
        case "registrarMateria":
            $Controller = new AdmonController();
            if(base64_decode($_POST["materiaId"])>0){
                $Controller->modificarMateria();
            }else{
                $Controller->insertarMateria();
            }
            break;
    }
}