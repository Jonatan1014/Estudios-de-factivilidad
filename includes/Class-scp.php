<?php
require 'conn.php';

class SCP extends conectarDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listar_SCP()
    {
        $sql = "SELECT
            cm.descripcion,
            cm.cantidad,
            cm.valorunitario,
            cm.unidad,
            cm.proveedor,
            p.nombre AS nombre_proveedor,
            p.telefono AS telefono_proveedor
        FROM compra_materiales cm
        LEFT JOIN proveedores_scp p ON cm.proveedor = p.nit_proveedor";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }

    public function listar_SCP_2()
    {
        $sql = "SELECT 
    cp.descripcion AS producto_descripcion,
    cp.cantidad,
    cp.valorunitario,
    c.fecha AS fecha_compra,
    p.nit AS proveedor_nit,
    p.nombre AS proveedor_nombre,
    p.datosproveedor
    FROM 
        scp_compra_producto cp
    INNER JOIN 
        scp_compra c ON cp.compranumero = c.numero
    INNER JOIN 
        scp_proveedor p ON cp.proveedor = p.nit
    WHERE 
        YEAR(c.fecha) >= 2020;";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
    public function listar_SCP_3()
    {
        $sql = "SELECT
                producto AS producto_descripcion,
                cantidad,
                valorunitario,
                fecha_compra,
                proveedor AS proveedor_nombre,
                datosproveedor
            FROM
                productos_proveedores";

        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
