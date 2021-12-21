<?php

class FormEditarUsuario
{
    public function formEditarUsuarioShow(
        $usuario,
        $listaUsuarioPrivilegios,
        $listaRoles,
        $listaPrivilegios
    )
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
    <title>Editar Usuario</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>
                Editar Usuario
            </h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostEditarUsuario.php" method="POST" class="row">
                        <input type="hidden" name="id-usuario" value="<?php echo $usuario["id_usuario"]; ?>">
                        <div class="form-group col-md-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value="<?php echo $usuario["nombre"] ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Apellido Paterno</label>
                            <input type="text" name="ape-paterno" class="form-control"
                                value="<?php echo $usuario["ape_paterno"] ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Apellido Materno</label>
                            <input type="text" name="ape-materno" class="form-control"
                                value="<?php echo $usuario["ape_materno"] ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo-electronico" class="form-control"
                                value="<?php echo $usuario["correo_electronico"] ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>DNI</label>
                            <input type="text" name="dni" class="form-control" value="<?php echo $usuario["dni"] ?>"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                value="<?php echo $usuario["telefono"] ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Rol</label>
                            <select name="id-rol" class="form-control">
                                <?php foreach ($listaRoles as $rol) { ?>
                                <option value="<?php echo $rol["id_rol"] ?>" <?php
                                    if ($rol["id_rol"] == $usuario["id_rol"]) {
                                        echo "selected";
                                    }
                                ?>>
                                    <?php echo $rol["nombre"] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <hr class="mt-3 mb-3">
                        <h2>Privilegios</h2>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Path</th>
                                        <th>Icono</th>
                                        <th>Seleccionar</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <?php foreach($listaPrivilegios as $privilegio) { ?>
                                    <tr>
                                        <td><?php echo $privilegio["nombre"] ?></td>
                                        <td><?php echo $privilegio["path"] ?></td>
                                        <td><?php echo $privilegio["icono"] ?></td>
                                        <td>
                                            <input type="checkbox"
                                                name="privilegio-<?php echo $privilegio["id_privilegio"] ?>" <?php 
                                                    foreach ($listaUsuarioPrivilegios as $usuarioPrivilegio) {
                                                        if ($usuarioPrivilegio["id_privilegio"] == $privilegio["id_privilegio"]) {
                                                            echo "checked";
                                                        }
                                                    }
                                                ?>>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group d-flex justify-content-center">
                            <button name="boton" class="btn btn-warning">
                                Modificar
                            </button>
                        </div>
                    </form>
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