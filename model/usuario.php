<?php

class usuario{

    private $conexion;
    public $id;
    public $usuario;
    public $contrasena;
    public $email;
    public $idperfil;
    public $activo;


    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarUsuario(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->nombreBD.".usuarios
                (id, usuario, contrasena, idperfil, activo) 
                VALUES (NULL,'$this->usuario','$this->contrasena', $this->idperfil, 1)";
            //echo $this->conexion->query;
            return $this->conexion->realizarInsert();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function ModificarUsuario(){
        try
        {
            $this->conexion->query = "UPDATE ".$this->conexion->nombreBD.".usuarios SET
                contrasena='$this->contrasena'
                WHERE id=$this->id";
            //echo $this->conexion->query;
            return $this->conexion->realizarOperacion();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function ModificarEstatusUsuario(){
        try
        {
            $this->conexion->query = "UPDATE ".$this->conexion->nombreBD.".usuarios SET
                activo=$this->activo 
                WHERE usuario='$this->usuario'";
            //echo $this->conexion->query;
            return $this->conexion->realizarOperacion();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }


    
    function consultarUsuarioById($idUsuario){
        try{
            $this->conexion->query = "SELECT U.id, U.usuario, U.contrasena, U.idperfil, U.activo
                                        FROM ".$this->conexion->nombreBD.".usuarios AS U 
                                        WHERE U.id = $idUsuario";
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->usuario = $row["usuario"];
                    $this->contrasena = $row["contrasena"];
                    $this->idperfil = $row["idperfil"];
                }
                return true;
            }else{
                return false;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarUsuarioByUserANDPassword($usuario,$password){
        try{
            $this->conexion->query = "SELECT U.id, U.usuario, U.contrasena, U.idperfil, U.activo
                                        FROM ".$this->conexion->nombreBD.".usuarios AS U 
                                        WHERE U.usuario='$usuario' AND  U.contrasena='$password' AND U.activo=1";
            //echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->usuario = $row["usuario"];
                    $this->contrasena = $row["contrasena"];
                    $this->idperfil = $row["idperfil"];

                }
                return true;
            }else{
                return false;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarUsuarioByUser($usuario){
        try{
            $this->conexion->query = "SELECT U.id, U.usuario, U.contrasena, U.idperfil, U.activo
                                        FROM ".$this->conexion->nombreBD.".usuarios AS U 
                                        WHERE U.usuario='$usuario'";
            //echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->usuario = $row["usuario"];
                    $this->contrasena = $row["contrasena"];
                    $this->idperfil = $row["idperfil"];
                }
                return true;
            }else{
                return false;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
    function consultarAllUsuario(){
        try{
            $this->conexion->query = "SELECT U.id, U.usuario, U.contrasena, U.idperfil, U.activo
                                        FROM ".$this->conexion->nombreBD.".usuarios AS U  ";
            //echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                return $resultado;
            }else{
                return false;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}