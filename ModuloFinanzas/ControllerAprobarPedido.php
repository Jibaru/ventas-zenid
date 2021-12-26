<?php

class ControllerAprobarPedido
{
    public function obtenerPedidosAlmacen()
    {
        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $listaPedidos = $ePedidoAlmacen->obtenerPedidosAlmacen();

        include_once("FormListaPedidosAlmacen.php");
        $formulario = new FormListaPedidosAlmacen;
        $formulario->formListaPedidosAlmacenShow($listaPedidos);
    }

    public function obtenerPedido($idPedido)
    {
        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $pedido = $ePedidoAlmacen->obtenerPedidoAlmacen($idPedido);

        include_once("../Entidades/DetalleProductoPedidoAlmacen.php");
        $eDetallePedido = new DetalleProductoPedidoAlmacen;
        $listaProductosPedido = $eDetallePedido->obtenerProductosPedidosAlmacen(
            $idPedido);

        include_once("../Entidades/Proveedor.php");
        $eProveedor = new Proveedor;
        $listaProveedores = $eProveedor->obtenerProveedoresHabilitados();

        include_once("FormAprobarPedido.php");
        $formulario = new FormAprobarPedido;
        $formulario->formAprobarPedidoShow(
            $pedido, 
            $listaProductosPedido, 
            $listaProveedores);
    }

    public function aprobarPedido($idPedido, $idProveedor)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $ePedidoAlmacen->aprobarPedido(
            $idPedido, 
            $_SESSION["autenticado"]["usuario"]["id_usuario"],
            $idProveedor,
            date("Y:m:d H:i:s"),
        );

        $pedido = $ePedidoAlmacen->obtenerPedidoFinanzas($idPedido);

        include_once("../Entidades/DetalleProductoPedidoAlmacen.php");
        $eDetallePedido = new DetalleProductoPedidoAlmacen;
        $listaProductosPedido = $eDetallePedido->obtenerProductosPedidosAlmacen(
            $idPedido);

        include_once("FormPedidoFinanzas.php");
        $formulario = new FormPedidoFinanzas;
        $formulario->formPedidoFinanzasShow(
            $pedido, 
            $listaProductosPedido);
    }

    public function obtenerPDFPedidoFinanzas($idPedido)
    {
        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $pedido = $ePedidoAlmacen->obtenerPedidoFinanzas($idPedido);

        include_once("../Entidades/DetalleProductoPedidoAlmacen.php");
        $eDetallePedido = new DetalleProductoPedidoAlmacen;
        $listaProductosPedido = $eDetallePedido->obtenerProductosPedidosAlmacen(
            $idPedido);

        include_once("FormPDFPedidoFinanzas.php");
        $formulario = new FormPDFPedidoFinanzas;
        ob_start();
        $formulario->formPDFPedidoFinanzasShow(
            $pedido, 
            $listaProductosPedido);
        $html = ob_get_clean();

        $this->mostrarPDF($html);
    }
    
    public function verPedidoFinanzas($idPedido)
    {
        include_once("../Entidades/PedidoAlmacen.php");
        $ePedidoAlmacen = new PedidoAlmacen;
        $resultado = $ePedidoAlmacen->validarPedidoFinanzas($idPedido);

        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Pedido no aprobado");
        }
        else
        {
            $pedido = $ePedidoAlmacen->obtenerPedidoFinanzas($idPedido);

            include_once("../Entidades/DetalleProductoPedidoAlmacen.php");
            $eDetallePedido = new DetalleProductoPedidoAlmacen;
            $listaProductosPedido = $eDetallePedido->obtenerProductosPedidosAlmacen(
                $idPedido);

            include_once("FormPedidoFinanzas.php");
            $formulario = new FormPedidoFinanzas;
            $formulario->formPedidoFinanzasShow(
                $pedido, 
                $listaProductosPedido);
        }

        
    }

    private function mostrarPDF($html)
    {
        require_once("../vendor/autoload.php");
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("PDF Pedido", array("Attachment" => 0));
    }
}

?>