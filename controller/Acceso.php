<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 02/08/2018
 * Time: 02:58 PM
 */

include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/labAccessError/model/usuario.php");

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
// este error fue que la busqueda del archivo index.php estaba mal ya que esto -> ../index.php buscaba en la carpeta controller y no en la raiz del proyecto
// al poner el nombre de la carpeta del proyecto se soluciono el error y lo busca desde la raiz del proyecto                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
    header("Location: /labAccessError/index.php");
    exit();

}
catch (Exception $e)
{
    $_SESSION["usuarioId"] = null;
    $_SESSION["usuarioPerfil"] = null;
    echo "<h1>Ha ocurrido un error al acceder al Sistema. Favor de reportarlo al encargado del mismo.</h1>";
}