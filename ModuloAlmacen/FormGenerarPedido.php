<?php

class FormGenerarPedido
{
    public function formGenerarPedidoShow(
        $listaMarcas,
        $listaProductos = array()
    )
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
    <title>Generar Pedido</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Generar Pedido</h1>
            <div class="card">
                <div class="card-body">
                    <form class="row" action="GetBuscarProductosPedido.php" method="get">
                        <div class="col-sm-12 col-md-3">
                            <label class="form-label">
                                Nombre
                            </label>
                            <input type="text" class="form-control" name="nombre">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label class="form-label">Marca</label>
                            <select class="form-select" name="id-marca">
                                <option selected disabled value="">Elegir marca</option>
                                <?php foreach ($listaMarcas as $marca) { ?>
                                <option value="<?php echo $marca["id_marca"]; ?>">
                                    <?php echo $marca["nombre"]; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-3 text-center pt-4">
                            <button name="boton" class="btn btn-primary w-100" type="submit">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mt-2 mb-2">Productos encontrados</h2>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Stock</th>
                                            <th>Precio Compra</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($listaProductos as $producto) { ?>
                                        <tr>
                                            <td><?php echo $producto["id_producto"]; ?></td>
                                            <td><?php echo $producto["nombre"]; ?></td>
                                            <td><?php echo $producto["descripcion"]; ?></td>
                                            <td><?php echo $producto["stock"]; ?></td>
                                            <td><?php echo $producto["precio_compra_unitario"]; ?></td>
                                            <td>
                                                <form action="GetFormEspecificarDetalles.php" method="GET">
                                                    <input type="hidden" name="id-producto"
                                                        value="<?php echo $producto["id_producto"]; ?>" />
                                                    <button name="boton" class="btn btn-primary">
                                                        Agregar a proforma
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
                </div>
                <div class="col-md-4">
                    <div class="card mt-2">
                        <div class="card-header">
                            <h4>
                                Productos a pedir
                            </h4>
                        </div>
                        <section class="card-body">
                            <?php if (isset($_SESSION["productos_pedido"]) && !empty($_SESSION["productos_pedido"])) { ?>
                            <ul class="p-0">
                                <?php foreach ($_SESSION["productos_pedido"] as $productoPedido) { ?>
                                <li class="card mb-2">
                                    <div class="card-body">
                                        <header class="d-flex justify-content-between">
                                            <h5>
                                                <?php echo $productoPedido["producto"]["nombre"]; ?>
                                            </h5>
                                            <form action="PostEliminarProductoPedido.php" method="POST"
                                                class="d-inline">
                                                <input type="hidden" name="id-producto"
                                                    value="<?php echo $productoPedido["producto"]["id_producto"]; ?>" />
                                                <button name="boton" class="btn btn-danger">
                                                    X
                                                </button>
                                            </form>
                                        </header>
                                        <p>
                                            <?php echo $productoPedido["producto"]["descripcion"]; ?>
                                        </p>
                                        <span class="badge bg-success">
                                            Precio: S/.
                                            <?php echo $productoPedido["producto"]["precio_compra_unitario"]; ?>
                                        </span>
                                        <span class="badge bg-warning">
                                            Cantidad: <?php echo $productoPedido["cantidad"]; ?>
                                        </span>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                            <hr />
                            <?php
                                $total = 0;
                                foreach ($_SESSION["productos_pedido"] as $productoPedido) {
                                    $precio = $productoPedido["producto"]["precio_compra_unitario"];
                                    $total += ($precio * $productoPedido["cantidad"]);
                                }
                            ?>
                            <div class="row">
                                <div class="col-6">
                                    <b>Precio Total</b>
                                </div>
                                <div class="col-6 text-end">
                                    S/. <?php echo $total; ?>
                                </div>
                            </div>
                            <hr />
                            <form action="GetFormVistaPreliminarPedido.php" method="GET">
                                <button name="boton" class="btn btn-success w-100">
                                    Realizar pedido
                                </button>
                            </form>
                            <?php } else { ?>
                            <div class="alert alert-warning">
                                Sin productos
                            </div>
                            <?php } ?>
                        </section>
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