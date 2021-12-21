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
$idUsuario = $_POST["id-usuario"];
$valor = $_POST["valor"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerGestionarUsuarios.php");
    $controller = new ControllerGestionarUsuarios;
    $controller->habilitarUsuario($idUsuario, $valor);
}

?>