<?php

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/usuario.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/DatosUsuario.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/perfil.php");


class usuarioController{

    public $objUsuario;
    public $objDatosUsuario;

    function insertarUsuario(){
        try {
            if($_POST["txtContrasena"]==$_POST["txtConfirmaContrasena"]) {
                $modelUsuario = new usuario();
                $modelUsuario->usuario = $_POST["txtUsuario"];
                $modelUsuario->contrasena = $_POST["txtContrasena"];
                $modelUsuario->idperfil = 3;
                $idUsuario = $modelUsuario->InsertarUsuario();
                if ($idUsuario > 0):
                    $modelDatosUsuario = new DatosUsuario();
                    $modelDatosUsuario->usuarioid = $idUsuario;
                    $modelDatosUsuario->nombre = $_POST["txtNombre"];
                    $modelDatosUsuario->primerapellido = $_POST["txtPrimerApellido"];
                    $modelDatosUsuario->segundoapellido = $_POST["txtSegundoApellido"];
                    $modelDatosUsuario->plantelid = 2;
                    $modelDatosUsuario->carreraid = $_POST["cbCarrera"];
                    $modelDatosUsuario->correopersonal = $_POST["txtEmail"];
                    $idDatosUsuario = $modelDatosUsuario->InsertarDatosUsuario();
                    if($idDatosUsuario>0):
                        $obJson['resultado'] = "success";
                        $obJson['mensaje'] = "Operaci&oacute;n realizada.";
                    else:
                        $obJson['resultado'] = "error";
                        $obJson['mensaje'] = "Usuario generado  sin datos personales.";
                    endif;
                else:
                    $obJson['resultado'] = "error";
                    $obJson['mensaje'] = "Error al generar el usuario";
                endif;
            }else{
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Contrase&ntilde;as diferentes, favor de escribir la misma en el espacio correspondiente";
            }
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }

    function modificarUsuario(){
        try {
            $modelUsuario = new usuario();
            $modelUsuario->contrasena = $_POST["txtContrasena"];
            $modelUsuario->id = base64_decode($_POST["usuarioId"]);
            $resultado1 = $modelUsuario->ModificarUsuario();

            $modelDatos = new DatosUsuario();
            $modelDatos->usuarioid = $modelUsuario->id;
            $modelDatos->nombre = $_POST["txtNombre"];
            $modelDatos->primerapellido = $_POST["txtPrimerApellido"];
            $modelDatos->segundoapellido = $_POST["txtSegundoApellido"];
            $modelDatos->carreraid = $_POST["cbCarrera"];
            $modelDatos->correopersonal = $_POST["txtEmail"];

            $resultado2 = $modelDatos->ModificarDatosUsuario();
            if ($resultado1 > 0 || $resultado2 > 0):
                $obJson['resultado'] = "success";
                $obJson['mensaje'] = "Operaci&oacute;n realizada.";
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "No se realizaron modificaciones";
            endif;
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }

    function modificarEstatusUsuario(){
        try {
            $modelUsuario = new usuario();
            $modelUsuario->id = base64_decode($_POST["usuarioId"]);
            $modelUsuario->activo = $_POST["estado"];
            $resultado = $modelUsuario->ModificarEstatusUsuario();
            if ($resultado > 0):
                if($modelUsuario->activo==0):
                    $obJson['resultado'] = "success";
                    $obJson['mensaje'] = "Usuario Deshabilitado.";
                else:
                    $obJson['resultado'] = "success";
                    $obJson['mensaje'] = "Usuario Habilitado.";
                    endif;
            else:
                $obJson['resultado'] = "error";
                $obJson['mensaje'] = "Error al modificar al usuario";
            endif;
            print json_encode($obJson);
        }
        catch  (Exception $e){
            $obJson['resultado'] = "error";
            $obJson['mensaje'] = "Error al procesar la solicitud";
            print json_encode($obJson);
        }
    }
    
    function consultarDatosUsuario($usuarioId){
        try {
            $this->objUsuario = new usuario();
            $this->objUsuario->consultarUsuarioById($usuarioId);

            $this->objDatosUsuario = new DatosUsuario();
            $this->objDatosUsuario->consultarDatosPersonalesByIdUsuario($usuarioId);
        } catch (Exception $e) {

        }
    }

    function consultarTodosUsuarios(){
        try {
            $objDatosUsuario = new DatosUsuario();
            return  $objDatosUsuario->consultarUsuarios();
        } catch (Exception $e) {
            return null;
        }
    }

}

if(isset($_POST["operacion"])){
    switch ($_POST["operacion"]) {
        case "registrarUsuario":
            $obj = new usuarioController();
            $obj->insertarUsuario();
            break;
        case "modificarUsuario":
            $obj = new usuarioController();
            $obj->modificarUsuario();
            break;
        case "cerrarUsuario":
            $obj = new usuarioController();
            $obj->modificarEstatusUsuario();
            break;

    }

}