<?php 

function validarCampos($nombre, $cantidadPrivilegios)
{
    if (empty($nombre)) {
        return 0;
    }

    if ($cantidadPrivilegios <= 0) {
        return 0;
    }

    return 1;
}

// Inicio de GetFormNuevoRol
$nombre = $_POST['nombre'];

$idsPrivilegio = array();

foreach (array_keys($_POST) as $campo) {
    if (strpos($campo, "privilegio") !== false) {
        array_push($idsPrivilegio, explode("-", $campo)[1]);
    }
}


if (validarCampos($nombre, count($idsPrivilegio)) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Datos ingresados no válidos");
}
else 
{
    include_once("ControllerGestionarRoles.php");
    $controller = new ControllerGestionarRoles;
    $controller->crearRol($nombre, $idsPrivilegio);
}
?>