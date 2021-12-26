<?php

class FormGestionarDespacho
{
    public function formGestionarDespachoShow($listaVentas = array())
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
    <title>Gestionar Despacho</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Gestionar Despacho</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarVentas.php" method="GET" class="row">
                        <div class="form-group col-md-6">
                            <label>Código</label>
                            <input type="text" name="id-venta" class="form-control">
                        </div>
                        <div class="form-group col-md-2">
                            <input class="form-check-input" type="checkbox" value="boleta" name="boleta" checked />
                            <label class="form-check-label">
                                Boleta
                            </label><br>
                            <input class="form-check-input" type="checkbox" value="factura" name="factura" checked />
                            <label class="form-check-label">
                                Factura
                            </label>
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
                                    <th>Para</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Despacho</th>
                                    <th>Vendido por</th>
                                    <th>Tipo comprobante</th>
                                    <th class="text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaVentas as $venta) { ?>
                                <tr>
                                    <td><?php echo $venta["id_venta"] ?></td>
                                    <td>
                                        <?php echo $venta["nombres"] ?>
                                        <?php echo $venta["ape_paterno"] ?>
                                        <?php echo $venta["ape_materno"] ?>
                                    </td>
                                    <td><?php echo $venta["fecha_emision"] ?></td>
                                    <td>
                                        <?php if (!is_null($venta["fecha_despacho"])) { ?>
                                        <?php echo $venta["fecha_emision"] ?>
                                        <?php } else { ?>
                                        <span class="badge bg-danger text-white">
                                            Sin despachar
                                        </span>
                                        <?php } ?>
                                    </td>
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
                                    <td class="text-end">
                                        <form action="GetFormVerVenta.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-venta"
                                                value="<?php echo $venta["id_venta"] ?>">
                                            <button name="boton" class="btn btn-success">
                                                Ver
                                            </button>
                                        </form>
                                        <?php if (is_null($venta["fecha_despacho"])) { ?>
                                        <form action="PostDespacharVenta.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-venta"
                                                value="<?php echo $venta["id_venta"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Despachar
                                            </button>
                                        </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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