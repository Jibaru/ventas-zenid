<?php
include_once("Conexion.php");

class UsuarioPrivilegio extends Conexion 
{
    public function obtenerPrivilegios($idUsuario)
    {
        $this->conectarDB();
        $sql = "SELECT 
                p.id_privilegio,
                p.nombre,
                p.path,
                p.icono
                FROM usuarios as u 
                INNER JOIN usuarios_privilegios as up
                ON u.id_usuario = up.id_usuario
                INNER JOIN privilegios as p
                ON p.id_privilegio = up.id_privilegio
                WHERE u.id_usuario = '$idUsuario'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $usuariosPrivilegios = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $usuariosPrivilegios[$i] = $resultado->fetch_array();
        }
            
        return ($usuariosPrivilegios);
    }

    public function crearUsuarioPrivilegio($idUsuario, $idPrivilegio)
    {
        $this->conectarDB();
        $sql = "INSERT INTO usuarios_privilegios(id_usuario, id_privilegio) 
                VALUES ('$idUsuario', '$idPrivilegio')";
        $this->conexion->query($sql);
        $idUsuarioPrivilegio = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idUsuarioPrivilegio;
    }

    public function eliminarUsuarioPrivilegio($idUsuario)
    {
        $this->conectarDB();
        $sql = "DELETE FROM usuarios_privilegios WHERE 
                id_usuario = '$idUsuario'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

}

?>