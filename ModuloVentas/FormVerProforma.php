<?php

class FormVerProforma
{
    public function formVerProformaShow($proforma, $listaProductosProformados)
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
    <title>Ver Proforma</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Ver proforma</h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostNuevaProforma.php" method="POST">
                        <div class="card-body">
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <?php echo $proforma["nombre_referencial"]; ?>
                                    <?php echo $proforma["fecha_emision"]; ?>
                                    <?php echo $proforma["id_usuario"]; ?>
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
                                    foreach ($listaProductosProformados as $productoProforma) {
                                        $precio = $productoProforma["precio_venta"];
                                        $igv = $productoProforma["igv"];
                                        $subTotal += ($precio * $productoProforma["cantidad"]);
                                        $igvTotal += ($igv * $precio * $productoProforma["cantidad"]);
                                    }
                                    $total = $subTotal + $igvTotal;
                                ?>
                                        <?php foreach ($listaProductosProformados as $productoProforma) { ?>
                                        <?php
                                    $cantidad= $productoProforma["cantidad"];
                                    $precio = $productoProforma["precio_venta"];
                                    $igv = $productoProforma["igv"];
                                    $subtotalProducto = $cantidad * $precio;
                                    $totalIGVProducto = $subtotalProducto * $igv;
                                    $totalProducto = $subtotalProducto + $totalIGVProducto;
                                ?>
                                        <tr>
                                            <td><?php echo $productoProforma["codigo_barras"]; ?></td>
                                            <td><?php echo $productoProforma["nombre"]; ?></td>
                                            <td><?php echo $productoProforma["descripcion"]; ?></td>
                                            <td class="text-end"><?php echo $productoProforma["precio_venta"]; ?>
                                            </td>
                                            <td class="text-end"><?php echo $cantidad; ?></td>
                                            <td class="text-end">
                                                <?php echo $productoProforma["igv"]; ?>
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
                                Imprimir
                            </button>
                        </div>
                    </form>
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