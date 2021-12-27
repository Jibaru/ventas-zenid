<?php
include_once("Conexion.php");

class Venta extends Conexion
{
    public function crearVenta(
        $idProforma,
        $nombres,
        $apePaterno,
        $apeMaterno,
        $fechaEmision,
        $idUsuarioVenta
    )
    {
        $this->conectarDB();
        $sql = "INSERT INTO ventas(
                nombres,
                ape_paterno,
                ape_materno,
                fecha_emision,
                id_usuario_venta,
                id_proforma
            ) VALUES (
                '$nombres',
                '$apePaterno',
                '$apeMaterno',
                '$fechaEmision',
                '$idUsuarioVenta',
                '$idProforma'
            )";
        $this->conexion->query($sql);
        $idVenta = mysqli_insert_id($this->conexion);
        $this->desconectarDB();
        return $idVenta;
    }
    
    public function obtenerVentas($idVenta, $boleta, $factura)
    {
        $this->conectarDB();
        $sql = "SELECT 
                    v.id_venta,
                    v.nombres,
                    v.ape_paterno,
                    v.ape_materno,
                    v.fecha_emision,
                    v.fecha_despacho,
                    v.id_proforma,
                    b.dni,
                    b.id_boleta,
                    f.ruc,
                    f.id_factura,
                    u.id_usuario,
                    u.nombre as nombre_usuario_venta,
                    u.ape_paterno as ape_paterno_usuario_venta,
                    u.ape_materno as ape_materno_usuario_venta
                FROM 
                boletas as b RIGHT JOIN ventas as v
                ON b.id_venta = v.id_venta LEFT JOIN facturas as f
                ON v.id_venta = f.id_venta JOIN usuarios as u
                ON v.id_usuario_venta = u.id_usuario";

        if (!is_null($idVenta))
        {
            $sql .= " WHERE v.id_venta = '$idVenta'";
        }

        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        
        $ventas = array();
        for ($i = 0; $i < $numFilas; $i++) {
            $ventas[$i] = $resultado->fetch_array();
        }

        $ventasFiltro = array();
        foreach ($ventas as $venta)
        {
            if ($boleta && !is_null($venta["id_boleta"]))
            {
                array_push($ventasFiltro, $venta);
            }

            if ($factura && !is_null($venta["id_factura"]))
            {
                array_push($ventasFiltro, $venta);
            }
        }
            
        return ($ventasFiltro);
    }

    public function obtenerVenta($idVenta)
    {
        $this->conectarDB();
        $sql = "SELECT 
                    v.id_venta,
                    v.nombres,
                    v.ape_paterno,
                    v.ape_materno,
                    v.fecha_emision,
                    v.fecha_despacho,
                    v.id_proforma,
                    b.dni,
                    b.id_boleta,
                    f.ruc,
                    f.id_factura,
                    u.id_usuario,
                    u.nombre as nombre_usuario_venta,
                    u.ape_paterno as ape_paterno_usuario_venta,
                    u.ape_materno as ape_materno_usuario_venta
                FROM 
                boletas as b RIGHT JOIN ventas as v
                ON b.id_venta = v.id_venta LEFT JOIN facturas as f
                ON v.id_venta = f.id_venta JOIN usuarios as u
                ON v.id_usuario_venta = u.id_usuario
                WHERE v.id_venta = '$idVenta'";

        $resultado = $this->conexion->query($sql);
        $numFilas = mysqli_num_rows($resultado);
        $this->desconectarDB();
        $venta = $resultado->fetch_array();
            
        return ($venta);
    }

    public function despacharVenta($idVenta, $fechaDespacho, $idUsuarioDespacho)
    {
        $this->conectarDB();
        $sql = "UPDATE ventas
                SET id_usuario_despacho = '$idUsuarioDespacho',
                fecha_despacho = '$fechaDespacho'
                WHERE id_venta = '$idVenta'";
        $this->conexion->query($sql);
        $this->desconectarDB();
    }
}

?>