<?php

class FormNuevoProducto
{
    public function formNuevoProductoShow($listaMarcas)
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
    <title>Nuevo Producto</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>
                Nuevo Producto
            </h1>
            <div class="card">
                <div class="card-body">
                    <form action="GetFormNuevaMarca.php" method="GET">
                        <button type="submit" class="btn btn-success w-100 mt-2">Nueva Marca</button>
                    </form>
                    <form action="PostNuevoProducto.php" method="POST" class="row">
                        <div class="form-group col-md-3">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Código Barras</label>
                            <input type="text" name="codigo-barras" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>IGV</label>
                            <input type="number" name="igv" class="form-control" step="any" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Precio Compra Unitario</label>
                            <input type="number" name="precio-compra-unitario" step="any" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Precio Venta</label>
                            <input type="number" name="precio-venta" step="any" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Stock</label>
                            <input type="number" name="stock" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Stock Mínimo</label>
                            <input type="number" name="stock-minimo" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Marca</label>
                            <select name="id-marca" class="form-control">
                                <?php foreach ($listaMarcas as $marca) { ?>
                                <option value="<?php echo $marca["id_marca"] ?>">
                                    <?php echo $marca["nombre"] ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Descripción</label>
                            <textarea name="descripcion" rows="3" class="form-control" required></textarea>
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

?>