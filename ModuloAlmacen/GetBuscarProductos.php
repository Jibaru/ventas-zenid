<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCampos($nombre)
{
    if (is_null($nombre)|| !empty($nombre))
		return(1);
	else
		return(0);
}

// Inicio
$boton = isset($_GET["boton"]) ? $_GET["boton"] : null;
$nombre = isset($_GET["nombre"]) && !empty(trim($_GET["nombre"])) ? trim($_GET["nombre"]) : null;

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{

    if (validarCampos($nombre) == 0)
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("El nombre no puede estar vacío");
    }
    else
    {
        include_once("ControllerGestionarProductos.php");
        $controller = new ControllerGestionarProductos;
        $controller->buscarProductos(
            $nombre);
    }
}

?>