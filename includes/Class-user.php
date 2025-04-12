<?php
require('conn.php');

class Usuario extends conectarDB {
    public function __construct() {
        parent::__construct();
    }

    // Verificar si el correo ya existe
    public function verificarEmail($email) {
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

    // Validar credenciales
    public function validarCredenciales($email, $password) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        if ($usuario && password_verify($password, $usuario['password'])) {
            return $usuario;
        }
        return false;
    }

    // Listar todos los usuarios
    public function listarUsuarios() {
        $sql = "SELECT id, nombre, email, rol, creado_en FROM usuarios";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }

    // Obtener usuario por ID
    public function obtenerUsuario($id) {
        $sql = "SELECT id, nombre, email, rol FROM usuarios WHERE id = :id";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

    // Método para obtener detalles de un usuario por email 
    public function datosUser_email($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Cambiado a PARAM_STR
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

    // Agregar un nuevo usuario
    public function agregarUsuario($nombre, $email, $password, $rol) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':rol', $rol);
        $stmt->execute();
        $lastInsertId = $this->conn_db->lastInsertId();
        $stmt->closeCursor();
        return $lastInsertId;
    }

     // Buscar un usuario por email
    public function buscarPorEmail($email) {
        $sql = "SELECT id FROM usuarios WHERE email = :email LIMIT 1";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modificar usuario con validación de contraseña opcional
    public function modificarUsuario($id, $nombre, $email, $password, $rol) {
        // Obtener el email actual del usuario
        $sql = "SELECT email FROM usuarios WHERE id = :id";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $usuarioActual = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioActual['email'] === $email) {
            // Si el email no cambia, actualizar sin tocarlo
            $sql = "UPDATE usuarios SET nombre = :nombre, rol = :rol" . 
                   ($password ? ", password = :password" : "") . " WHERE id = :id";
        } else {
            // Si el email cambia, actualizar todo
            $sql = "UPDATE usuarios SET nombre = :nombre, email = :email, rol = :rol" . 
                   ($password ? ", password = :password" : "") . " WHERE id = :id";
        }

        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':rol', $rol, PDO::PARAM_STR);
        if ($usuarioActual['email'] !== $email) {
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        }
        if ($password) {
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Eliminar un usuario
    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }
}
?>
