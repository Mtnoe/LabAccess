<?php

class DatosUsuario{

    private $conexion;
    public $id, $usuarioid;
    public $nombre, $primerapellido, $segundoapellido, $nombrecompleto, $correopersonal;
    public $carreraid, $carrera;
    public $plantelid, $plantel;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarDatosUsuario(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->nombreBD.".datosusuario
                (id, usuarioid,nombre, primerapellido, segundoapellido, 
                correopersonal, carreraid, plantelid) 
                VALUES (NULL,$this->usuarioid,'$this->nombre','$this->primerapellido', '$this->segundoapellido', 
                '$this->correopersonal', $this->carreraid,$this->plantelid)";
            //echo $this->conexion->query;
            return $this->conexion->realizarInsert();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarDatosPersonalesByIdUsuario($idUsuario){
        try{
            $this->conexion->query = "SELECT DU.id, DU.usuarioid, DU.nombre, DU.primerapellido, 
                                            DU.segundoapellido, DU.carreraid, DU.plantelid, DU.correopersonal,                                        
                                            (SELECT C.nombre FROM ".$this->conexion->nombreBD.".carreras AS C
                                            WHERE C.id=DU.carreraid) AS carrera,
                                            (SELECT P.Plantel FROM ".$this->conexion->nombreBD.".plantel AS P 
                                            WHERE P.id = DU.plantelid) AS plantel
                                        FROM ".$this->conexion->nombreBD.".datosusuario AS DU 
                                        WHERE DU.usuarioid = $idUsuario";
                                     // echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                $row = $resultado->fetch_assoc();
                    $this->id = $row["id"];
                    $this->usuarioid = $row["usuarioid"];
                    $this->nombre = $row["nombre"];
                    $this->primerapellido = $row["primerapellido"];
                    $this->segundoapellido = $row["segundoapellido"];
                    $this->nombrecompleto = $row["nombre"].' '.$row["primerapellido"].' '.$row["segundoapellido"];
                    $this->carreraid = $row["carreraid"];
                    $this->plantelid = $row["plantelid"];
                    $this->correooficial = $row["correopersonal"];
                    $this->carrera = $row["carrera"];
                    $this->plantel = $row["plantel"];
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

    function ModificarDatosUsuario(){
        try
        {
            $this->conexion->query = "UPDATE ".$this->conexion->nombreBD.".datosusuario 
            SET
                correopersonal='$this->correopersonal',
                nombre='$this->nombre', 
                primerapellido='$this->primerapellido', 
                segundoapellido='$this->segundoapellido',
                carreraid='$this->carreraid'
                WHERE usuarioid=$this->usuarioid";
           // echo $this->conexion->query;
            return $this->conexion->realizarOperacion();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
    
    function consultarUsuarios(){
        try{
            $this->conexion->query = "SELECT DU.id, DU.usuarioid,  
                                            CONCAT(DU.nombre,' ', DU.primerapellido,' ',DU.segundoapellido) as nombreCompleto,
                                            DU.nombre, DU.primerapellido, DU.segundoapellido, 
                                            DU.carreraid, DU.plantelid,
                                            U.usuario, U.contrasena
                                        FROM ".$this->conexion->nombreBD.".datosusuario AS DU join ".$this->conexion->nombreBD.".usuarios AS U on DU.usuarioid = U.id
                                        WHERE U.idperfil > 1";
            //echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            return $resultado;

        }
        catch (Exception $x)
        {
            throw $x;
        }
    }
}