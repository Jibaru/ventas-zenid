<?php

$idProducto = $_POST["id-producto"];
$cantidad = $_POST["cantidad"];

include_once("ControllerEmitirProforma.php");
$controller = new ControllerEmitirProforma;
$controller->agregarProductoProforma(
    $idProducto,
    $cantidad
);

?>