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

    public function obtenerPedidoFinanzas($idPedidoAlmacen)
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
                    up.ape_materno as ape_materno_usuario_pedido,
                    up2.nombre as nombre_usuario_aprobacion,
                    up2.ape_paterno as ape_paterno_usuario_aprobacion,
                    up2.ape_materno as ape_materno_usuario_aprobacion,
                    prv.nombre as nombre_proveedor,
                    prv.correo_electronico as correo_electronico_proveedor,
                    prv.telefono as telefono_proveedor
                FROM pedidos_almacen as p
                INNER JOIN usuarios as up
                ON p.id_usuario_pedido = up.id_usuario
                INNER JOIN usuarios as up2
                ON p.id_usuario_aprobacion = up2.id_usuario
                INNER JOIN proveedores as prv
                ON p.id_proveedor = prv.id_proveedor
                WHERE id_pedido_almacen = '$idPedidoAlmacen'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function obtenerPedidosAlmacen()
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
                ON p.id_usuario_pedido = up.id_usuario";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $pedidos = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $pedidos[$i] = $resultado->fetch_array();
        }
            
        return ($pedidos);
    }

    public function aprobarPedido(
        $idPedidoAlmacen,
        $idUsuarioAprobacion,
        $idProveedor, 
        $fechaAprobacion
    )
    {
        $this->conectarDB();
        $sql = "UPDATE pedidos_almacen
                SET id_usuario_aprobacion = '$idUsuarioAprobacion',
                fecha_aprobacion = '$fechaAprobacion',
                id_proveedor = '$idProveedor'
                WHERE id_pedido_almacen = '$idPedidoAlmacen'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function validarPedidoFinanzas($idPedido)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM pedidos_almacen 
                WHERE id_pedido_almacen = '$idPedido' AND 
                fecha_aprobacion IS NOT NULL AND 
                id_usuario_aprobacion IS NOT NULL AND
                id_proveedor IS NOT NULL";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 1;
        }

        return 0;
    }
}

?>