<?php 

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarDatos($campos)
{
    $noValido = empty(trim($_POST["nombre"])) ||
                empty(trim($_POST["correo-electronico"])) ||
                empty(trim($_POST["telefono"])) ||
                empty(trim($_POST["correo-electronico-representante"])) ||
                empty(trim($_POST["nombre-representante"])) ||
                empty(trim($_POST["telefono"])) ||
                strlen(trim($_POST["ruc"])) != 10; 
    if ($noValido) {
        return 0;
    }

    return 1;
}

// Inicio
$boton = $_POST["boton"];
$idProveedor = $_POST["id_proveedor"];
$idRepresentante = $_POST["id_representante"];
$nombre = $_POST["nombre"];
$correoElectronico = $_POST["correo-electronico"];
$ruc = $_POST["ruc"];
$telefono = $_POST["telefono"];
$nombreRepresentante = $_POST["nombre-representante"];
$correoElectronicoRepresentante = $_POST["correo-electronico-representante"];
$telefonoRepresentante = $_POST["telefono-representante"];

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    if (validarDatos($_POST) == 0) 
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Datos ingresados no válidos");
    }
    else 
    {
        include_once("ControllerGestionarProveedores.php");
        $controller = new ControllerGestionarProveedores;
        $controller->modificarProveedor(
            $idProveedor,
            $idRepresentante,
            $nombre, 
            $correoElectronico, 
            $ruc, 
            $telefono,
            $nombreRepresentante,
            $correoElectronicoRepresentante,
            $telefonoRepresentante);
    }
}

?>