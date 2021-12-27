<?php

function validarCampo($ruc)
{
    if (empty($ruc) || strlen($ruc) != 11) {
        return 0;
    }
    return 1;
}

$ruc = $_POST["ruc"];

if (validarCampo($ruc) == 0)
{
    echo json_encode(array(
        "ok" => false,
        "mensaje" => "El RUC no puede estar vacío y debe contener 11 dígitos"
    ));
}
else
{
    include_once("ControllerRealizarVenta.php");
    $controller = new ControllerRealizarVenta;
    $controller->validarRuc($ruc);
}

?>