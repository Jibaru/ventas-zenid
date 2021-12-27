<?php

class FormProformaSeleccionada
{
    public function formProformaSeleccionadaShow(
        $proforma, 
        $listaProductosProformados
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
    <title>Proforma Seleccionada</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Proforma Seleccionada</h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostGenerarVenta.php" method="POST" class="row">
                        <input type="hidden" name="id-proforma" value="<?php echo $proforma["id_proforma"]; ?>" />
                        <div class="form-group col-md-3">
                            <label>Nombres</label>
                            <input type="text" name="nombres" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Apellido Paterno</label>
                            <input type="text" name="ape-paterno" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Apellido Materno</label>
                            <input type="text" name="ape-materno" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="radio" name="tipo-comprobante" value="boleta" required class="form-check-input"
                                checked>
                            <label>Boleta</label>
                            <input id="chk-factura" type="radio" name="tipo-comprobante" value="factura"
                                class="form-check-input" required>
                            <label>Factura</label>
                            <input id="comprobante" type="number" name="comprobante" class="form-control"
                                placeholder="Nº DNI" class="form-control" required>
                            <span id="nombre-empresa" class="mt-1 alert"></span>
                            <button id="btn-validar-ruc" type="button" name="boton"
                                class="btn btn-warning w-100 mt-1">Validar
                                RUC</button>
                        </div>
                        <div class="form-group mt-2 d-flex justify-content-center">
                            <button id="btn-generar-venta" name="boton" class="btn btn-primary">
                                Generar Venta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <h3 class="mt-3 mb-3">Proforma</h3>
            <div class="card">
                <div class="card-body row">
                    <p class="col-md-2">
                        <strong>Nombre Referencial:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $proforma["nombre_referencial"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Fecha Emisión:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $proforma["fecha_emision"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Realizado por:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $proforma["nombre_usuario"]; ?>
                        <?php echo $proforma["ape_paterno_usuario"]; ?>
                        <?php echo $proforma["ape_materno_usuario"]; ?>
                    </p>
                </div>
            </div>
            <h3 class="mt-3 mb-3">Productos proformados</h3>
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
        </section>
    </main>
    <?php include_once("../layout/Scripts.php"); ?>
    <script src="../assets/js/ModuloVentas/FormProformaSeleccionada.js"></script>
</body>

</html>
<?php
    }
}

?>