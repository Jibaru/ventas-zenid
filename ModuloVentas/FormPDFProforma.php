<?php

class FormPDFProforma
{
    public function formPDFProformaShow($proforma, $listaProductosProformados)
    {
        
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PDF Proforma</title>
</head>

<body>
    <style>
    header,
    h1 {
        margin: 0;
        padding: 0;
    }

    header {
        text-align: right;
    }

    th,
    td {
        border: 1px solid black;
        padding: 0;
        padding: 5px;
    }

    .text-end {
        text-align: right;
    }
    </style>
    <main>
        <header>
            <?php echo $proforma["fecha_emision"]; ?>
        </header>
        <h1>Proforma Nº <?php echo $proforma["id_proforma"]; ?></h1>
        <hr>
        <div>
            <p><strong>Nombre Referencial:</strong></p>
            <p><?php echo $proforma["nombre_referencial"]; ?></p>
            <p><strong>Fecha Emisión:</strong></p>
            <p><?php echo $proforma["fecha_emision"]; ?></p>
            <p><strong>Realizado por:</strong></p>
            <p>
                <?php echo $proforma["nombre_usuario"]; ?>
                <?php echo $proforma["ape_paterno_usuario"]; ?>
                <?php echo $proforma["ape_materno_usuario"]; ?>
            </p>
        </div>
        <hr>
        <h3>Productos proformados</h3>
        <table cellspacing="0">
            <thead>
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
    </main>
</body>

</html>
<?php
    }
}

?>