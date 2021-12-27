<?php

class FormPDFVenta
{
    public function formPDFVentaShow(
        $venta,
        $listaProductosProformados
    )
    {
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>PDF Venta</title>
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
            <?php echo $venta["fecha_emision"]; ?>
        </header>
        <h1>
            Venta Nº <?php echo str_pad($venta["id_venta"], 7, "0", STR_PAD_LEFT); ?>
        </h1>
        <hr>
        <div>
            <p><strong>Señor(es):</strong></p>
            <p>
                <?php echo $venta["nombres"]; ?>
                <?php echo $venta["ape_paterno"]; ?>
                <?php echo $venta["ape_materno"]; ?>
            </p>
            <p><strong>Fecha Emisión:</strong></p>
            <p><?php echo $venta["fecha_emision"]; ?></p>
            <p>
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
            <p>
                <?php 
                if (is_null($venta["id_boleta"])) { 
                    echo $venta["ruc"];
                } else {
                    echo $venta["dni"];
                }   
                ?>
            </p>
            <p><strong>Vendido por:</strong></p>
            <p>
                <?php echo $venta["nombre_usuario_venta"]; ?>
                <?php echo $venta["ape_paterno_usuario_venta"]; ?>
                <?php echo $venta["ape_materno_usuario_venta"]; ?>
            </p>
        </div>
        <hr>
        <h3>Productos vendidos</h3>
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