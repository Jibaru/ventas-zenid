<?php
include_once("Conexion.php");

class Representante extends Conexion
{
    public function crearRepresentante(
        $nombre, 
        $correoElectronico,
        $telefono,
        $idProveedor
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO representantes(
                    nombre,
                    correo_electronico,
                    telefono,
                    id_proveedor
                ) 
                VALUES (
                    '$nombre',
                    '$correoElectronico',
                    '$telefono',
                    '$idProveedor'
                )";
        $this->conexion->query($sql);
        $idRepresentante = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idRepresentante;
    }

    public function obtenerRepresentantePorIdProveedor($idProveedor)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM representantes WHERE id_proveedor = '$idProveedor'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function editarRepresentante(
        $idRepresentante,
        $nombre, 
        $correoElectronico,
        $telefono)
    {
        $this->conectarDB();
        $sql = "UPDATE usuarios
                SET nombre = '$nombre',
                correo_electronico = '$correoElectronico',
                telefono = '$telefono'
                WHERE id_representante = '$idRepresentante'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }
}

?>