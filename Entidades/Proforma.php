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
        $sql = "SELECT * FROM proformas WHERE id_proforma = '$idProforma'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }
}

?>