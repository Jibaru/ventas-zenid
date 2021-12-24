<?php 

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCampos($campos)
{
    $noValido = empty(trim($campos["nombre"])) ||
                empty(trim($campos["codigo-barras"])) ||
                empty(trim($campos["igv"])) ||
                empty(trim($campos["precio-compra-unitario"])) ||
                empty(trim($campos["precio-venta"])) ||
                empty(trim($campos["stock"])) ||
                empty(trim($campos["stock-minimo"])) ||
                empty(trim($campos["descripcion"]));

    if ($noValido) {
        return 0;
    }

    return 1;
}

// Inicio
$boton = $_POST["boton"];
$idProducto = $_POST["id-producto"];
$nombre = $_POST["nombre"];
$codigoBarras = $_POST["codigo-barras"];
$igv = $_POST["igv"];
$precioCompraUnitario = $_POST["precio-compra-unitario"];
$precioVenta = $_POST["precio-venta"];
$stock = $_POST["stock"];
$stockMinimo = $_POST["stock-minimo"];
$descripcion = $_POST["descripcion"];
$idMarca = $_POST["id-marca"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    if (validarCampos($_POST) == 0) 
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Datos ingresados no válidos");
    }
    else 
    {
        include_once("ControllerGestionarProductos.php");
        $controller = new ControllerGestionarProductos;
        $controller->modificarProducto(
            $idProducto,
            $nombre,
            $codigoBarras,
            $igv,
            $precioCompraUnitario,
            $precioVenta,
            $stock,
            $stockMinimo,
            $descripcion,
            $idMarca
        );
    }
}

?>