<?php
require('conn.php');

class Prestamo extends conectarDB {

    public function __construct() {
        parent::__construct();
    }

    // Método para registrar un nuevo préstamo
    public function registrarPrestamo($idLibro, $idUser, $fecha_prestamo, $fecha_vencimiento) {
        $sql = "INSERT INTO prestamos (idLibro, idUser, fecha_prestamo, fecha_vencimiento, estado) 
                VALUES (:idLibro, :idUser, :fecha_prestamo, :fecha_vencimiento, 'Prestado')";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->bindParam(':fecha_prestamo', $fecha_prestamo);
        $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }
    

    // Método para eliminar un préstamo
    public function eliminarPrestamo($idLibro) {
        $sql = "DELETE FROM prestamos WHERE idLibro = :idLibro";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }


    // Método para obtener el historial de préstamos de un usuario
    public function historialPrestamosUsuario($idUser) {
        $sql = "SELECT l.titulo, l.autor, p.fecha_prestamo, p.fecha_vencimiento, p.fecha_devolucion, p.estado
                FROM prestamos p
                JOIN libros l ON p.idLibro = l.idLibro
                WHERE p.idUser = :idUser";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
    // Método para obtener el historial de préstamos de un usuario
    public function librosPrestados_email($email) {
        $sql = "SELECT l.titulo, l.autor, l.qr_code, l.editorial, l.año_publicacion, l.isbn, l.edicion, p.fecha_prestamo, p.fecha_vencimiento, p.estado
                FROM prestamos p
                JOIN libros l ON p.idLibro = l.idLibro
                JOIN usuarios u ON p.idUser = u.idUser
                WHERE u.email = :email"; // Elimina las comillas de :email
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
    
        // Si no hay resultados, devolver false
        if (empty($resultados)) {
            return false;
        }
    
        // Si hay resultados, devolverlos
        return $resultados;
    }
    

    // Método para verificar si un libro está prestado
    public function verificarDisponibilidad($idLibro) {
        $sql = "SELECT * FROM prestamos WHERE idLibro = :idLibro AND estado = 'Prestado'";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado ? false : true; // Devuelve falso si está prestado, verdadero si está disponible
    }

    // Método para listar todos los préstamos
    public function listarPrestamos() {
        $sql = "SELECT p.idPrestamo, u.name, l.idLibro, u.carrera, l.isbn, l.titulo, p.fecha_prestamo, p.fecha_vencimiento, p.fecha_devolucion, p.estado
                FROM prestamos p
                JOIN usuarios u ON p.idUser = u.idUser
                JOIN libros l ON p.idLibro = l.idLibro";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->execute();
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultados;
    }
}
?>