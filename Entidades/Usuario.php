<?php
include_once("Conexion.php");

class Usuario extends Conexion 
{

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

    public function verificarCorreoElectronico($correoElectronico)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = '$correoElectronico' AND habilitado = 1";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 1;
        }

        return 0;
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

    public function obtenerUsuarioPorId($idUsuario)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$idUsuario'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $fila = $resultado->fetch_array();
            
        return ($fila);
    }

    public function verificarDatos($dni, $correoElectronico)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE correo_electronico = '$correoElectronico' OR dni = '$dni'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 0;
        }

        return 1;
    }

    public function verificarDatosModificar($dni, $correoElectronico, $idUsuario)
    {
        $this->conectarDB();
        $sql = "SELECT * FROM usuarios WHERE 
                (correo_electronico = '$correoElectronico' OR 
                dni = '$dni') AND id_usuario != '$idUsuario'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        if ($numFilas >= 1) {
            return 0;
        }

        return 1;
    }

    public function crearUsuario($nombre, 
        $apePaterno, 
        $apeMaterno, 
        $correoElectronico,
        $dni,
        $telefono,
        $contrasenia,
        $idRol)
    {
        $this->conectarDB();
        $sql = "INSERT INTO usuarios(
            nombre,
            ape_paterno,
            ape_materno,
            dni,
            correo_electronico,
            telefono,
            contrasenia,
            id_rol
        ) VALUES (
            '$nombre',
            '$apePaterno',
            '$apeMaterno',
            '$dni',
            '$correoElectronico',
            '$telefono',
            '$contrasenia',
            '$idRol'
        )";
        $this->conexion->query($sql);
        $idUsuario = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idUsuario;
    }

    public function obtenerUsuarios($nombre, $dni)
    {

        $sql = "SELECT * FROM usuarios 
                WHERE nombre LIKE '$nombre%' AND
                dni LIKE '$dni%'";

        $this->conectarDB();
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $usuarios = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $usuarios[$i] = $resultado->fetch_array();
        }
            
        return ($usuarios);
    }

    public function modificarUsuario(
        $idUsuario,
        $nombre, 
        $apePaterno, 
        $apeMaterno, 
        $correoElectronico,
        $dni,
        $telefono,
        $idRol)
    {
        $this->conectarDB();
        $sql = "UPDATE usuarios
                SET nombre = '$nombre',
                ape_paterno = '$apePaterno',
                ape_materno = '$apeMaterno',
                dni = '$dni',
                correo_electronico = '$correoElectronico',
                telefono = '$telefono',
                id_rol = '$idRol'
                WHERE id_usuario = '$idUsuario'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function habilitar($idUsuario, $valor)
    {
        $this->conectarDB();
        $sql = "UPDATE usuarios
                SET habilitado = '$valor' 
                WHERE id_usuario = '$idUsuario'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

    public function actualizarContrasenia($correoElectronico, $contrasenia)
    {
        $this->conectarDB();
        $sql = "UPDATE usuarios
                SET contrasenia = '$contrasenia'
                WHERE correo_electronico = '$correoElectronico'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

}

?>