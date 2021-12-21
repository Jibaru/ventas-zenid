<?php 

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarCampos($campos)
{
    $noValido = empty(trim($_POST["nombre"])) ||
                empty(trim($_POST["ape-paterno"])) ||
                empty(trim($_POST["ape-materno"])) ||
                empty(trim($_POST["dni"])) ||
                empty(trim($_POST["correo-electronico"])) ||
                empty(trim($_POST["telefono"])) ||
                strlen(trim($_POST["dni"])) != 8; 
    if ($noValido) {
        return 0;
    }

    return 1;
}

// Inicio
$boton = $_POST["boton"];
$idUsuario = $_POST["id-usuario"];
$nombre = $_POST["nombre"];
$apePaterno = $_POST["ape-paterno"];
$apeMaterno = $_POST["ape-materno"];
$correoElectronico = $_POST["correo-electronico"];
$dni = $_POST["dni"];
$telefono = $_POST["telefono"];
$idRol = $_POST["id-rol"];

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
    if (validarCampos($_POST) == 0) 
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Datos ingresados no válidos");
    }
    else 
    {
        include_once("ControllerGestionarUsuarios.php");
        $controller = new ControllerGestionarUsuarios;
        $controller->editarUsuario(
            $idUsuario,
            $nombre, 
            $apePaterno, 
            $apeMaterno, 
            $correoElectronico,
            $dni,
            $telefono,
            $idRol, 
            $idsPrivilegio);
    }
}

?>