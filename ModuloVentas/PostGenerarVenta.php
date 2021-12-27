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
$idProforma = $_POST["id-proforma"];
$nombres = trim($_POST["nombres"]);
$apePaterno = trim($_POST["ape-paterno"]);
$apeMaterno = trim($_POST["ape-materno"]);
$tipoComprobante = trim($_POST["tipo-comprobante"]);
$comprobante = $_POST["comprobante"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerRealizarVenta.php");
    $controller = new ControllerRealizarVenta;
    $controller->generarVenta(
        $idProforma,
        $nombres,
        $apePaterno,
        $apeMaterno,
        $tipoComprobante,
        $comprobante
    );
}

?>