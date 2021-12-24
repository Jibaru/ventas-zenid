<?php

class FormGestionarProveedores
{
    public function formGestionarProveedoresShow($listaProveedores = array())
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
    <title>Proveedores</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Proveedores</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarProveedores.php" method="GET" class="row">
                        <div class="form-group col-md-4">
                            <label>RUC</label>
                            <input type="text" name="ruc" class="form-control">
                        </div>
                        <div class="form-group col-md-2 mt-4">
                            <button name="boton" class="btn btn-primary w-100">Buscar</button>
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
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>RUC</th>
                                    <th>Teléfono</th>
                                    <th class="text-end">
                                        <form action="GetFormNuevoProveedor.php" method="POST">
                                            <button name="boton" class="btn btn-primary">
                                                Nuevo
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaProveedores as $proveedor) { ?>
                                <tr>
                                    <td><?php echo $proveedor["id_proveedor"] ?></td>
                                    <td><?php echo $proveedor["nombre"] ?></td>
                                    <td><?php echo $proveedor["correo_electronico"] ?></td>
                                    <td><?php echo $proveedor["ruc"] ?></td>
                                    <td><?php echo $proveedor["telefono"] ?></td>
                                    <td class="text-end">
                                        <form action="GetFormEditarProveedor.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-proveedor"
                                                value="<?php echo $proveedor["id_proveedor"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Editar
                                            </button>
                                        </form>
                                        <form action="PostHabilitarProveedor.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-proveedor"
                                                value="<?php echo $proveedor["id_proveedor"] ?>">
                                            <input type="hidden" name="valor"
                                                value="<?php echo ($proveedor["habilitado"] == '0' ? '1' : '0') ?>">
                                            <button name="boton"
                                                class="btn btn-<?php echo ($proveedor["habilitado"] == '0' ? 'success' : 'danger') ?>">
                                                <?php echo ($proveedor["habilitado"] == '0' ? 'Habilitar' : 'Inhabilitar') ?>
                                            </button>
                                        </form>
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