<?php

class FormGestionarProductos
{
    public function formGestionarProductosShow($listaProductos = array())
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
    <title>Productos</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Productos</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <form action="GetBuscarProductos.php" method="GET" class="row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control">
                        </div>
                        <div class="form-group col-md-2 mt-4">
                            <button name="boton" class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Codigo Barras</th>
                                    <th>Precio Compra</th>
                                    <th>Precio Venta</th>
                                    <th>Stock</th>
                                    <th class="text-end">
                                        <form action="GetFormNuevoProducto.php" method="POST">
                                            <button name="boton" class="btn btn-primary">
                                                Nuevo
                                            </button>
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaProductos as $producto) { ?>
                                <tr>
                                    <td><?php echo $producto["id_producto"] ?></td>
                                    <td><?php echo $producto["nombre"] ?></td>
                                    <td><?php echo $producto["codigo_barras"] ?></td>
                                    <td><?php echo $producto["precio_compra_unitario"] ?></td>
                                    <td><?php echo $producto["precio_venta"] ?></td>
                                    <td><?php echo $producto["stock"] ?></td>
                                    <td class="text-end">
                                        <form action="GetFormEditarProducto.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-producto"
                                                value="<?php echo $producto["id_producto"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Editar
                                            </button>
                                        </form>
                                        <form action="PostHabilitarProducto.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id-producto"
                                                value="<?php echo $producto["id_producto"] ?>">
                                            <input type="hidden" name="valor"
                                                value="<?php echo ($producto["habilitado"] == '0' ? '1' : '0') ?>">
                                            <button name="boton"
                                                class="btn btn-<?php echo ($producto["habilitado"] == '0' ? 'success' : 'danger') ?>">
                                                <?php echo ($producto["habilitado"] == '0' ? 'Habilitar' : 'Inhabilitar') ?>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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