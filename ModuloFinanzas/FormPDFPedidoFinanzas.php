<?php

class FormPDFPedidoFinanzas
{
    public function formPDFPedidoFinanzasShow($pedido, $listaProductosPedido)
    {
        $path = "../assets/img/logo.png";
        $tipo = pathinfo($path, PATHINFO_EXTENSION);
        $datos = file_get_contents($path);
        $base64 = 'data:image/' . $tipo . ';base64,' . base64_encode($datos);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Pedido Finanzas</title>
</head>

<body>
    <style>
    header,
    h1 {
        margin: 0;
        padding: 0;
    }

    header {
        text-align: right;
    }

    th,
    td {
        border: 1px solid black;
        padding: 0;
        padding: 5px;
    }

    .text-end {
        text-align: right;
    }
    </style>
    <header>
        <?php echo $pedido["fecha_emision"]; ?>
    </header>
    <div class="text-end">
        <img src="<?php echo $base64?>" height="80" />
    </div>
    <h1>Pedido Nº <?php echo $pedido["id_pedido_almacen"]; ?></h1>
    <hr>
    <div>
        <p>
            <strong>Observaciones:</strong>
        </p>
        <p>
            <?php echo $pedido["observaciones"]; ?>
        </p>
        <p>
            <strong>Fecha Emisión:</strong>
        </p>
        <p>
            <?php echo $pedido["fecha_emision"]; ?>
        </p>
        <p>
            <strong>Fecha Aprobación:</strong>
        </p>
        <p>
            <?php echo $pedido["fecha_aprobacion"]; ?>
        </p>
        <p>
            <strong>Realizado por:</strong>
        </p>
        <p>
            <?php echo $pedido["nombre_usuario_pedido"]; ?>
            <?php echo $pedido["ape_paterno_usuario_pedido"]; ?>
            <?php echo $pedido["ape_materno_usuario_pedido"]; ?>
        </p>
        <p>
            <strong>Aprobado por:</strong>
        </p>
        <p>
            <?php echo $pedido["nombre_usuario_aprobacion"]; ?>
            <?php echo $pedido["ape_paterno_usuario_aprobacion"]; ?>
            <?php echo $pedido["ape_materno_usuario_aprobacion"]; ?>
        </p>
        <p>
            <strong>Nombre Proveedor:</strong>
        </p>
        <p>
            <?php echo $pedido["nombre_proveedor"]; ?>
        </p>
        <p>
            <strong>Correo Electrónico Proveedor:</strong>
        </p>
        <p>
            <?php echo $pedido["correo_electronico_proveedor"]; ?>
        </p>
        <p>
            <strong>Teléfono Proveedor:</strong>
        </p>
        <p>
            <?php echo $pedido["telefono_proveedor"]; ?>
        </p>
    </div>
    <hr>
    <h3>Productos pedidos</h3>
    <table cellspacing="0">
        <thead>
            <tr>
                <th>Cod. Barras</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio Unitario (S/.)</th>
                <th>Cantidad</th>
                <th>Subtotal (S/.)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $total = 0;
                foreach ($listaProductosPedido as $productoPedido) {
                    $precio = $productoPedido["precio_compra_unitario"];
                    $total += ($precio * $productoPedido["cantidad"]);
                }
            ?>
            <?php foreach ($listaProductosPedido as $productoPedido) { ?>
            <?php
                $cantidad= $productoPedido["cantidad"];
                $precio = $productoPedido["precio_compra_unitario"];
                $subtotalProducto = $cantidad * $precio;
            ?>
            <tr>
                <td><?php echo $productoPedido["codigo_barras"]; ?></td>
                <td><?php echo $productoPedido["nombre"]; ?></td>
                <td><?php echo $productoPedido["descripcion"]; ?></td>
                <td class="text-end">
                    <?php echo $productoPedido["precio_compra_unitario"]; ?>
                </td>
                <td class="text-end"><?php echo $cantidad; ?></td>
                <td class="text-end">
                    <?php echo $subtotalProducto; ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="6" class="text-end">
                    <?php echo $total; ?>
                </td>
            </tr>
            <tr>
                <td colspan="5" class="text-end">
                    <b>Precio Total</b>
                </td>
                <td class="text-end">
                    <b>
                        <?php echo $total; ?>
                    </b>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
<?php
    }
}

?>