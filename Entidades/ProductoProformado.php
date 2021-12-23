<?php
include_once("Conexion.php");

class ProductoProformado extends Conexion
{
    public function crearProductoProformado(
        $idProforma,
        $idProducto,
        $cantidad)
    {
        $this->conectarDB();
        $sql = "INSERT INTO productos_proformados(
                id_producto,
                id_proforma,
                cantidad
                ) VALUES (
                    '$idProducto',
                    '$idProforma',
                    '$cantidad'
                )";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function obtenerProductosProformados($idProforma)
    {
        $this->conectarDB();
        $sql = "SELECT 
                pp.cantidad,
                p.id_producto,
                p.nombre,
                p.codigo_barras,
                p.descripcion,
                p.igv,
                p.precio_compra_unitario,
                p.precio_venta,
                p.stock,
                p.stock_minimo,
                p.habilitado,
                p.id_marca
                FROM productos_proformados as pp 
                INNER JOIN productos as p
                ON pp.id_producto = p.id_producto
                WHERE pp.id_proforma = '$idProforma'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $productosProformados = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $productosProformados[$i] = $resultado->fetch_array();
        }
            
        return ($productosProformados);
    }
}

?>