<?php
include_once("Conexion.php");

class PedidoAlmacen extends Conexion
{
    public function guardarPedido(
        $observaciones, 
        $fechaEmision, 
        $idUsuarioPedido)
    {
        $this->conectarDB();
        $sql = "INSERT INTO pedidos_almacen(
                observaciones,
                fecha_emision,
                id_usuario_pedido
                ) VALUES (
                    '$observaciones',
                    '$fechaEmision',
                    '$idUsuarioPedido'
                )";
        $this->conexion->query($sql);
        $idPedidoAlamcen = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idPedidoAlamcen;
    }

    public function obtenerPedidoAlmacen($idPedidoAlmacen)
    {
        $this->conectarDB();
        $sql = "SELECT 
                    p.id_pedido_almacen,
                    p.observaciones,
                    p.fecha_emision,
                    p.fecha_aprobacion,
                    p.id_proveedor,
                    p.id_usuario_pedido,
                    p.id_usuario_aprobacion,
                    up.nombre as nombre_usuario_pedido,
                    up.ape_paterno as ape_paterno_usuario_pedido,
                    up.ape_materno as ape_materno_usuario_pedido
                FROM pedidos_almacen as p
                INNER JOIN usuarios as up
                ON p.id_usuario_pedido = up.id_usuario
                WHERE id_pedido_almacen = '$idPedidoAlmacen'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }
}

?>