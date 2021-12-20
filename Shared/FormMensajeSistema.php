<?php

class FormMensajeSistema
{
    public function formMensajeSistemaShow($mensaje)
    {
        ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensaje Sistema</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header text-center">
                <h2>Mensaje del Sistema</h2>
            </div>
            <div class="card-body">
                <p class="text-center"><?php echo $mensaje ?></p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
    }
}

?>