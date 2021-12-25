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
$ruc = isset($_GET["ruc"]) && !empty(trim($_GET["ruc"])) ? trim($_GET["ruc"]) : null;

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerGestionarProveedores.php");
    $controller = new ControllerGestionarProveedores;
    $controller->buscarProveedores($ruc);
}

?>