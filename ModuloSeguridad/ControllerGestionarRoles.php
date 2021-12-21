<?php

class ControllerGestionarRoles
{
    public function obtenerRoles()
    {
        include_once("../Entidades/Rol.php");
        $eRol = new Rol;
        $listaRoles = $eRol->obtenerRoles();
        include_once("FormGestionarRoles.php");
        $formulario = new FormGestionarRoles;
        $formulario->formGestionarRolesShow($listaRoles);
    }

    public function nuevoRol()
    {
        include_once("../Entidades/Privilegio.php");
        $ePrivilegio = new Privilegio;
        $listaPrivilegios = $ePrivilegio->obtenerPrivilegios();
        include_once("FormNuevoRol.php");
        $formulario = new FormNuevoRol;
        $formulario->formNuevoRolShow($listaPrivilegios);
    }

    public function crearRol($nombre, $idsPrivilegio)
    {
        include_once("../Entidades/Rol.php");
        include_once("../Entidades/RolPrivilegio.php");
        $eRol = new Rol;
        $idRol = $eRol->crearRol($nombre);

        $eRolPrivilegio = new RolPrivilegio;
        foreach ($idsPrivilegio as $idPrivilegio) {
            $eRolPrivilegio->crearRolPrivilegio($idRol, $idPrivilegio);
        }
        
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaRutaShow(
            "Rol creado satisfactoriamente", 
            "GetFormGestionarRoles.php");
    }

    public function buscarRol($idRol)
    {
        include_once("../Entidades/Rol.php");
        $eRol = new Rol;
        $rol = $eRol->obtenerRol($idRol);

        include_once("../Entidades/RolPrivilegio.php");
        $eRolPrivilegio = new RolPrivilegio;
        $listaRolPrivilegios = $eRolPrivilegio->obtenerPrivilegios($idRol);

        include_once("../Entidades/Privilegio.php");
        $ePrivilegio = new Privilegio;
        $listaPrivilegios = $ePrivilegio->obtenerPrivilegios();

        include_once("FormEditarRol.php");
        $formulario = new FormEditarRol;
        $formulario->formEditarRolShow(
            $rol,
            $listaRolPrivilegios,
            $listaPrivilegios
        );
    }

    public function editarRol(
        $idRol,
        $nombre,
        $idsPrivilegio)
    {
        include_once("../Entidades/Rol.php");
        $eRol = new Rol;
        $resultado = $eRol->verificarDatosModificar($nombre, $idRol);
        
        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Rol previamente registrado"); 
        } 
        else 
        {
            $eRol->modificarRol(
                $idRol,
                $nombre);
            
            include_once("../Entidades/RolPrivilegio.php");
            $eRolPrivilegio = new RolPrivilegio;
            $eRolPrivilegio->eliminarRolPrivilegio($idRol);
            
            foreach ($idsPrivilegio as $idPrivilegio) {
                $eRolPrivilegio->crearRolPrivilegio($idRol, $idPrivilegio);
            }
            
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Rol modificado satisfactoriamente", 
                "GetFormGestionarRoles.php");
            
        }
    }

    public function habilitarRol($idRol, $valor)
    {
        include_once("../Entidades/Rol.php");
        $eRol = new Rol;
        $eRol->habilitar($idRol, $valor);

        include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Rol habilitado/deshabilitado", 
                "GetFormGestionarRoles.php");
        
    }
}

?>