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
$nombre = trim($_POST["nombre"]);

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerGestionarProductos.php");
    $controller = new ControllerGestionarProductos;
    $controller->nuevaMarca($nombre);
}

?>