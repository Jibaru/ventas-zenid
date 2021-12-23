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
$idMarca = isset($_GET["id-marca"]) ? $_GET["id-marca"] : null;
$nombre = isset($_GET["nombre"]) && !empty(trim($_GET["nombre"])) ? trim($_GET["nombre"]) : null;

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
    $controller->buscarProductos(
        $nombre,
        $idMarca);
}

?>