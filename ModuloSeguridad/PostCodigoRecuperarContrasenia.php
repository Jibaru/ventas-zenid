<?php

// Functiones
function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCampo($correoElectronico)
{
    if (!empty($correoElectronico))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_POST['boton'];
$correoElectronico = $_POST["correo-electronico"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    if (validarCampo($correoElectronico) == 0)
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Campos no válidos");
    }
    else
    {
        include_once("ControllerRecuperarContrasenia.php");
        $controller = new ControllerRecuperarContrasenia;
        $controller->enviarCorreoElectronico($correoElectronico);
    }
}

?>