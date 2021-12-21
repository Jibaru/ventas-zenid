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
$idRol = $_GET["id-rol"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerGestionarRoles.php");
    $controller = new ControllerGestionarRoles;
    $controller->buscarRol($idRol);
}

?>