<?php
class materias{

    private $conexion;
    public $id, $clave, $nombre, $idcarrera, $activo;
    function __construct()
    {
        $this->conexion = new conexion();
    }


    function InsertarMateria(){
        try
        {
            $this->conexion->query = "
                INSERT INTO ".$this->conexion->nombreBD.".materias
                            (id, clave, nombre, idcarrera, activo) 
                        VALUES (NULL,'$this->clave','$this->nombre',
                        $this->idcarrera, $this->activo); ";
            //echo $this->conexion->query;
            return $this->conexion->realizarInsert();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function ModificarMateria(){
        try
        {
            $this->conexion->query = "     
                UPDATE ".$this->conexion->nombreBD.".materias 
                SET
                    clave = '$this->clave',
                    nombre = '$this->nombre',
                    idcarrera = $this->idcarrera, 
                    activo = $this->activo 
                WHERE id=$this->id";
            //echo $this->conexion->query;
            return $this->conexion->realizarOperacion();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarMateriasByCarreraId($idCarrera){
        try{
            $this->conexion->query = "SELECT C.id, CONCAT(C.clave,'-',C.nombre) as matClavle 
                                      FROM ".$this->conexion->nombreBD.".materias AS C 
                                      WHERE C.idcarrera = $idCarrera
                                      ORDER BY matClavle";
            //echo $this->conexion->query;
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarMaterias(){
        try{
            $this->conexion->query = "SELECT C.id, CONCAT(C.clave,'-',C.nombre) as matClavle,
                                        (SELECT PE.nombre FROM ".$this->conexion->nombreBD.".carreras AS PE
                                            WHERE PE.id = C.idcarrera) AS carrera
                                      FROM ".$this->conexion->nombreBD.".materias AS C 
                                      ORDER BY matClavle";
            //echo $this->conexion->query;
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarMateriaById($idMateria){
        try{
            $this->conexion->query = "SELECT C.id, C.clave,C.nombre, C.idcarrera, C.activo,
                                        (SELECT PE.nombre FROM ".$this->conexion->nombreBD.".carreras AS PE
                                            WHERE PE.id = C.idcarrera) AS carrera
                                      FROM ".$this->conexion->nombreBD.".materias AS C ";
            //echo $this->conexion->query;
            $resultado = $this->conexion->consultarDatos();
            if($resultado->num_rows >0) {
                while ($row = $resultado->fetch_assoc()) {
                    $this->id = $row["id"];
                    $this->clave = $row["clave"];
                    $this->nombre = $row["nombre"];
                    $this->idcarrera = $row["idcarrera"];
                    $this->activo = $row["activo"];
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
}
