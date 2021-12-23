<?php

class FormVistaPreliminarProforma
{
    public function formVistaPreliminarProformaShow()
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
    <title>Vista Preliminar Proforma</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-100 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header text-center">
                <h3>Vista Preliminar Proforma</h3>
            </div>
            <form action="PostNuevaProforma.php" method="POST">
                <div class="card-body">
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label>Nombre Referencial</label>
                            <input type="text" name="nombre-referencial" class="form-control" required />
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
                                    <th>IGV</th>
                                    <th>Subtotal (S/.)</th>
                                    <th>Total IGV (S/.)</th>
                                    <th>Total + IGV (S/.)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $subTotal = 0;
                                    $igvTotal = 0;
                                    foreach ($_SESSION["productos_proforma"] as $productoProforma) {
                                        $precio = $productoProforma["producto"]["precio_venta"];
                                        $igv = $productoProforma["producto"]["igv"];
                                        $subTotal += ($precio * $productoProforma["cantidad"]);
                                        $igvTotal += ($igv * $precio * $productoProforma["cantidad"]);
                                    }
                                    $total = $subTotal + $igvTotal;
                                ?>
                                <?php foreach ($_SESSION["productos_proforma"] as $productoProforma) { ?>
                                <?php
                                    $cantidad= $productoProforma["cantidad"];
                                    $precio = $productoProforma["producto"]["precio_venta"];
                                    $igv = $productoProforma["producto"]["igv"];
                                    $subtotalProducto = $cantidad * $precio;
                                    $totalIGVProducto = $subtotalProducto * $igv;
                                    $totalProducto = $subtotalProducto + $totalIGVProducto;
                                ?>
                                <tr>
                                    <td><?php echo $productoProforma["producto"]["codigo_barras"]; ?></td>
                                    <td><?php echo $productoProforma["producto"]["nombre"]; ?></td>
                                    <td><?php echo $productoProforma["producto"]["descripcion"]; ?></td>
                                    <td class="text-end"><?php echo $productoProforma["producto"]["precio_venta"]; ?>
                                    </td>
                                    <td class="text-end"><?php echo $cantidad; ?></td>
                                    <td class="text-end">
                                        <?php echo $productoProforma["producto"]["igv"]; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php echo $subtotalProducto; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php echo $totalIGVProducto; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php echo $totalProducto; ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="7" class="text-end">
                                        <?php echo $subTotal; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php echo $igvTotal; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php echo $total; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="8" class="text-end">
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
                        Proformar
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