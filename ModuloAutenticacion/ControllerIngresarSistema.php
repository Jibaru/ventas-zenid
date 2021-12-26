<?php

class ControllerIngresarSistema
{
    public function validarUsuario($correoElectronico, $contrasenia)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $resultado = $eUsuario->validarUsuario($correoElectronico, $contrasenia);

        if ($resultado == 0) {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Datos no encontrados");
        } 
        else 
        {
            $usuario = $eUsuario->obtenerUsuario($correoElectronico);
            
            include_once("../Entidades/Rol.php");
            $idRol = $usuario["id_rol"];
            $eRol = new Rol;
            $rol = $eRol->obtenerRol($idRol);
            
            include_once("../Entidades/RolPrivilegio.php");
            $eRolPrivilegio = new RolPrivilegio;
            $rolPrivilegios = $eRolPrivilegio->obtenerPrivilegios($idRol);
            

            include_once("../Entidades/UsuarioPrivilegio.php");
            $idUsuario = $usuario["id_usuario"];
            $eUsuarioPrivilegio = new UsuarioPrivilegio;
            $usuarioPrivilegios = $eUsuarioPrivilegio->obtenerPrivilegios($idUsuario);

            $privilegios = array();
            $idsPrivilegios = array();

            foreach ($rolPrivilegios as $privilegio) 
            {
                array_push($privilegios, $privilegio);
                array_push($idsPrivilegios, $privilegio["id_privilegio"]);
            }
            
            foreach ($usuarioPrivilegios as $privilegio)
            {
                if (!in_array($privilegio["id_privilegio"], $idsPrivilegios))
                {
                    array_push($privilegios, $privilegio);
                }
            }

            $datos = array(
                "usuario" => $usuario,
                "rol" => $rol,
                "rol_privilegios" => $rolPrivilegios,
                "usuario_privilegios" => $usuarioPrivilegios,
                "privilegios" => $privilegios
            );

            $this->guardarSesion($datos);
            
            include_once("FormPrincipal.php");
            $principal = new FormPrincipal;
            $principal->formPrincipalShow();
        }

    }

    private function guardarSesion($datos)
    {
        session_start();
        $_SESSION["autenticado"] = $datos;
    }
}

?>