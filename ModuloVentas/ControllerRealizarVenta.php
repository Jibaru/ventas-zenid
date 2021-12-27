<?php

class ControllerRealizarVenta
{
    public function buscarProformas($valor)
    {
        include_once("../Entidades/Proforma.php");
        $eProforma = new Proforma;
        $listaProformas = $eProforma->obtenerProformas($valor);

        include_once("FormGenerarVenta.php");
        $formulario = new FormGenerarVenta;
        $formulario->formGenerarVentaShow($listaProformas);
    }

    public function obtenerProforma($idProforma)
    {
        include_once("../Entidades/Proforma.php");
        $eProforma = new Proforma;
        $proforma = $eProforma->obtenerProforma($idProforma);

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($idProforma);
        
        include_once("FormVerProforma.php");
        $formulario = new FormVerProforma;
        $formulario->formVerProformaShow($proforma, $listaProductosProformados);
    }

    public function seleccionarProforma($idProforma)
    {
        include_once("../Entidades/Proforma.php");
        $eProforma = new Proforma;
        $proforma = $eProforma->obtenerProforma($idProforma);

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($idProforma);
        
        include_once("FormProformaSeleccionada.php");
        $formulario = new FormProformaSeleccionada;
        $formulario->formProformaSeleccionadaShow($proforma, $listaProductosProformados);
    }

    public function validarRuc($ruc)
    {
        include_once("../utils/Sunat.php");
        $sunat = new Sunat();
        echo json_encode($sunat->validarRuc($ruc));
    }

    public function generarVenta(
        $idProforma,
        $nombres,
        $apePaterno,
        $apeMaterno,
        $tipoComprobante,
        $comprobante
    )
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $idVenta = $eVenta->crearVenta(
            $idProforma,
            $nombres,
            $apePaterno,
            $apeMaterno,
            date("Y:m:d H:i:s"),
            $_SESSION["autenticado"]["usuario"]["id_usuario"]
        );

        if (strtolower($tipoComprobante) == "boleta")
        {
            include_once("../Entidades/Boleta.php");
            $eBoleta = new Boleta;
            $eBoleta->crearBoleta(
                $comprobante,
                date("Y:m:d H:i:s"),
                $idVenta
            );
        }
        else
        {
            include_once("../Entidades/Factura.php");
            $eFactura = new Factura;
            $eFactura->crearFactura(
                $comprobante,
                date("Y:m:d H:i:s"),
                $idVenta
            );
        }

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($idProforma);
        
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        foreach ($listaProductosProformados as $productoProformado)
        {
            $eProducto->reducirStock(
                $productoProformado["id_producto"], 
                $productoProformado["cantidad"]
            );
        }

        $venta = $eVenta->obtenerVenta($idVenta);

        include_once("FormVerVenta.php");
        $formulario = new FormVerVenta;
        $formulario->formVerVentaShow($venta, $listaProductosProformados);
    }

    public function generarPDF($idVenta)
    {
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $venta = $eVenta->obtenerVenta($idVenta);

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($venta["id_proforma"]);
        
        ob_start();
        require_once("FormPDFVenta.php");
        $formulario = new FormPDFVenta;
        $formulario->formPDFVentaShow(
            $venta,
            $listaProductosProformados
        );
        $html = ob_get_clean();

        $this->mostrarPDF($html);
    }

    private function mostrarPDF($html)
    {
        require_once("../vendor/autoload.php");
        $dompdf = new Dompdf\Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("PDF Venta", array("Attachment" => 0));
    }
}

?>