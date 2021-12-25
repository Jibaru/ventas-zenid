<?php 

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCampos($contrasenia, $contraseniaRepetida)
{
    if (!empty($contrasenia) && 
        !empty($contraseniaRepetida) && 
        $contrasenia == $contraseniaRepetida) {
        return 1;
    }

    return 0;
}

// Inicio
$boton = $_POST["boton"];
$contrasenia = trim($_POST["contrasenia"]);
$contraseniaRepetida = trim($_POST["contrasenia-repetida"]);

$idsPrivilegio = array();

foreach (array_keys($_POST) as $campo) {
    if (strpos($campo, "privilegio") !== false) {
        array_push($idsPrivilegio, explode("-", $campo)[1]);
    }
}

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    if (validarCampos($contrasenia, $contraseniaRepetida) == 0) 
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Datos ingresados no válidos");
    }
    else 
    {
        include_once("ControllerRecuperarContrasenia.php");
        $controller = new ControllerRecuperarContrasenia;
        $controller->crearNuevaContrasenia($contrasenia);
    }
}

?>