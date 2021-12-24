<?php

class ControllerGestionarProductos
{
    public function nuevoProducto()
    {
        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;

        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormNuevoProducto.php");
        $formulario = new FormNuevoProducto;
        $formulario->formNuevoProductoShow($listaMarcas);
    }

    public function nuevaMarca($nombre)
    {
        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        
        $resultado = $eMarca->validarMarca($nombre);

        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Marca previamente registrada"); 
        }
        else
        {
            $eMarca->crearMarca($nombre);

            $listaMarcas = $eMarca->obtenerMarcas();

            include_once("FormNuevoProducto.php");
            $formulario = new FormNuevoProducto;
            $formulario->formNuevoProductoShow($listaMarcas);
        }
    }

    public function crearProducto(
        $nombre,
        $codigoBarras,
        $igv,
        $precioCompraUnitario,
        $precioVenta,
        $stock,
        $stockMinimo,
        $descripcion,
        $idMarca
    )
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $idProducto = $eProducto->crearProducto($nombre,
            $codigoBarras,
            $igv,
            $precioCompraUnitario,
            $precioVenta,
            $stock,
            $stockMinimo,
            $descripcion,
            $idMarca);
        
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Producto registrado correctamente");
    }

    public function buscarProductos($nombre)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $listaProductos = $eProducto->obtenerProductosPorNombre($nombre);

        if (empty($listaProductos)) 
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Productos no encontrados"); 
        }
        else
        {
            include_once("FormGestionarProductos.php");
            $formulario = new FormGestionarProductos;
            $formulario->formGestionarProductosShow($listaProductos);
        }
    }

    public function buscarProducto($idProducto)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $producto = $eProducto->obtenerProducto($idProducto);

        include_once("../Entidades/Marca.php");
        $eMarca = new Marca;
        $listaMarcas = $eMarca->obtenerMarcas();

        include_once("FormEditarProducto.php");
        $formulario = new FormEditarProducto;
        $formulario->formEditarProductoShow($producto, $listaMarcas);
    }

    public function modificarProducto(
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
    )
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $eProducto->modificarProducto(
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

        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaRutaShow(
            "Productos modificado correctamente", 
            "GetFormGestionarProductos.php"); 
    }

    public function habilitarProducto($idProducto, $valor)
    {
        include_once("../Entidades/Producto.php");
        $eProducto = new Producto;
        $eProducto->habilitar($idProducto, $valor);

        include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Producto habilitado/deshabilitado", 
                "GetFormGestionarProductos.php");
        
    }
}

?>