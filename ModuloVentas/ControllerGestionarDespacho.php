<?php

class ControllerGestionarDespacho
{
    public function buscarVentas(
        $idVenta,
        $boleta,
        $factura
    )
    {
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $listaVentas = $eVenta->obtenerVentas($idVenta, $boleta, $factura);

        if (empty($listaVentas))
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Ventas no encontradas");
        }
        else
        {
            include_once("FormGestionarDespacho.php");
            $formulario = new FormGestionarDespacho;
            $formulario->formGestionarDespachoShow($listaVentas);
        }
    }

    public function obtenerVenta($idVenta)
    {
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $venta = $eVenta->obtenerVenta($idVenta);

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($venta["id_proforma"]);
        
        include_once("FormVerVenta.php");
        $formulario = new FormVerVenta;
        $formulario->formVerVentaShow($venta, $listaProductosProformados);
    }

    public function despacharVenta($idVenta)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $venta = $eVenta->despacharVenta(
            $idVenta,
            date("Y:m:d H:i:s"),
            $_SESSION["autenticado"]["usuario"]["id_usuario"]
        );

        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaRutaShow(
            "Venta despachada",
            "GetFormGestionarDespacho.php"
        );
    }
}

?>