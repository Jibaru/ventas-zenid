<?php 

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

// Inicio
$boton = $_POST["boton"];
$idRol = $_POST["id-rol"];
$nombre = trim($_POST["nombre"]);

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
    include_once("ControllerGestionarRoles.php");
    $controller = new ControllerGestionarRoles;
    $controller->editarRol(
        $idRol,
        $nombre,
        $idsPrivilegio);
}

?>