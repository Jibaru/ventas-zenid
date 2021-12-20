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
}

?>