<?php

$idPedido = $_GET["id-pedido"];

include_once("ControllerAprobarPedido.php");
$controller = new ControllerAprobarPedido;
$controller->verPedidoFinanzas($idPedido);

?>