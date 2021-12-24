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

    public function validarMarca($nombre)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM marcas WHERE nombre = '$nombre'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 0;
        }

        return 1;
    }

    public function crearMarca($nombre)
    {
        $this->conectarDB();
        $sql = "INSERT INTO marcas(nombre) VALUES ('$nombre')";
        $this->conexion->query($sql);
        $idMarca = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idMarca;
    }
}

?>