<?php
require('conn.php');

class Data extends conectarDB {
    public function __construct() {
        parent::__construct();
    }

    // Verificar si el correo ya existe
    public function listarEF_ID($id_estudio) {
        $sql = "SELECT * FROM estudios_factibilidad WHERE id_estudio = :id_estudio";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id_estudio', $id_estudio, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;

        
    }

    // Validar credenciales
    public function listarEF_5ID($id_estudio) {
        $sql = "SELECT * FROM estudios_factibilidad WHERE id_estudio = :id_estudio";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $id_estudio, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

}
?>
