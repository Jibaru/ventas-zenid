<?php

class FormPDFReporteVentas
{
    public function formPDFReporteVentasShow($listaVentas)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $totalUnidades = 0;
        $totalVenta = 0;
        $totalCompra = 0;
        $path = "../assets/img/logo.png";
        $tipo = pathinfo($path, PATHINFO_EXTENSION);
        $datos = file_get_contents($path);
        $base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($datos);
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Reporte Ventas</title>
    <?php include_once("../layout/Estilos.php"); ?>
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

    #ventas th,
    #ventas td {
        border: 1px solid black;
        padding: 0;
        padding: 5px;
    }

    .text-end {
        text-align: right;
    }

    .box {
        margin-bottom: 10px;
    }
    </style>
    <main>
        <header>
            <?php echo date("d-m-Y"); ?>
        </header>
        <div class="text-end">
            <img src="<?php echo $base64?>" height="80" />
        </div>
        <h1>Reporte de Ventas</h1>
        <hr>
        <?php if (!empty($_GET["fecha-inicio"])) { ?>
        <div class="box">
            <span><strong>Fecha Inicio:</strong></span>
            <span><?php echo $_GET["fecha-inicio"]; ?></span>
        </div>
        <?php } ?>
        <?php if (!empty($_GET["fecha-fin"])) { ?>
        <div class="box">
            <span><strong>Fecha Fin:</strong></span>
            <span><?php echo $_GET["fecha-fin"]; ?></span>
        </div>
        <?php } ?>
        <?php if (!empty($_GET["fecha-inicio"]) || !empty($_GET["fecha-fin"])) { ?>
        <hr>
        <?php } ?>
        <table cellspacing="0" id="ventas">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha Emisión</th>
                    <th>Vendido por</th>
                    <th>Tipo comprobante</th>
                    <th>Uni. vendidas</th>
                    <th>Total venta S/.</th>
                    <th>Total compra S/.</th>
                    <th>Ganancia S/.</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaVentas as $venta) { ?>
                <?php
                    $totalUnidades += $venta["unidades"];
                    $totalVenta += $venta["total_venta"];
                    $totalCompra += $venta["total_compra"];
                ?>
                <tr>
                    <td><?php echo $venta["id_venta"] ?></td>
                    <td><?php echo date("d/m/Y", strtotime($venta["fecha_emision"])) ?></td>
                    <td>
                        <?php echo $venta["nombre_usuario_venta"] ?>
                        <?php echo $venta["ape_paterno_usuario_venta"] ?>
                        <?php echo $venta["ape_materno_usuario_venta"] ?>
                    </td>
                    <td>
                        <?php if (is_null($venta["id_boleta"])) { ?>
                        <span class="badge bg-primary">FACTURA</span>
                        <?php } else { ?>
                        <span class="badge bg-success">BOLETA</span>
                        <?php } ?>
                    </td>
                    <td class="text-end"><?php echo $venta["unidades"] ?></td>
                    <td class="text-end"><?php echo $venta["total_venta"] ?></td>
                    <td class="text-end"><?php echo $venta["total_compra"] ?></td>
                    <td class="text-end"><?php echo ($venta["total_venta"] - $venta["total_compra"]); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <hr>
        <table cellspacing="0" style="width: 100%; border: 0;">
            <tbody>
                <tr>
                    <td><strong>Total Unidades Vendidas</strong></td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 20%;" class="text-end">
                        <?php echo $totalUnidades; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total Venta (S/.)</strong></td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 20%;" class="text-end">
                        <?php echo $totalVenta; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total Gastos en Compra (S/.)<strong /></td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 20%;" class="text-end">
                        <?php echo $totalCompra; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total Ganado (S/.)</strong></td>
                    <td style="width: 10px;">:</td>
                    <td style="width: 20%;" class="text-end">
                        <?php echo ($totalVenta - $totalCompra); ?>
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