<?php
require('conn.php');

class Proveedores extends conectarDB {
    public function __construct() {
        parent::__construct();
    }

    

    // Listar todos los proveedores
    public function listarProveedores() {
        $sql = "SELECT * FROM proveedores";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
}
?>
