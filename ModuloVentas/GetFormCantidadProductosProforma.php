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
$idProducto = $_GET["id-producto"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{

    include_once("ControllerEmitirProforma.php");
    $controller = new ControllerEmitirProforma;
    $controller->seleccionarProducto($idProducto);
}

?>