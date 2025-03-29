<?php
require('conn.php');

class Usuario extends conectarDB {

    public function __construct() {
        parent::__construct();
    }

    // Método para verificar si el código de estudiante o correo ya existen
    public function verificarDuplicados($code_student, $email) {
        $sql = "SELECT * FROM usuarios WHERE code_cc = :code_cc OR email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':code_cc', $code_student, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

    public function validarCredenciales($email, $password) {
        // Buscar al usuario por email
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        // Si el usuario existe
        if ($usuario) {
            // Verificar la contraseña usando password_verify
            if (password_verify($password, $usuario['password'])) {
                // Las credenciales son correctas, devolver información del usuario
                return $usuario;
            } else {
                // La contraseña no es correcta
                return false;
            }
        } else {
            // El usuario no existe
            return false;
        }
    }
    

    // Método para listar todos los usuarios
    public function listarUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
    // Método para listar carreras de estudio
    public function listarCarrera() {
        $sql = "SELECT carrera FROM usuarios";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }

    // Método para obtener detalles de un usuario por ID
    public function detallarUsuario($idUser) {
        $sql = "SELECT * FROM usuarios WHERE idUser = :idUser";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }
    

    // Método para obtener detalles de un usuario por email 
    public function datosUser_rol($email) {
        $sql = "SELECT rol, estado FROM usuarios WHERE email = :email";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR); // Cambiado a PARAM_STR
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
    // Método para obtener detalles de un usuario por email 
    public function datosUser_code($code_cc) {
        $sql = "SELECT * FROM usuarios WHERE code_cc = :code_cc";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':code_cc', $code_cc, PDO::PARAM_STR); // Cambiado a PARAM_STR
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

    // Método para agregar un nuevo usuario
    public function agregarUsuario($code_student, $name, $email, $password, $rol, $carrera, $estado) {
        $sql = "INSERT INTO usuarios (code_cc, name, email, password, rol, carrera, estado)
                VALUES (:code_cc, :name, :email, :password, :rol, :carrera, :estado)";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':code_cc', $code_student);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));  // Encriptar la contraseña
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':carrera', $carrera);
        $stmt->bindParam(':estado', $estado);
        $stmt->execute();
        $lastInsertId = $this->conn_db->lastInsertId();
        $stmt->closeCursor();
        return $lastInsertId;
    }

    public function modificarUsuario($idUser, $name, $email, $password, $rol, $carrera, $estado) {
        // Inicia la consulta de actualización
        $sql = "UPDATE usuarios SET name = ?, email = ?, rol = ?, carrera = ?, estado = ?";
        
        // Agrega la actualización de la contraseña solo si se proporciona
        $params = [$name, $email, $rol, $carrera, $estado];
        if ($password !== null) {
            $sql .= ", password = ?";
            $params[] = password_hash($password, PASSWORD_DEFAULT); // Asegúrate de encriptar la contraseña
        }
        
        $sql .= " WHERE idUser = ?";
        $params[] = $idUser;
        
        // Ejecuta la consulta
        $stmt = $this->conn_db->prepare($sql);
        return $stmt->execute($params);
    }
    

    // Método para eliminar un usuario por ID
    public function eliminarUsuario($idUser) {
        $sql = "DELETE FROM usuarios WHERE idUser = :idUser";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }

    // Método para ver los libros prestados de un usuario
    public function librosPrestadosUsuario($idUser) {
        $sql = "SELECT l.titulo, l.autor, l.editorial, p.fecha_prestamo, p.fecha_vencimiento, p.fecha_devolucion, p.estado
                FROM prestamos p
                JOIN libros l ON p.idLibro = l.idLibro
                WHERE p.idUser = :idUser AND p.estado != 'Devuelto'";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
}
?>
