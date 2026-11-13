<?php
class ConfigBD
{
	function getConexion()
	{

		$servidor = "localhost"; 
		$basedatos = "accesolab";
		$usuario = "root";
		$contrasenia = "";
		try {
            $conexionMysqli = new mysqli($servidor, $usuario, $contrasenia, $basedatos);
            if ($conexionMysqli->connect_errno) {
                echo "Falló la conexión con MySQL: (" . $conexionMysqli->connect_errno . ") " . $conexionMysqli->connect_error;
                throw new exception ('No se pudo generar conexión con la base de datos de trayectoria.');
            } else {
                $conexionMysqli->set_charset("utf8");
                return $conexionMysqli;
            }
        } catch (Exception $e) {
            throw e;
        }
    }
}
?>