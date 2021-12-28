<?php

class FormListaPedidosAlmacen
{
    public function formListaPedidosAlmacenShow($listaPedidos)
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
    <title>Lista Pedidos Almacén</title>
    <?php include_once("../layout/Estilos.php"); ?>
</head>

<body>
    <main>
        <?php include_once("../layout/BarraNavegacion.php"); ?>
        <?php include_once("../layout/BarraLateral.php"); ?>
        <section id="main">
            <h1>Pedidos Almacén</h1>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Observaciones</th>
                                    <th>Emitido por</th>
                                    <th>Fecha Emisión</th>
                                    <th>Fecha Aprobación</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($listaPedidos as $pedidoAlmacen) { ?>
                                <tr>
                                    <td><?php echo $pedidoAlmacen["id_pedido_almacen"] ?></td>
                                    <td>
                                        <?php  
                                            if (!is_null($pedidoAlmacen["observaciones"]) && 
                                                !empty($pedidoAlmacen["observaciones"]))
                                                echo $pedidoAlmacen["observaciones"];
                                            else { ?>
                                        <span class="badge bg-success text-white">
                                            Sin observaciones
                                        </span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $pedidoAlmacen["nombre_usuario_pedido"] ?>
                                        <?php echo $pedidoAlmacen["ape_paterno_usuario_pedido"] ?>
                                        <?php echo $pedidoAlmacen["ape_materno_usuario_pedido"] ?>
                                    </td>
                                    <td><?php echo $pedidoAlmacen["fecha_emision"] ?></td>
                                    <td>
                                        <?php  
                                            if (!is_null($pedidoAlmacen["fecha_aprobacion"])) {
                                                echo $pedidoAlmacen["fecha_aprobacion"];
                                            } else { ?>
                                        <span class="badge bg-danger text-white">
                                            Sin aprobar
                                        </span>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (!is_null($pedidoAlmacen["fecha_aprobacion"])) { ?>
                                        <form action="GetFormPedidoFinanzas.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-pedido"
                                                value="<?php echo $pedidoAlmacen["id_pedido_almacen"] ?>">
                                            <button name="boton" class="btn btn-success">
                                                Ver Pedido Aprobado
                                            </button>
                                        </form>
                                        <?php } else { ?>
                                        <form action="GetFormAprobarPedido.php" method="GET" class="d-inline">
                                            <input type="hidden" name="id-pedido-almacen"
                                                value="<?php echo $pedidoAlmacen["id_pedido_almacen"] ?>">
                                            <button name="boton" class="btn btn-warning">
                                                Aprobar
                                            </button>
                                        </form>
                                        <?php } ?>
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