<?php

class FormGestionarUsuarios
{
    public function formGestionarUsuariosShow($listaUsuarios)
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
    <title>Usuarios</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Usuarios</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarUsuarios.php" method="GET" class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>DNI</label>
                            <input type="text" name="dni" class="form-control">
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
                                    <th>DNI</th>
                                    <th>Teléfono</th>
                                    <th class="text-end">
                                        <form action="GetFormNuevoUsuario.php" method="POST">
                                            <button name="boton" class="btn btn-primary">
                                                Nuevo
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaUsuarios as $usuario) { ?>
                                <tr>
                                    <td><?php echo $usuario["id_usuario"] ?></td>
                                    <td><?php echo $usuario["nombre"] ?></td>
                                    <td><?php echo $usuario["correo_electronico"] ?></td>
                                    <td><?php echo $usuario["dni"] ?></td>
                                    <td><?php echo $usuario["telefono"] ?></td>
                                    <td class="text-end">
                                        <form action="GetFormEditarUsuario.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-usuario"
                                                value="<?php echo $usuario["id_usuario"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Editar
                                            </button>
                                        </form>
                                        <form action="PostHabilitarUsuario.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-usuario"
                                                value="<?php echo $usuario["id_usuario"] ?>">
                                            <input type="hidden" name="valor"
                                                value="<?php echo ($usuario["habilitado"] == '0' ? '1' : '0') ?>">
                                            <button name="boton"
                                                class="btn btn-<?php echo ($usuario["habilitado"] == '0' ? 'success' : 'danger') ?>">
                                                <?php echo ($usuario["habilitado"] == '0' ? 'Habilitar' : 'Inhabilitar') ?>
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