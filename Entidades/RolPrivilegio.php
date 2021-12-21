<?php
include_once("Conexion.php");

class RolPrivilegio extends Conexion 
{
    public function obtenerPrivilegios($idRol)
    {
        $this->conectarDB();
        $sql = "SELECT 
                p.id_privilegio,
                p.nombre,
                p.path,
                p.icono
                FROM roles as r 
                INNER JOIN roles_privilegios as rp
                ON r.id_rol = rp.id_rol
                INNER JOIN privilegios as p
                ON p.id_privilegio = rp.id_privilegio
                WHERE r.id_rol = '$idRol'";
        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        

        for ($i = 0; $i < $numFilas; $i++) {
            $fila[$i] = $resultado->fetch_array();
        }
            
        return ($fila);
    }

    public function crearRolPrivilegio($idRol, $idPrivilegio)
    {
        $this->conectarDB();
        $sql = "INSERT INTO roles_privilegios(id_rol, id_privilegio) 
                VALUES ('$idRol', '$idPrivilegio')";
        $this->conexion->query($sql);
        $idRolPrivilegio = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idRolPrivilegio;
    }

    public function eliminarRolPrivilegio($idRol)
    {
        $this->conectarDB();
        $sql = "DELETE FROM roles_privilegios WHERE 
                id_rol = '$idRol'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }

}

?>