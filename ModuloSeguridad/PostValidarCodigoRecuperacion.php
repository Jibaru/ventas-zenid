<?php

// Functiones
function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_POST['boton'];
$codigoRecuperacion = trim($_POST["codigo-recuperacion"]);

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    include_once("ControllerRecuperarContrasenia.php");
    $controller = new ControllerRecuperarContrasenia;
    $controller->validarCodigoRecuperacion($codigoRecuperacion);
}

?>