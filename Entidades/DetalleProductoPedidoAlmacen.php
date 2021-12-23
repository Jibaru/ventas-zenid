<?php
include_once("Conexion.php");

class DetalleProductoPedidoAlmacen extends Conexion
{
    public function guardarDetallePedidoProductoAlmacen(
        $idProducto,
        $idPedido,
        $cantidad)
    {
        $this->conectarDB();
        $sql = "INSERT INTO detalle_productos_pedidos_almacen(
                id_producto,
                id_pedido_almacen,
                cantidad
                ) VALUES (
                    '$idProducto',
                    '$idPedido',
                    '$cantidad'
                )";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function obtenerProductosPedidosAlmacen($idPedidoAlmacen)
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
                FROM detalle_productos_pedidos_almacen as pp 
                INNER JOIN productos as p
                ON pp.id_producto = p.id_producto
                WHERE pp.id_pedido_almacen = '$idPedidoAlmacen'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $productosPedidos = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $productosPedidos[$i] = $resultado->fetch_array();
        }
            
        return ($productosPedidos);
    }
}

?>