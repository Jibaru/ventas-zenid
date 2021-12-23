<?php

class ControllerEmitirProforma
{
    public function obtenerRealizarProforma()
    {
        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormRealizarProforma.php");
        $formulario = new FormRealizarProforma;
        $formulario->formRealizarProformaShow($listaMarcas);
        
    }

    public function buscarProductos($nombre, $idMarca)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;

        $listaProductos = $eProducto->obtenerProductos($nombre, $idMarca);
        $listaProductosSimilares = $eProducto->obtenerProductosSimilares($nombre);

        if ($this->existenciaProductos($listaProductos, $listaProductosSimilares) == 0) 
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "ProductosNoEncontrados", 
                "GetFormRealizarProforma.php");
        }
        else 
        {
            include_once("../Entidades/Marca.php");
            $eMarca = new Marca;
            $listaMarcas = $eMarca->obtenerMarcas();

            include_once("FormRealizarProforma.php");
            $formulario = new FormRealizarProforma;
            $formulario->formRealizarProformaShow(
                $listaMarcas, 
                $listaProductos, 
                $listaProductosSimilares);
        }
    }

    public function seleccionarProducto($idProducto)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $producto = $eProducto->obtenerProducto($idProducto);

        include_once("FormCantidadProductosProforma.php");
        $formulario = new FormCantidadProductosProforma;
        $formulario->formCantidadProductosProformaShow($producto);
    }

    public function agregarProductoProforma(
        $idProducto,
        $cantidad)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $resultado = $eProducto->validarStock($idProducto, $cantidad);

        if ($resultado == 0) 
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow(
                "La cantidad excede al stock disponible");
        }
        else 
        {
            $producto = $eProducto->obtenerProducto($idProducto);
            $this->agregarListaTemporal($producto, $cantidad);

            include_once("../Entidades/Marca.php");
            $eMarca = new Marca;
            $listaMarcas = $eMarca->obtenerMarcas();

            include_once("FormRealizarProforma.php");
            $formulario = new FormRealizarProforma;
            $formulario->formRealizarProformaShow($listaMarcas);
        }
    }

    public function eliminarProductoProforma($idProducto)
    {
        $this->eliminarListaTemporal($idProducto);

        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormRealizarProforma.php");
        $formulario = new FormRealizarProforma;
        $formulario->formRealizarProformaShow($listaMarcas);
    }

    public function nuevaProforma($nombreReferencial)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include_once("../Entidades/Proforma.php");
        $eProforma = new Proforma;
        $idProforma = $eProforma->crearProforma(
            $nombreReferencial,
            date("Y:m:d H:i:s"),
            $_SESSION["autenticado"]["usuario"]["id_usuario"]
        );

        include_once("../Entidades/ProductoProformado.php");
        $eProductoProformado = new ProductoProformado;

        foreach ($_SESSION["productos_proforma"] as $productoProforma)
        {
            $eProductoProformado->crearProductoProformado(
                $idProforma,
                $productoProforma["producto"]["id_producto"],
                $productoProforma["cantidad"]
            );
        }

        $proforma = $eProforma->obtenerProforma($idProforma);
        $listaProductosProformados = $eProductoProformado->obtenerProductosProformados($idProforma);

        include_once("FormVerProforma.php");
        $formulario = new FormVerProforma;
        $formulario->formVerProformaShow($proforma, $listaProductosProformados);
    }

    private function existenciaProductos($listaProductos, $listaProductosSimilares)
    {
        if (count($listaProductos) == 0 && count($listaProductosSimilares) == 0) 
        {
            return 0;
        }

        return 1;
    }

    private function agregarListaTemporal($producto, $cantidad)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["productos_proforma"])) {
            $_SESSION["productos_proforma"] = array();   
        }

        $encontrado = -1;
        for ($i = 0; $i < count($_SESSION["productos_proforma"]); $i++) {
            $productoProforma = $_SESSION["productos_proforma"][$i];
            if ($productoProforma["producto"]["id_producto"] == 
            $producto["id_producto"])
            {
                $encontrado = $i;
                break;
            }
        }

        if ($encontrado != -1) 
        {
            $_SESSION["productos_proforma"][$encontrado]["cantidad"] = $cantidad;
        }
        else {
            array_push($_SESSION["productos_proforma"], array(
                "producto" => $producto,
                "cantidad" => $cantidad
            ));
        }
    }

    private function eliminarListaTemporal($idProducto)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["productos_proforma"])) {
            $encontrado = -1;
            for ($i = 0; $i < count($_SESSION["productos_proforma"]); $i++) {
                $productoProforma = $_SESSION["productos_proforma"][$i];
                if ($productoProforma["producto"]["id_producto"] == $idProducto)
                {
                    $encontrado = $i;
                    break;
                }
            }

            if ($encontrado != -1) 
            {
                array_splice($_SESSION["productos_proforma"], $encontrado, 1);
            }
        }
    }
}

?>