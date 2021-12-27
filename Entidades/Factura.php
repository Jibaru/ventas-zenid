<?php
include_once("Conexion.php");

class Factura extends Conexion
{
    public function crearFactura(
        $ruc,
        $fechaEmision,
        $idVenta
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO facturas(
                ruc,
                fecha_emision,
                id_venta
            ) VALUES (
                '$ruc',
                '$fechaEmision',
                '$idVenta'
            )";
        $this->conexion->query($sql);
        $idFactura = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idFactura;
    }
}

?>