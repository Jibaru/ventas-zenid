<?php

class ControllerEncargadoFinanzas
{
    public function nuevoProveedor(
        $nombre, 
        $correoElectronico, 
        $ruc, 
        $telefono,
        $nombreRepresentante,
        $correoElectronicoRepresentante,
        $telefonoRepresentante)
    {
        include_once("../Entidades/Proveedor.php");
        $eProveedor = new Proveedor;
        $resultado = $eProveedor->crearProveedor(
            $nombre, 
            $correoElectronico, 
            $ruc, 
            $telefono,
        );

        include_once("../Entidades/Representante.php");
        $eRepresentante = new Representante;
        $resultado = $eRepresentante->crearRepresentante(
            $nombreRepresentante,
            $correoElectronicoRepresentante,
            $telefonoRepresentante,
            $resultado
        );
        
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaRutaShow(
            "Proveedor registrado satisfactoriamente", 
            "GetFormGestionarProveedores.php");
    }

    public function buscarProveedores($ruc)
    {
        include_once("../Entidades/Proveedor.php");
        $eProveedor = new Proveedor;
        $listaProveedores = $eProveedor->obtenerProveedores($ruc);

        if (empty($listaProveedores))
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
            "Proveedores no encontrados", 
            "GetFormGestionarProveedores.php");
        }
        else
        {
            include_once("FormGestionarProveedores.php");
            $formulario = new FormGestionarProveedores;
            $formulario->formGestionarProveedoresShow($listaProveedores);
        }
    }

    public function habilitarProveedor($idProveedor, $valor)
    {
        include_once("../Entidades/Proveedor.php");
        $eRol = new Proveedor;
        $eRol->habilitar($idProveedor, $valor);

        include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Proveedor habilitado/deshabilitado", 
                "GetFormGestionarProveedores.php");
        
    }

    public function editarProveedor($idProveedor)
    {
        include_once("../Entidades/Proveedor.php");
        $eProveedor = new Proveedor;
        $proveedor = $eProveedor->obtenerProveedor($idProveedor);

        include_once("../Entidades/Representante.php");
        $eRepresentante = new Representante;
        $representante = $eRepresentante->obtenerRepresentantePorIdProveedor($idProveedor);

        include_once("FormEditarProveedor.php");
            $formulario = new FormEditarProveedor;
            $formulario->formEditarProveedorShow($proveedor, $representante);
    }

    public function modificarProveedor(
        $idProveedor,
        $idRepresentante,
        $nombre, 
        $correoElectronico, 
        $ruc, 
        $telefono,
        $nombreRepresentante,
        $correoElectronicoRepresentante,
        $telefonoRepresentante
    )
    {
        include_once("../Entidades/Proveedor.php");
        $eProveedor = new Proveedor;
        $proveedor = $eProveedor->editarProveedor(
            $idProveedor,
            $nombre, 
            $correoElectronico, 
            $ruc, 
            $telefono);

        include_once("../Entidades/Representante.php");
        $eRepresentante = new Representante;
        $representante = $eRepresentante->editarRepresentante(
            $idRepresentante,
            $nombreRepresentante,
            $correoElectronicoRepresentante,
            $telefonoRepresentante
        );

        include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Proveedor modificado correctamente", 
                "GetFormGestionarProveedores.php");
    }
}

?>