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
$idRol = $_POST["id-rol"];
$valor = $_POST["valor"];

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
    $controller->habilitarRol($idRol, $valor);
}

?>