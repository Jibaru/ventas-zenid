<?php

class FormPDFVenta
{
    public function formPDFVentaShow(
        $venta,
        $listaProductosProformados
    )
    {
        $path = "../assets/img/logo.png";
        $tipo = pathinfo($path, PATHINFO_EXTENSION);
        $datos = file_get_contents($path);
        $base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($datos);
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

    #productos th,
    #productos td {
        border: 1px solid black;
        padding: 0;
        padding: 5px;
    }

    .text-end {
        text-align: right;
    }

    .titulo-descripcion {
        width: 120px;
    }

    .contenido-descripcion {
        width: 50%;
        text-align: right;
    }

    .titulo-descripcion-pagar {
        width: 200px;
    }

    .pago {
        font-size: 1.2rem;
    }

    #sumario {
        width: 100%;
        border: 0;
        font-size: 1.1rem;
    }
    </style>
    <main>
        <header>
            <?php echo $venta["fecha_emision"]; ?>
        </header>
        <div class="text-end">
            <img src="<?php echo $base64?>" height="80" />
        </div>
        <h1>
            <?php 
            if (is_null($venta["id_boleta"])) { 
                echo "Factura Nº: " . str_pad($venta["id_factura"], 7, "0", STR_PAD_LEFT);;
            } else {
                echo "Boleta Nº: " . str_pad($venta["id_boleta"], 7, "0", STR_PAD_LEFT);;
            }    
            ?>
        </h1>
        <p>
            De: Marcelina Donata García Marcelo de Cóndor<br>
            Venta de Artículos de librería y regalos para toda ocasión.<br>
            Av. Jorge E. Chávez Sector 6 Grupo 5<br>
            Mz. M Lt. 05 - Villa el Salvador<br>
            Telf.: 287-6890
        </p>
        <hr>
        <table cellspacing="0" style="width: 100%; border: 0;">
            <tbody>
                <tr>
                    <td class="titulo-descripcion"><strong>Fecha Emisión</strong></td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php echo date("d/m/Y", strtotime($venta["fecha_emision"])); ?>
                    </td>
                </tr>
                <tr>
                    <td class="titulo-descripcion"><strong>Señor(es)</strong></td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php echo strtoupper($venta["nombres"]); ?>
                        <?php echo strtoupper($venta["ape_paterno"]); ?>
                        <?php echo strtoupper($venta["ape_materno"]); ?>
                    </td>
                </tr>
                <tr>
                    <td class="titulo-descripcion">
                        <strong>
                            <?php 
                            if (is_null($venta["id_boleta"])) { 
                                echo "RUC Nº";
                            } else {
                                echo "DNI Nº";
                            }    
                            ?>
                        </strong>
                    </td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php 
                        if (is_null($venta["id_boleta"])) { 
                            echo $venta["ruc"];
                        } else {
                            echo $venta["dni"];
                        } 
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="titulo-descripcion">
                        <strong>Vendido Por</strong>
                    </td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php echo strtoupper($venta["nombre_usuario_venta"]); ?>
                        <?php echo strtoupper($venta["ape_paterno_usuario_venta"]); ?>
                        <?php echo strtoupper($venta["ape_materno_usuario_venta"]); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr>
        <h3>Productos vendidos</h3>
        <table id="productos" cellspacing="0">
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
        <hr style="margin: 20px 0;">
        <table cellspacing="0" id="sumario">
            <tbody>
                <tr>
                    <td class="titulo-descripcion-pagar">
                        <strong>SUBTOTAL (S/.)</strong>
                    </td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php echo $subTotal; ?>
                    </td>
                </tr>
                <tr>
                    <td class="titulo-descripcion-pagar">
                        <strong>IGV (S/.)</strong>
                    </td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion">
                        <?php echo $igvTotal; ?>
                    </td>
                </tr>
                <tr>
                    <td class="titulo-descripcion-pagar">
                        <strong>TOTAL A PAGAR (S/.)</strong>
                    </td>
                    <td style="width: 10px;">:</td>
                    <td class="contenido-descripcion pago">
                        <strong>
                            <?php echo $total; ?>
                        </strong>
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