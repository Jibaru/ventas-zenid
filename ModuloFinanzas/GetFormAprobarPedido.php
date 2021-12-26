<?php

$idPedido = $_GET["id-pedido-almacen"];

include_once("ControllerAprobarPedido.php");
$controller = new ControllerAprobarPedido;
$controller->obtenerPedido($idPedido);

?>