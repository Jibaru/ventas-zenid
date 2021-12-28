<?php
include_once("Conexion.php");

class Producto extends Conexion
{
    public function obtenerProductos($nombre, $idMarca)
    {
        $this->conectarDB();
        
        $sentencias = array();

        if (!is_null($nombre))
        {
            array_push($sentencias, "nombre LIKE '$nombre%'");
        }

        if (!is_null($idMarca))
        {
            array_push($sentencias, "id_marca = '$idMarca'");
        }

        $sql = "SELECT * FROM productos";

        if (!empty($sentencias)) 
        {
            $sql .= (" WHERE ".implode(" OR ", $sentencias)); 
        }
        
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
        if (is_null($termino))
        {
            return array();
        }
        
        $this->conectarDB();
        $sql = "SELECT * FROM productos 
                WHERE 
                    descripcion LIKE '$termino%' AND
                    nombre NOT LIKE '$termino%'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $productos = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $productos[$i] = $resultado->fetch_array();
        }
            
        return ($productos);
    }

    public function obtenerProductosPorNombre($nombre)
    {
        return $this->obtenerProductos($nombre, null);
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

    public function crearProducto(
        $nombre,
        $codigoBarras,
        $igv,
        $precioCompraUnitario,
        $precioVenta,
        $stock,
        $stockMinimo,
        $descripcion,
        $idMarca
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO productos(
            nombre,
            codigo_barras,
            igv,
            precio_compra_unitario,
            precio_venta,
            stock,
            stock_minimo,
            descripcion,
            id_marca
        ) VALUES (
            '$nombre',
            '$codigoBarras',
            '$igv',
            '$precioCompraUnitario',
            '$precioVenta',
            '$stock',
            '$stockMinimo',
            '$descripcion',
            '$idMarca'
        )";
        $this->conexion->query($sql);
        $idProducto = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idProducto;
    }

    public function modificarProducto(
        $idProducto,
        $nombre,
        $codigoBarras,
        $igv,
        $precioCompraUnitario,
        $precioVenta,
        $stock,
        $stockMinimo,
        $descripcion,
        $idMarca
    )
    {
        $this->conectarDB();
        $sql = "UPDATE productos 
            SET nombre = '$nombre',
            codigo_barras = '$codigoBarras',
            igv = '$igv',
            precio_compra_unitario = '$precioCompraUnitario',
            precio_venta = '$precioVenta',
            stock = '$stock',
            stock_minimo = '$stockMinimo',
            descripcion = '$descripcion',
            id_marca = '$idMarca'
            WHERE id_producto = '$idProducto'
        ";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function habilitar($idProducto, $valor)
    {
        $this->conectarDB();
        $sql = "UPDATE productos
                SET habilitado = '$valor' 
                WHERE id_producto = '$idProducto'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function reducirStock($idProducto, $cantidad)
    {
        $this->conectarDB();
        $sql = "UPDATE productos
                SET stock = stock - '$cantidad' 
                WHERE id_producto = '$idProducto'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }
}

?>