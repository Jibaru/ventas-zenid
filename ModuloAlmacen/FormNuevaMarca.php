<?php

class FormNuevaMarca
{
    public function formNuevaMarcaShow()
    {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Marca</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header text-center">
                <h3>Nueva Marca</h3>
            </div>
            <form action="PostNuevaMarca.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" required />
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button name="boton" class="btn btn-primary">
                        Crear Marca
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

<?php
    }
}

?>