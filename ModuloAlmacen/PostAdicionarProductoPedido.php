<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function verificarCantidad($cantidad)
{
    if ($cantidad == 0) 
        return 0;
    else
        return 1;
}

$boton = isset($_POST["boton"]) ? $_POST["boton"] : null;
$idProducto = $_POST["id-producto"];
$cantidad = $_POST["cantidad"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{

    if (verificarCantidad($cantidad) == 0)
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("No se indicó cantidad");
    }
    else 
    {
        include_once("ControllerGenerarPedido.php");
        $controller = new ControllerGenerarPedido;
        $controller->adicionarProducto(
            $idProducto,
            $cantidad
        );
    }
}

?>