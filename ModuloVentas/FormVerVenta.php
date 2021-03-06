<?php

class FormVerVenta
{
    public function formVerVentaShow(
        $venta,
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
    <title>Ver Venta</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Ver venta</h1>
            <div class="card">
                <div class="card-body row">
                    <p class="col-md-2">
                        <strong>Venta Nº:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo str_pad($venta["id_venta"], 7, "0", STR_PAD_LEFT); ?>
                    </p>
                    <p class="col-md-2">
                        <strong>
                            <?php 
                            if (is_null($venta["id_boleta"])) { 
                                echo "Factura Nº:";
                            } else {
                                echo "Boleta Nº:";
                            }    
                            ?>
                        </strong>
                    </p>
                    <p class="col-md-10">
                        <?php 
                        if (is_null($venta["id_boleta"])) { 
                            echo str_pad($venta["id_factura"], 7, "0", STR_PAD_LEFT);
                        } else {
                            echo str_pad($venta["id_boleta"], 7, "0", STR_PAD_LEFT);
                        }   
                        ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Señor(es):</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $venta["nombres"]; ?>
                        <?php echo $venta["ape_paterno"]; ?>
                        <?php echo $venta["ape_materno"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Fecha Emisión:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $venta["fecha_emision"]; ?>
                    </p>
                    <p class="col-md-2">
                        <strong>
                            <?php 
                            if (is_null($venta["id_boleta"])) { 
                                echo "RUC:";
                            } else {
                                echo "DNI:";
                            }    
                            ?>
                        </strong>
                    </p>
                    <p class="col-md-10">
                        <?php 
                        if (is_null($venta["id_boleta"])) { 
                            echo $venta["ruc"];
                        } else {
                            echo $venta["dni"];
                        }   
                        ?>
                    </p>
                    <p class="col-md-2">
                        <strong>Vendido Por:</strong>
                    </p>
                    <p class="col-md-10">
                        <?php echo $venta["nombre_usuario_venta"]; ?>
                        <?php echo $venta["ape_paterno_usuario_venta"]; ?>
                        <?php echo $venta["ape_materno_usuario_venta"]; ?>
                    </p>
                </div>
            </div>
            <h3 class="mt-3 mb-3">Productos vendidos</h3>
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
                <form action="GetPDFVenta.php" method="GET">
                    <input type="hidden" name="id-venta" value="<?php echo $venta["id_venta"]; ?>" />
                    <div class="card-footer text-center">
                        <button name="boton" class="btn btn-primary">
                            Imprimir
                        </button>
                    </div>
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