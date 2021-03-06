<?php
include_once("Conexion.php");

class Proforma extends Conexion
{
    public function crearProforma(
        $nombreReferencial, 
        $fechaEmision, 
        $idUsuario)
    {
        $this->conectarDB();
        $sql = "INSERT INTO proformas(
                nombre_referencial,
                fecha_emision,
                id_usuario
                ) VALUES (
                    '$nombreReferencial',
                    '$fechaEmision',
                    '$idUsuario'
                )";
        $this->conexion->query($sql);
        $idProforma = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idProforma;
    }

    public function obtenerProforma($idProforma)
    {
        $this->conectarDB();
        $sql = "SELECT 
                    p.id_proforma,
                    p.nombre_referencial,
                    p.fecha_emision,
                    p.id_usuario,
                    up.nombre as nombre_usuario,
                    up.ape_paterno as ape_paterno_usuario,
                    up.ape_materno as ape_materno_usuario
                FROM proformas as p
                INNER JOIN usuarios as up
                ON p.id_usuario = up.id_usuario
                WHERE id_proforma = '$idProforma'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function obtenerProformas($valor)
    {
        $this->conectarDB();
        $sql = "SELECT 
                    p.id_proforma,
                    p.nombre_referencial,
                    p.fecha_emision,
                    u.id_usuario,
                    u.nombre as nombre_usuario,
                    u.ape_paterno as ape_paterno_usuario,
                    u.ape_materno as ape_materno_usuario,
                    v.id_venta
                 FROM proformas as p 
                 LEFT JOIN usuarios as u
                 ON p.id_usuario = u.id_usuario
                 LEFT JOIN ventas as v
                 ON p.id_proforma = v.id_proforma
                 WHERE p.id_proforma = '$valor' OR
                 p.nombre_referencial LIKE '$valor%'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $proformas = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $proformas[$i] = $resultado->fetch_array();
        }
            
        return ($proformas);
    }
}

?>