<?php

class Conexion
{
    protected $host = "localhost";
    protected $nombre_bd = "zenid_bd";
    protected $usuario = "root";
    protected $contrasenia = "root";
    protected $conexion;

    public function Conexion()
    {
        $env = getenv();
        $host = $env["ZENID_ADS_HOST"];
        $nombre_bd = $env["ZENID_ADS_BD_NAME"];
        $usuario = $env["ZENID_SCRUM_BD_USER"];
        $contrasenia = $env["ZENID_SCRUM_BD_PASSWORD"];
    }

    protected function conectarDB()
    {
        $this->conexion = mysqli_connect(
            $this->host, 
            $this->usuario, 
            $this->contrasenia, 
            $this->nombre_bd
        );
    }

    protected function desconectarDB()
    {
        mysqli_close($this->conexion);
    }
}

?>