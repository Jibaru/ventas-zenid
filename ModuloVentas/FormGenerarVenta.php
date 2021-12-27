<?php

class FormGenerarVenta
{
    public function formGenerarVentaShow($listaProformas = array())
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
    <title>Generar Venta</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Generar Venta</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarProformas.php" method="GET" class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre Referencial / Código Proforma</label>
                            <input type="text" name="valor" class="form-control">
                        </div>
                        <div class="form-group col-md-2 mt-4">
                            <button name="boton" class="btn btn-primary w-100">
                                Buscar Proformas
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
                                    <th>Nombre Referencial</th>
                                    <th>Fecha Emisión</th>
                                    <th>Proformado por</th>
                                    <th>Estado</th>
                                    <th class="text-center">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaProformas as $proforma) { ?>
                                <tr>
                                    <td><?php echo $proforma["id_proforma"] ?></td>
                                    <td>
                                        <?php echo $proforma["nombre_referencial"] ?>
                                    </td>
                                    <td><?php echo $proforma["fecha_emision"] ?></td>
                                    <td>
                                        <?php echo $proforma["nombre_usuario"] ?>
                                        <?php echo $proforma["ape_paterno_usuario"] ?>
                                        <?php echo $proforma["ape_materno_usuario"] ?>
                                    </td>
                                    <td>
                                        <?php if(is_null($proforma["id_venta"])) { ?>
                                        <span class="badge bg-warning">
                                            Sin vender
                                        </span>
                                        <?php } else { ?>
                                        <span class="badge bg-success">
                                            Vendido
                                        </span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <form action="GetFormVerProforma.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-proforma"
                                                value="<?php echo $proforma["id_proforma"] ?>">
                                            <button name="boton" class="btn btn-success">
                                                Ver
                                            </button>
                                        </form>
                                        <?php if(is_null($proforma["id_venta"])) { ?>
                                        <form action="GetFormProformaSeleccionada.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-proforma"
                                                value="<?php echo $proforma["id_proforma"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Seleccionar
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