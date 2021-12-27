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
$valor = isset($_GET["valor"]) && !empty(trim($_GET["valor"])) ? trim($_GET["valor"]) : null;

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
    $controller->buscarProformas($valor);
}

?>