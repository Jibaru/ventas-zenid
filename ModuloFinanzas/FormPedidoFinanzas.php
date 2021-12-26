<?php

class FormPedidoFinanzas
{
    public function formPedidoFinanzasShow($pedido, $listaProductosPedido)
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
    <title>Pedido Finanzas</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Pedido Finanzas</h1>
            <div class="card">
                <div class="card-body row">
                    <p class="col-md-2">
                        <strong>Observaciones:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["observaciones"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Fecha Emisión:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["fecha_emision"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Fecha Aprobación:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["fecha_aprobacion"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Realizado por:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["nombre_usuario_pedido"]; ?>
                        <?php echo $pedido["ape_paterno_usuario_pedido"]; ?>
                        <?php echo $pedido["ape_materno_usuario_pedido"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Aprobado por:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["nombre_usuario_aprobacion"]; ?>
                        <?php echo $pedido["ape_paterno_usuario_aprobacion"]; ?>
                        <?php echo $pedido["ape_materno_usuario_aprobacion"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Nombre Proveedor:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["nombre_proveedor"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Correo Electrónico Proveedor:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["correo_electronico_proveedor"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Teléfono Proveedor:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $pedido["telefono_proveedor"]; ?>
                    </p>
                </div>
            </div>
            <h3 class="mt-3 mb-3">Productos pedidos</h3>
            <div class="card">
                <div class="card-body">
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
                                foreach ($listaProductosPedido as $productoPedido) {
                                    $precio = $productoPedido["precio_compra_unitario"];
                                    $total += ($precio * $productoPedido["cantidad"]);
                                }
                            ?>
                            <?php foreach ($listaProductosPedido as $productoPedido) { ?>
                            <?php
                                $cantidad= $productoPedido["cantidad"];
                                $precio = $productoPedido["precio_compra_unitario"];
                                $subtotalProducto = $cantidad * $precio;
                            ?>
                            <tr>
                                <td><?php echo $productoPedido["codigo_barras"]; ?></td>
                                <td><?php echo $productoPedido["nombre"]; ?></td>
                                <td><?php echo $productoPedido["descripcion"]; ?></td>
                                <td class="text-end">
                                    <?php echo $productoPedido["precio_compra_unitario"]; ?>
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
            <div class="mt-2 mb-2 text-center">
                <form action="GetPDFPedidoFinanzas.php">
                    <input type="hidden" name="id-pedido" value="<?php echo $pedido["id_pedido_almacen"]; ?>" />
                    <button class="btn btn-primary">Imprimir</button>
                </form>
            </div>
        </section>
    </main>
    <?php include_once("../layout/Scripts.php"); ?>
</body>

</html>
<?php
    }
}

?>