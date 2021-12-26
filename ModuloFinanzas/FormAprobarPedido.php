<?php

class FormAprobarPedido
{
    public function formAprobarPedidoShow(
        $pedido,
        $listaProductosPedido,
        $listaProveedores
    )
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
    <title>Aprobar Pedido</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Aprobar Pedido</h1>
            <div class="row">
                <div class="col-md-8">
                    <div class="card me-2">
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
                                <strong>Realizado por:</strong>
                            </p>
                            <p class="col-md-10">
                                <?php echo $pedido["nombre_usuario_pedido"]; ?>
                                <?php echo $pedido["ape_paterno_usuario_pedido"]; ?>
                                <?php echo $pedido["ape_materno_usuario_pedido"]; ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <form action="PostAprobarPedido.php" method="POST">
                                <input type="hidden" name="id-pedido-almacen"
                                    value="<?php echo $pedido["id_pedido_almacen"]; ?>" />
                                <div class="form-group">
                                    <label>Seleccionar proveedor</label>
                                    <select name="id-proveedor" class="form-control">
                                        <?php foreach ($listaProveedores as $proveedor) { ?>
                                        <option value="<?php echo $proveedor["id_proveedor"] ?>">
                                            <?php echo $proveedor["nombre"] ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <button name="boton" class="btn btn-warning w-100 mt-2">
                                    Aprobar Pedido
                                </button>
                            </form>
                        </div>
                    </div>
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
        </section>
    </main>
    <?php include_once("../layout/Scripts.php"); ?>
</body>

</html>
<?php
    }
}

?>