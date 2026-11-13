<?php
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/plantel.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/carrera.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/periodos.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/materias.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/aulas.php");


class GeneralController
{
    public function obtenerPlanteles(){
        try{
            $objPlantel = new plantel();
            $data = $objPlantel->consultarPlantelesTodos();
            $datos = "";
            while ($row = $data->fetch_assoc()){
                $datos .= "<option value='".$row["id"]."'>".$row["Plantel"]."</option>";
            }
            return $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerCarreras(){
        try{
            $objCarrera = new carrera();
            $data = $objCarrera->consultarCarrerasTodas();
            $datos = "";
            while ($row = $data->fetch_assoc()){
                $datos .= "<option value='".$row["id"]."'>".$row["nombre"]."</option>";
            }
            return $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerHorarios($horaInicial, $horaFinal){
        try{

            $datos = "";
            for($i=$horaInicial;$i<=$horaFinal;$i++){
                $datos .= "<option value='".$i."'>".$i.":00</option>";
            }
            return $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerPeriodos($activo){
        try{
            $objPeriodos = new periodos();
            $data = $objPeriodos->consultarPeriodosByActivo($activo);
            $datos = "";
            while ($row = $data->fetch_assoc()){
                $datos .= "<option value='".$row["id"]."'>".$row["periodo"]."</option>";
            }
            return $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerMaterias($idCarrera){
        try{
            $objMateria = new materias();
            $data = $objMateria->consultarMateriasByCarreraId($idCarrera);
            $datos = "";
            while ($row = $data->fetch_assoc()){
                $datos .= "<option value='".$row["id"]."'>".$row["matClavle"]."</option>";
            }
            echo $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function obtenerLaboratorios(){
        try{
            $objAula = new aulas();
            $data = $objAula->consultarAulas();

            $datos = "";
            while ($row = $data->fetch_assoc()){
                $datos .= "<option value='".$row["id"]."'>(".$row["siglas"].") ".$row["nombre"]."</option>";
            }
            return $datos;
        }
        catch (Exception $e){
            echo $e->getMessage();
        }
    }

}

if(isset($_POST["operacion"])) {
    switch ($_POST["operacion"]) {
        case "consultarMaterias":
            $Controller = new GeneralController();
            $Controller->obtenerMaterias($_POST["carrera"]);
            break;
    }
}