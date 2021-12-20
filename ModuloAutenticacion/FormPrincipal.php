<?php

class FormPrincipal 
{
    public function formPrincipalShow()
    {
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
            <h1>Bienvenido al sistema </h1>
            <p id="fecha-actual"></p>
        </section>
    </main>
    <?php include_once("../layout/Scripts.php"); ?>
    <script>
    var fechaActual = document.getElementById("fecha-actual");
    setInterval(() => {
        var fecha = new Date().toString("d/M/yyyy HH:mm:ss");
        fechaActual.textContent = "Fecha y hora actual: " + fecha;
    }, 1000);
    </script>
</body>

</html>
<?php
    }
}

?>