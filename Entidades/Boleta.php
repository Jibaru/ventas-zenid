<?php
include_once("Conexion.php");

class Boleta extends Conexion
{
    public function crearBoleta(
        $dni,
        $fechaEmision,
        $idVenta
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO boletas(
                dni,
                fecha_emision,
                id_venta
            ) VALUES (
                '$dni',
                '$fechaEmision',
                '$idVenta'
            )";
        $this->conexion->query($sql);
        $idBoleta = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idBoleta;
    }
}

?>