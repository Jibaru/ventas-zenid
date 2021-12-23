<?php

class ControllerGenerarPedido
{
    public function obtenerGenerarPedido()
    {
        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormGenerarPedido.php");
        $formulario = new FormGenerarPedido;
        $formulario->formGenerarPedidoShow($listaMarcas);
    }

    public function buscarProductos($nombre, $idMarca)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;

        $listaProductos = $eProducto->obtenerProductos($nombre, $idMarca);

        if (empty($listaProductos)) 
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "No se encontraron productos", 
                "GetFormGenerarPedido.php");
        }
        else 
        {
            include_once("../Entidades/Marca.php");
            $eMarca = new Marca;
            $listaMarcas = $eMarca->obtenerMarcas();

            include_once("FormGenerarPedido.php");
            $formulario = new FormGenerarPedido;
            $formulario->formGenerarPedidoShow(
                $listaMarcas, 
                $listaProductos);
        }

        
    }

    public function agregarProducto($idProducto)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $producto = $eProducto->obtenerProducto($idProducto);

        if (!$producto)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow(
                "Producto no encontrado");
        }
        else
        {
            include_once("FormEspecificarDetalles.php");
            $formulario = new FormEspecificarDetalles;
            $formulario->formEspecificarDetallesShow($producto);
        }
    
    }

    public function adicionarProducto($idProducto,$cantidad)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $producto = $eProducto->obtenerProducto($idProducto);

        if (!$producto)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow(
                "Producto no encontrado");
        }
        else 
        {
            
            $this->agregarListaTemporal($producto, $cantidad);

            include_once("../Entidades/Marca.php");
            $eMarca = new Marca;
            $listaMarcas = $eMarca->obtenerMarcas();

            include_once("FormGenerarPedido.php");
            $formulario = new FormGenerarPedido;
            $formulario->formGenerarPedidoShow($listaMarcas);
        }

    }

    public function eliminarProductoPedido($idProducto)
    {
        $this->eliminarDeListaTemporal($idProducto);

        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormGenerarPedido.php");
        $formulario = new FormGenerarPedido;
        $formulario->formGenerarPedidoShow($listaMarcas);
    }

    public function generarPedido()
    {
        if ($this->verificarListaTemporal() == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow(
                "Pedido vacío");
        }
        else
        {
            include_once("FormVistaPreliminarPedido.php");
            $formulario = new FormVistaPreliminarPedido;
            $formulario->formVistaPreliminarPedidoShow();
        }
    }

    public function confirmarPedido($observaciones)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $idPedidoAlmacen = $ePedidoAlmacen->guardarPedido(
            $observaciones,
            date("Y:m:d H:i:s"),
            $_SESSION["autenticado"]["usuario"]["id_usuario"]
        );

        include_once("../Entidades/DetalleProductoPedidoAlmacen.php");
        $eDetalleProductoPedidoAlmacen = new DetalleProductoPedidoAlmacen;

        foreach ($_SESSION["productos_pedido"] as $productoPedido)
        {
            $eDetalleProductoPedidoAlmacen->guardarDetallePedidoProductoAlmacen(
                $productoPedido["producto"]["id_producto"],
                $idPedidoAlmacen,
                $productoPedido["cantidad"]
            );
        }

        unset($_SESSION["productos_pedido"]);

        $pedidoAlmacen = $ePedidoAlmacen->obtenerPedidoAlmacen($idPedidoAlmacen);
        $listaProductosPedido = $eDetalleProductoPedidoAlmacen->obtenerProductosPedidosAlmacen($idPedidoAlmacen);

        include_once("FormVerPedido.php");
        $formulario = new FormVerPedido;
        $formulario->formVerPedidoShow($pedidoAlmacen, $listaProductosPedido);
    }

    private function agregarListaTemporal($producto, $cantidad)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["productos_pedido"])) {
            $_SESSION["productos_pedido"] = array();   
        }

        $encontrado = -1;
        for ($i = 0; $i < count($_SESSION["productos_pedido"]); $i++) {
            $productoProforma = $_SESSION["productos_pedido"][$i];
            if ($productoProforma["producto"]["id_producto"] == 
            $producto["id_producto"])
            {
                $encontrado = $i;
                break;
            }
        }

        if ($encontrado != -1) 
        {
            $_SESSION["productos_pedido"][$encontrado]["cantidad"] = $cantidad;
        }
        else {
            array_push($_SESSION["productos_pedido"], array(
                "producto" => $producto,
                "cantidad" => $cantidad
            ));
        }
    }

    private function eliminarDeListaTemporal($idProducto)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["productos_pedido"])) {
            $encontrado = -1;
            for ($i = 0; $i < count($_SESSION["productos_pedido"]); $i++) {
                $productoPedido = $_SESSION["productos_pedido"][$i];
                if ($productoPedido["producto"]["id_producto"] == $idProducto)
                {
                    $encontrado = $i;
                    break;
                }
            }

            if ($encontrado != -1) 
            {
                array_splice($_SESSION["productos_pedido"], $encontrado, 1);
            }
        }
    }

    private function verificarListaTemporal()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["productos_pedido"])) {
            if (!empty($_SESSION["productos_pedido"])) {
                return 1;
            }
        }

        return 0;
    }
}

?>