<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 02/08/2018
 * Time: 02:58 PM
 */

include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/accesoLab/model/usuario.php");

session_start();
$Usuario = $_POST["Usuario"];
$Contrasena = $_POST["Contrasena"];

try {
    $AccesoUsuarios = new Usuario();
    $AccesoUsuarios->consultarUsuarioByUserANDPassword($Usuario,$Contrasena);
    if($AccesoUsuarios->id>0){
        $_SESSION["usuarioId"] = $AccesoUsuarios->id;
        $_SESSION["usuarioPerfil"] = $AccesoUsuarios->idperfil;
        $_SESSION["Usuario"] = $AccesoUsuarios->usuario;
        $_SESSION["regVacunacion"]= $AccesoUsuarios->vacunacion;
    }else{
        $_SESSION["usuarioId"] = null;
        $_SESSION["usuarioPerfil"] = null;
    }

    header("Location: ../index.php");

}
catch (Exception $e)
{
    $_SESSION["usuarioId"] = null;
    $_SESSION["usuarioPerfil"] = null;
    echo "<h1>Ha ocurrido un error al acceder al Sistema. Favor de reportarlo al encargado del mismo.</h1>";
}