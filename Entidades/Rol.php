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

}

?>