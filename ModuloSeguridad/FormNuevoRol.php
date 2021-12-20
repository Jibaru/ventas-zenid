<?php

class FormNuevoRol 
{
    public function formNuevoRolShow($listaPrivilegios)
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
            <h1>
                Nuevo Rol
            </h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostNuevoRol.php" method="POST">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <hr>
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
                                                name="privilegio-<?php echo $privilegio["id_privilegio"] ?>">
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary">
                            Guardar
                        </button>
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