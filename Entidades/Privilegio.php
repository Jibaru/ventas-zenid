<?php
include_once("Conexion.php");

class Privilegio extends Conexion 
{
    public function obtenerPrivilegios()
    {
        $this->conectarDB();
        $sql = "SELECT * FROM privilegios";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        for ($i = 0; $i < $numFilas; $i++) {
            $privilegios[$i] = $resultado->fetch_array();
        }
            
        return ($privilegios);
    }

}

?>