<?php

class FormEditarProveedor
{
    public function formEditarProveedorShow($proveedor, $representante)
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
    <title>Editar Proveedor</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>
                Editar Proveedor
            </h1>
            <div class="card">
                <div class="card-body">
                    <form action="PostNuevoProveedor.php" method="POST" class="row">
                        <input type="hidden" name="id-proveedor" value="<?php echo $proveedor["id_proveedor"]; ?>">
                        <input type="hidden" name="id-representante"
                            value="<?php echo $representante["id_representante"]; ?>">
                        <div class="form-group col-md-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value="<?php echo $proveedor["nombre"]; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Correo Electrónico</label>
                            <input type="email" name="correo-electronico" class="form-control"
                                value="<?php echo $proveedor["correo_electronico"]; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>RUC</label>
                            <input type="text" name="ruc" class="form-control" value="<?php echo $proveedor["ruc"]; ?>"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono</label>
                            <input type="text" name="telefono" class="form-control"
                                value="<?php echo $proveedor["telefono"]; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Nombre Representante</label>
                            <input type="text" name="nombre-representante" class="form-control"
                                value="<?php echo $representante["nombre"]; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Correo Electrónico Representante</label>
                            <input type="email" name="correo-electronico-representante" class="form-control"
                                value="<?php echo $representante["correo_electronico"]; ?>" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Teléfono Representante</label>
                            <input type="text" name="telefono-representante" class="form-control"
                                value="<?php echo $representante["telefono"]; ?>" required>
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