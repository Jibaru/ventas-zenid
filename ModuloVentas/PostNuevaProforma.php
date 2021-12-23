<?php

function validarBoton($boton)
{
    if (isset($boton))
		return(1);
	else
		return(0);
}

function validarNombreReferencial($nombreReferencial)
{
    if(empty($nombreReferencial)) {
        return 0;
    }

    return 1;
}

// Inicio
$boton = $_POST["boton"];
$nombreReferencial = trim($_POST["nombre-referencial"]);

if (validarBoton($boton) == 0) 
{
    include_once("../Shared/FormMensajeSistema.php");
    $formulario = new FormMensajeSistema;
    $formulario->formMensajeSistemaShow("Acceso no permitido");
}
else 
{
    if (validarNombreReferencial($nombreReferencial) == 0) 
    {
        include_once("../Shared/FormMensajeSistema.php");
        $formulario = new FormMensajeSistema;
        $formulario->formMensajeSistemaShow("Debe ingresar nombre referencial");
    }
    else 
    {
        include_once("ControllerEmitirProforma.php");
        $controller = new ControllerEmitirProforma;
        $controller->nuevaProforma($nombreReferencial);
    }
}

?>