<?php
include_once("Conexion.php");

class Proveedor extends Conexion
{
    public function crearProveedor(
        $nombre, 
        $correoElectronico, 
        $ruc, 
        $telefono
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO proveedores(
                    nombre,
                    correo_electronico,
                    ruc,
                    telefono
                ) 
                VALUES (
                    '$nombre',
                    '$correoElectronico',
                    '$ruc',
                    '$telefono'
                )";
        $this->conexion->query($sql);
        $idProveedor = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idProveedor;
    }

    public function obtenerProveedores($ruc)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM proveedores";

        if (!is_null($ruc))
        {
            $sql .= " WHERE ruc LIKE '$ruc%'";
        }

        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $proveedores = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $proveedores[$i] = $resultado->fetch_array();
        }
        
        return ($proveedores);
    }

    public function habilitar($idProveedor, $valor)
    {
        $this->conectarDB();
        $sql = "UPDATE proveedores
                SET habilitado = '$valor' 
                WHERE id_proveedor = '$idProveedor'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function obtenerProveedor($idProveedor)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM proveedores WHERE id_proveedor = '$idProveedor'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function editarProveedor(
        $idProveedor,
        $nombre, 
        $correoElectronico, 
        $ruc, 
        $telefono)
    {
        $this->conectarDB();
        $sql = "UPDATE usuarios
                SET nombre = '$nombre',
                correo_electronico = '$correoElectronico',
                ruc = '$ruc',
                telefono = '$telefono'
                WHERE id_proveedor = '$idProveedor'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }
}

?>