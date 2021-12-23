<?php

class Conexion
{
    protected $host;
    protected $nombre_bd;
    protected $usuario;
    protected $contrasenia;
    protected $conexion;

    public function __construct()
    {
        $env = getenv();
        $this->host = $env["ZENID_ADS_HOST"];
        $this->nombre_bd = $env["ZENID_ADS_BD_NAME"];
        $this->usuario = $env["ZENID_SCRUM_BD_USER"];
        $this->contrasenia = $env["ZENID_SCRUM_BD_PASSWORD"];
    }

    protected function conectarDB()
    {
        $this->conexion = mysqli_connect(
            $this->host, 
            $this->usuario, 
            $this->contrasenia, 
            $this->nombre_bd
        );

        mysqli_set_charset($this->conexion, "utf8mb4");
    }

    protected function desconectarDB()
    {
        mysqli_close($this->conexion);
    }
}

?>