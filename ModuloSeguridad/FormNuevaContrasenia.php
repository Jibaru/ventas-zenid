<?php

class FormNuevaContrasenia
{
    public function formNuevaContraseniaShow()
    {
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Contraseña</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/compartido.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header">
                <h3>Nueva contraseña</h3>
            </div>
            <div class="card-body">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label>Nueva contraseña</label>
                        <input type="text" name="contrasenia" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Repertir contraseña</label>
                        <input type="text" name="repetir-contrasenia" class="form-control" required>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <button name="boton" class="btn btn-primary">
                            Nueva contraseña
                        </button>
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