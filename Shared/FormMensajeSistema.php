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
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <section id="main">
            <h1>Mensaje del sistema</h1>
            <p><?php echo $mensaje ?></p>
        </section>
    </main>
</body>

</html>

<?php
    }
}

?>