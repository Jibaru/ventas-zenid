<?php

class FormGenerarReporteVentas
{
    public function formGenerarReporteVentasShow($listaVentas = array())
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
    <title>Generar Reporte Ventas</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Generar Reporte Ventas</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarVentasReporte.php" method="GET" class="row">
                        <div class="form-group col-md-5">
                            <label>Fecha Inicio</label>
                            <input type="date" name="fecha-inicio" class="form-control"
                                value="<?php echo $_GET["fecha-inicio"]; ?>">
                        </div>
                        <div class="form-group col-md-5">
                            <label>Fecha Fin</label>
                            <input type="date" name="fecha-fin" class="form-control"
                                value="<?php echo $_GET["fecha-fin"];?>">
                        </div>
                        <div class="form-group col-md-2 mt-4">
                            <button name="boton" class="btn btn-primary w-100">
                                Buscar Ventas
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Fecha Emisión</th>
                                    <th>Vendido por</th>
                                    <th>Tipo comprobante</th>
                                    <th>Uni. vendidas</th>
                                    <th>Total venta S/.</th>
                                    <th>Total compra S/.</th>
                                    <th>Ganancia S/.</th>
                                    <th class="text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaVentas as $venta) { ?>
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
                                    <td><?php echo $venta["unidades"] ?></td>
                                    <td><?php echo $venta["total_venta"] ?></td>
                                    <td><?php echo $venta["total_compra"] ?></td>
                                    <td><?php echo ($venta["total_venta"] - $venta["total_compra"]); ?></td>
                                    <td class="text-end">
                                        <form action="../ModuloVentas/GetFormVerVenta.php" method="GET"
                                            class="d-inline">
                                            <input type="hidden" name="id-venta"
                                                value="<?php echo $venta["id_venta"] ?>">
                                            <button name="boton" class="btn btn-success">
                                                Ver
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php if (!empty($listaVentas)) { ?>
                <div class="card-footer text-center">
                    <form action="GetFormPDFReporteVentas.php" method="GET">
                        <input type="hidden" name="fecha-inicio" value="<?php echo $_GET["fecha-inicio"]; ?>">
                        <input type="hidden" name="fecha-fin" value="<?php echo $_GET["fecha-fin"]; ?>">
                        <button name="boton" class="btn btn-success">
                            Generar Reporte de Ventas
                        </button>
                    </form>
                </div>
                <?php } ?>
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