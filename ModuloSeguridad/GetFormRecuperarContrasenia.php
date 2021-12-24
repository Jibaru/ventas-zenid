<?php

// Functiones
function validarEnlace($enlace)
{
    if (isset($enlace))
		return(1);
	else
		return(0);
}

// Inicio
$enlace = $_GET['enlace'];

if (validarEnlace($enlace) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("FormRecuperarContrasenia.php");
    $formulario = new FormRecuperarContrasenia;
    $formulario->formRecuperarContraseniaShow();
}

?>