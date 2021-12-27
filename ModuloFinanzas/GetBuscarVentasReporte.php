<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_GET["boton"];
$fechaInicio = isset($_GET["fecha-inicio"]) ? $_GET["fecha-inicio"] : null;
$fechaFin = isset($_GET["fecha-fin"]) ? $_GET["fecha-fin"] : null;

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{

    include_once("ControllerGenerarReporteVentas.php");
    $controller = new ControllerGenerarReporteVentas;
    $controller->obtenerVentas($fechaInicio, $fechaFin);
}

?>