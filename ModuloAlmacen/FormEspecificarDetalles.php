<?php

class FormEspecificarDetalles
{
    public function formEspecificarDetallesShow($producto)
    {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especificar Detalles</title>
    <link rel="stylesheet" href="../assets/lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/lib/fontawesome-free/css/all.min.css">
</head>

<body style="background-color: #98c0e3;">
    <div class="container">
        <div class="card w-50 shadow-sm bg-body rounded" style="margin: 5rem auto">
            <div class="card-header text-center">
                <h3><?php echo $producto["nombre"] ?></h3>
            </div>
            <form action="PostAdicionarProductoPedido.php" method="POST">
                <div class="card-body">
                    <p class="text-center"><?php echo $producto["descripcion"] ?></p>
                    <p class="text-center">Precio: S/. <?php echo $producto["precio_compra_unitario"] ?></p>
                    <p class="text-center">Stock: <?php echo $producto["stock"] ?></p>
                    <div class="form-group">
                        <label>Cantidad</label>
                        <input type="number" class="form-control" name="cantidad" />
                    </div>
                </div>
                <input type="hidden" name="id-producto" value="<?php echo $producto["id_producto"]; ?>" />
                <div class="card-footer text-center">
                    <button name="boton" class="btn btn-primary">
                        Agregar a pedido
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