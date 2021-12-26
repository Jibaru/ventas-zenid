<?php

class ControllerCerrarSesion
{
    public function cerrarSesion()
    {
        session_start();
        unset($_SESSION["autenticado"]);
        include_once("FormIngresoSistema.php");
        $formulario = new FormIngresoSistema;
        $formulario->formIngresoSistemaShow(true);
    }
}

?>