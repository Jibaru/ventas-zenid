<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

$boton = $_GET["boton"];
$idVenta = $_GET["id-venta"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerRealizarVenta.php");
    $controller = new ControllerRealizarVenta;
    $controller->generarPDF($idVenta);
}

?>