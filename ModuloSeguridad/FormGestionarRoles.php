<?php

class FormGestionarRoles
{
    public function formGestionarRolesShow($listaRoles)
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
    <title>Principal</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Roles</h1>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th class="text-end">
                                        <form action="GetFormNuevoRol.php" method="POST">
                                            <button name="boton" class="btn btn-primary">
                                                Nuevo
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaRoles as $rol) { ?>
                                <tr>
                                    <td><?php echo $rol["id_rol"] ?></td>
                                    <td><?php echo $rol["nombre"] ?></td>
                                    <td class="text-end">
                                        <form action="GetFormEditarRol.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-rol" value="<?php echo $rol["id_rol"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Editar
                                            </button>
                                        </form>
                                        <form action="PostHabilitarRol.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-rol" value="<?php echo $rol["id_rol"] ?>">
                                            <input type="hidden" name="valor"
                                                value="<?php echo ($rol["habilitado"] == '0' ? '1' : '0') ?>">
                                            <button name="boton"
                                                class="btn btn-<?php echo ($rol["habilitado"] == '0' ? 'success' : 'danger') ?>">
                                                <?php echo ($rol["habilitado"] == '0' ? 'Habilitar' : 'Inhabilitar') ?>
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