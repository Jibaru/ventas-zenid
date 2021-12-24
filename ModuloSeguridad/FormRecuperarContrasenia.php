<?php

class FormRecuperarContrasenia
{
    public function formRecuperarContraseniaShow()
    {
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/compartido.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header">
                <h3>Recuperar contraseña</h3>
            </div>
            <div class="card-body">
                <form action="PostCodigoRecuperarContrasenia.php" method="POST">
                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="text" name="correo-electronico" class="form-control" required>
                    </div>
                    <div class="text-center mt-2 mb-2">
                        <button name="boton" class="btn btn-primary">
                            Enviar código de verificación
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