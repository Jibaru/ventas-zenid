<?php

class ControllerRecuperarContrasenia
{
    public function enviarCorreoElectronico($correoElectronico)
    {
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $resultado = $eUsuario->verificarCorreoElectronico($correoElectronico);

        if ($resultado == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Usuario no encontrado");
        }
        else
        {
            $this->enviarCorreoCodigo($correoElectronico);

            include_once("FormCodigoRecuperarContrasenia.php");
            $formulario = new FormCodigoRecuperarContrasenia;
            $formulario->formCodigoRecuperarContraseniaShow();
        }
    }

    public function validarCodigoRecuperacion($codigoRecuperacion)
    {
        if ($this->validarCodigoRecuperacionEnviado($codigoRecuperacion) == 0)
        {
            include_once("../Shared/FormMensajeSistema.php");
            $formulario = new FormMensajeSistema;
            $formulario->formMensajeSistemaShow("Codigo de recuperación inválido");
        }
        else
        {
            include_once("FormNuevaContrasenia.php");
            $formulario = new FormNuevaContrasenia;
            $formulario->formNuevaContraseniaShow();
        }
    }

    public function crearNuevaContrasenia($contrasenia)
    {
        $correoElectronico = $this->obtenerCorreoElectronicoGuardado();
        include_once("../Entidades/Usuario.php");
        $eUsuario = new Usuario;
        $eUsuario->actualizarContrasenia($correoElectronico, $contrasenia);

        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaRutaShow(
            "Datos actualizados",
            "../index.php"
        );
    }

    private function validarCodigoRecuperacionEnviado($codigoRecuperacion)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SESSION["codigo_recuperacion"] == $codigoRecuperacion)
        {
            return 1;
        }
        return 0;
    }

    private function enviarCorreoCodigo($correoElectronico)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $letrasPermitidas = '0123456789';
        $codigoRecuperacion = substr(str_shuffle($letrasPermitidas), 0, 4);

        $asunto = "Código de Recuperación ZENID";
        $mensaje = "Use el siguiente código de recuperación: ".$codigoRecuperacion;

        require_once("../Shared/CorreoElectronicoSender.php");
        $correoElectronicoSender = new CorreoElectronicoSender;
        $correoElectronicoSender->enviar($correoElectronico, $asunto, $mensaje);

        $_SESSION["codigo_recuperacion"] = $codigoRecuperacion;
        $_SESSION["correo_electronico_recuperacion"] = $correoElectronico;
    }

    private function obtenerCorreoElectronicoGuardado()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION["correo_electronico_recuperacion"];
    }
}

?>