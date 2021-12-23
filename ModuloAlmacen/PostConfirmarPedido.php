<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_POST["boton"];
$observaciones = $_POST["observaciones"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{

    include_once("ControllerGenerarPedido.php");
    $controller = new ControllerGenerarPedido;
    $controller->confirmarPedido($observaciones);
}

?>