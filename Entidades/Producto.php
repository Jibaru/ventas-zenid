<?php
include_once("Conexion.php");

class Producto extends Conexion
{
    public function obtenerProductos($nombre, $idMarca)
    {
        $this->conectarDB();
        $nombre = ($nombre ? ($nombre + '%') : '');
        $sql = "SELECT * FROM productos
                WHERE nombre LIKE '$nombre' OR 
                id_marca = '$idMarca'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $productos = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $productos[$i] = $resultado->fetch_array();
        }
            
        return ($productos);
    }

    public function obtenerProductosSimilares($termino)
    {
        $this->conectarDB();
        $termino = ($termino ? ($termino + '%') : '');
        $sql = "SELECT * FROM productos
                WHERE descripcion LIKE '$termino%'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $productos = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $productos[$i] = $resultado->fetch_array();
        }
            
        return ($productos);
    }

    public function obtenerProducto($idProducto)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM productos WHERE id_producto = '$idProducto'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function validarStock($idProducto, $cantidad)
    {
        $this->conectarDB();
        $sql = "SELECT stock FROM productos WHERE id_producto = '$idProducto'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();

        if ($cantidad > $fila["stock"])
        {
            return 0;
        }
            
        return 1;
    }
}

?>