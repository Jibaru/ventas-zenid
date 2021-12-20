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
}

?>