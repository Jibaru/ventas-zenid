<?php

class ControllerGestionarUsuarios
{
    public function nuevoUsuario()
    {
        include_once("../Entidades/Rol.php");
        $eRol = new Rol;
        $listaRoles = $eRol->obtenerRoles();

        include_once("../Entidades/Privilegio.php");
        $ePrivilegio = new Privilegio;
        $listaPrivilegios = $ePrivilegio->obtenerPrivilegios();

        include_once("FormNuevoUsuario.php");
        $formulario = new FormNuevoUsuario;
        $formulario->formNuevoUsuarioShow($listaRoles, $listaPrivilegios);
    }

    public function crearUsuario(
        $nombre, 
        $apePaterno, 
        $apeMaterno, 
        $correoElectronico,
        $dni,
        $telefono,
        $contrasenia,
        $idRol, 
        $idsPrivilegio)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $resultado = $eUsuario->verificarDatos($dni, $correoElectronico);
        
        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Usuario previamente registrado"); 
        } 
        else 
        {
            $idUsuario = $eUsuario->crearUsuario($nombre, 
                $apePaterno, 
                $apeMaterno, 
                $correoElectronico,
                $dni,
                $telefono,
                $contrasenia,
                $idRol);
            
            include_once("../Entidades/UsuarioPrivilegio.php");
            $eUsuarioPrivilegio = new UsuarioPrivilegio;
            foreach ($idsPrivilegio as $idPrivilegio) {
                $eUsuarioPrivilegio->crearUsuarioPrivilegio($idUsuario, $idPrivilegio);
            }
            
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Usuario creado satisfactoriamente", 
                "GetGestionarUsuarios.php");
            
        }
    }

    public function buscarUsuarios($nombre, $dni)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $listaUsuarios = $eUsuario->obtenerUsuarios($nombre, $dni);
        
        if (count($listaUsuarios) == 0) 
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "No se encontraron coincidencias", 
                "GetGestionarUsuarios.php");
        } 
        else 
        {
            include_once("FormGestionarUsuarios.php");
            $formulario = new FormGestionarUsuarios;
            $formulario->formGestionarUsuariosShow($listaUsuarios);
        }
    }

    public function buscarUsuario($idUsuario)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $usuario = $eUsuario->obtenerUsuarioPorId($idUsuario);

        if (!$usuario)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Usuario no existe", 
                "GetGestionarUsuarios.php");
        } 
        else
        {
            include_once("../Entidades/UsuarioPrivilegio.php");
            $eUsuarioPrivilegio = new UsuarioPrivilegio;
            $listaUsuarioPrivilegios = $eUsuarioPrivilegio->obtenerPrivilegios($idUsuario);

            include_once("../Entidades/Rol.php");
            $eRol = new Rol;
            $listaRoles = $eRol->obtenerRoles();

            include_once("../Entidades/Privilegio.php");
            $ePrivilegio = new Privilegio;
            $listaPrivilegios = $ePrivilegio->obtenerPrivilegios();

            include_once("FormEditarUsuario.php");
            $formulario = new FormEditarUsuario;
            $formulario->formEditarUsuarioShow(
                $usuario,
                $listaUsuarioPrivilegios,
                $listaRoles, 
                $listaPrivilegios);
        }

    }

    public function editarUsuario(
        $idUsuario,
        $nombre, 
        $apePaterno, 
        $apeMaterno, 
        $correoElectronico,
        $dni,
        $telefono,
        $idRol, 
        $idsPrivilegio)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $resultado = $eUsuario->verificarDatosModificar($dni, $correoElectronico, $idUsuario);
        
        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Usuario previamente registrado"); 
        } 
        else 
        {
            $eUsuario->modificarUsuario(
                $idUsuario,
                $nombre, 
                $apePaterno, 
                $apeMaterno, 
                $correoElectronico,
                $dni,
                $telefono,
                $idRol);
            
            include_once("../Entidades/UsuarioPrivilegio.php");
            $eUsuarioPrivilegio = new UsuarioPrivilegio;
            $eUsuarioPrivilegio->eliminarUsuarioPrivilegio($idUsuario);
            
            foreach ($idsPrivilegio as $idPrivilegio) {
                $eUsuarioPrivilegio->crearUsuarioPrivilegio($idUsuario, $idPrivilegio);
            }
            
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Usuario modificado satisfactoriamente", 
                "GetGestionarUsuarios.php");
            
        }
    }

    public function habilitarUsuario($idUsuario, $valor)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $eUsuario->habilitar($idUsuario, $valor);

        include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaRutaShow(
                "Usuario habilitado/deshabilitado", 
                "GetGestionarUsuarios.php");
        
    }
}

?>