<?php
require('conn.php');

class SCP extends conectarDB {
    public function __construct() {
        parent::__construct();
    }


    public function listar_SCP() {
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

    public function listar_SCP_2() {
        $sql = "SELECT 
            cm.descripcion,
            cm.cantidad,
            cm.valorunitario,
            cm.unidad,
            cm.nit_proveedor,
            p.nombre AS nombre_proveedor,
            p.telefono AS telefono_proveedor
        FROM compra_materiales cm
        LEFT JOIN proveedores_scp p ON cm.nit_proveedor = p.nit_proveedor";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
    

}
?>
