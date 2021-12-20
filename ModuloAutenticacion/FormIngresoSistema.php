<?php

class FormIngresoSistema
{
    public function formIngresoSistemaShow()
    {
        ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso Sistema</title>
    <link rel="stylesheet" href="./assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/compartido.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <picture class="text-center">
                <img src="./assets/img/logo.png" class="card-img-top" alt="Logo" style="max-width: 20rem;">
            </picture>
            <div class="card-body">
                <form action="./ModuloAutenticacion/GetIngresarSistema.php" method="POST">
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="text" name="correo-electronico" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="contrasenia" class="form-control" required>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <button name="boton" class="btn btn-primary">Ingresar</button>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <a href="recuperar-contrasenia">Recuperar contraseña</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php
    }
}

?>