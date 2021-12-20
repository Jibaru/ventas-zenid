<?php
include_once("Conexion.php");

class Usuario extends Conexion 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function validarUsuario($correoElectronico, $contrasenia)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = '$correoElectronico' AND contrasenia = '$contrasenia' AND habilitado = 1";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas != 1) {
            return 0;
        }

        return 1;
    }

    public function obtenerUsuario($correoElectronico)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = '$correoElectronico'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

}

?>