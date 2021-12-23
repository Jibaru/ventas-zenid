<?php
include_once("Conexion.php");

class Rol extends Conexion 
{
    public function obtenerRol($idRol)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM roles WHERE id_rol = '$idRol'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function obtenerRoles()
    {
        $this->conectarDB();
        $sql = "SELECT * FROM roles";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $roles = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $roles[$i] = $resultado->fetch_array();
        }
            
        return ($roles);
    }

    public function crearRol($nombre)
    {
        $this->conectarDB();
        $sql = "INSERT INTO roles(nombre) VALUES ('$nombre')";
        $this->conexion->query($sql);
        $idRol = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idRol;
    }

    public function modificarRol(
        $idRol,
        $nombre
    )
    {
        $this->conectarDB();
        $sql = "UPDATE roles
                SET nombre = '$nombre'
                WHERE id_rol = '$idRol'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function verificarDatosModificar($nombre, $idRol)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM roles WHERE 
                (nombre = '$nombre') AND id_rol != '$idRol'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 0;
        }

        return 1;
    }

    public function habilitar($idRol, $valor)
    {
        $this->conectarDB();
        $sql = "UPDATE roles
                SET habilitado = '$valor' 
                WHERE id_rol = '$idRol'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }
}

?>