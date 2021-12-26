<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = isset($_GET["boton"]) ? $_GET["boton"] : null;
$idVenta = isset($_GET["id-venta"]) && !empty(trim($_GET["id-venta"])) ? trim($_GET["id-venta"]) : null;
$boleta = isset($_GET["boleta"]) ? true : false;
$factura = isset($_GET["factura"]) ? true : false;

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerGestionarDespacho.php");
    $controller = new ControllerGestionarDespacho;
    $controller->buscarVentas(
        $idVenta,
        $boleta,
        $factura
    );
}

?>