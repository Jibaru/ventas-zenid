<?php

$idProducto = $_POST["id-producto"];

include_once("ControllerEmitirProforma.php");
$controller = new ControllerEmitirProforma;
$controller->eliminarProductoProforma($idProducto);

?>