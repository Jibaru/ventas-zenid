<?php

function validarBoton($boton)
{
    if (isset($boton))
        return (1);
    else
        return (0);
}

$boton = $_POST["boton"];
$idPedido = $_POST["id-pedido-almacen"];
$idProveedor = $_POST["id-proveedor"];

if (validarBoton($boton) == 0)
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else
{
    include_once("ControllerAprobarPedido.php");
    $controller = new ControllerAprobarPedido;
    $controller->aprobarPedido($idPedido, $idProveedor);
}

?>