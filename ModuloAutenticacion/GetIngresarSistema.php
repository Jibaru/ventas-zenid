<?php

// Functiones
function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCorreoElectronicoContrasenia($correoElectronico, $contrasenia)
{
    if (empty($correoElectronico))
        return 0;
    if (empty($contrasenia))
        return 0;
    if (!ctype_alnum($contrasenia))
        return 0;
    return 1;
}

// Inicio de GetIngresarSistema
$boton = $_POST['boton'];
$correoElectronico = strtolower(trim($_POST['correo-electronico']));
$contrasenia = trim($_POST['contrasenia']);

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
    return;
}

if (validarCorreoElectronicoContrasenia($correoElectronico, $contrasenia) == 0)
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Datos no válidos");
    return;
}

include_once("ControllerIngresarSistema.php");
$controller = new ControllerIngresarSistema;
$controller->validarUsuario($correoElectronico, $contrasenia);

?>