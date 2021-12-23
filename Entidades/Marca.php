<?php
include_once("Conexion.php");

class Marca extends Conexion
{
    public function obtenerMarcas()
    {
        $this->conectarDB();
        $sql = "SELECT * FROM marcas";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $marcas = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $marcas[$i] = $resultado->fetch_array();
        }
            
        return ($marcas);
    }
}

?>