<?php

class ControllerGenerarReporteVentas
{
    public function obtenerVentas($fechaInicio, $fechaFin)
    {
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $listaVentasReporte = $eVenta->obtenerVentasReporte($fechaInicio, $fechaFin);

        if (empty($listaVentasReporte))
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Ventas no encontradas");
        }
        else
        {
            include_once("FormGenerarReporteVentas.php");
            $formulario = new FormGenerarReporteVentas;
            $formulario->formGenerarReporteVentasShow($listaVentasReporte);
        }
    }

    public function generarPDF($fechaInicio, $fechaFin)
    {
        include_once("../Entidades/Venta.php");
        $eVenta = new Venta;
        $listaVentasReporte = $eVenta->obtenerVentasReporte($fechaInicio, $fechaFin);

        ob_start();
        include_once("FormPDFReporteVentas.php");
        $formulario = new FormPDFReporteVentas;
        $formulario->formPDFReporteVentasShow($listaVentasReporte);
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
        $dompdf->stream("PDF Reporte Ventas", array("Attachment" => 0));
    }
}

?>