<?php

class FormNuevoProveedor
{
    public function formNuevoProveedorShow()
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
    <title>Nuevo Proveedor</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>
                Nuevo Proveedor
            </h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostNuevoProveedor.php" method="POST" class="row">
                        <div class="form-group col-md-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo-electronico" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>RUC</label>
                            <input type="text" name="ruc" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nombre Representante</label>
                            <input type="text" name="nombre-representante" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Correo Electrónico Representante</label>
                            <input type="email" name="correo-electronico-representante" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono Representante</label>
                            <input type="text" name="telefono-representante" class="form-control" required>
                        </div>
                        <div class="form-group d-flex justify-content-center mt-2">
                            <button name="boton" class="btn btn-primary">
                                Guardar
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