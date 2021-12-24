<?php

// Functiones
function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_GET["boton"];
$idProveedor = $_GET["id-proveedor"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerEncargadoFinanzas.php");
    $controller = new ControllerEncargadoFinanzas;
    $controller->editarProveedor($idProveedor);
}

?>