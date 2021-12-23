<?php

class FormVistaPreliminarPedido
{
    public function formVistaPreliminarPedidoShow()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Preliminar Pedido</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-100 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header text-center">
                <h3>Vista Preliminar Pedido</h3>
            </div>
            <form action="PostConfirmarPedido.php" method="POST">
                <div class="card-body">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control" rows="3"></textarea>
                        </div>
                        <label>Productos proformados</label>
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Cod. Barras</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio Unitario (S/.)</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal (S/.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total = 0;
                                    foreach ($_SESSION["productos_pedido"] as $productoPedido) {
                                        $precio = $productoPedido["producto"]["precio_compra_unitario"];
                                        $total += ($precio * $productoPedido["cantidad"]);
                                    }
                                ?>
                                <?php foreach ($_SESSION["productos_pedido"] as $productoPedido) { ?>
                                <?php
                                    $cantidad= $productoPedido["cantidad"];
                                    $precio = $productoPedido["producto"]["precio_compra_unitario"];
                                    $subtotalProducto = $cantidad * $precio;
                                ?>
                                <tr>
                                    <td><?php echo $productoPedido["producto"]["codigo_barras"]; ?></td>
                                    <td><?php echo $productoPedido["producto"]["nombre"]; ?></td>
                                    <td><?php echo $productoPedido["producto"]["descripcion"]; ?></td>
                                    <td class="text-end">
                                        <?php echo $productoPedido["producto"]["precio_compra_unitario"]; ?>
                                    </td>
                                    <td class="text-end"><?php echo $cantidad; ?></td>
                                    <td class="text-end">
                                        <?php echo $subtotalProducto; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <?php echo $total; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <b>Precio Total</b>
                                    </td>
                                    <td class="text-end">
                                        <b>
                                            <?php echo $total; ?>
                                        </b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button name="boton" class="btn btn-primary">
                        Realizar Pedido
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
    }
}

?>