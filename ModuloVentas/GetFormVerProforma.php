<?php

$idProforma = $_GET["id-proforma"];

include_once("ControllerRealizarVenta.php");
$controller = new ControllerRealizarVenta;
$controller->obtenerProforma($idProforma);

?>