<?php
require('conn.php');
require('../vendor/autoload.php'); // Librería PhpSpreadsheet

use \PhpOffice\PhpSpreadsheet\IOFactory;

class Data extends conectarDB {

    public function __construct() {
        parent::__construct();
    }

    // Método para guardar los metadatos del archivo en la BD
    public function guardarArchivo($nombreArchivo, $rutaArchivo, $usuarioID) {
        try {
            $sql = "INSERT INTO archivos (nombre, ruta, id_usuario, fecha_subida) 
                    VALUES (:nombre, :ruta, :usuarioID, NOW())";
            $stmt = $this->conn_db->prepare($sql);
            $stmt->execute([
                ':nombre'    => $nombreArchivo,
                ':ruta'      => $rutaArchivo,
                ':usuarioID' => $usuarioID
            ]);
            return $this->conn_db->lastInsertId(); // Devuelve el ID del archivo subido
        } catch (Exception $e) {
            return "Error al guardar archivo: " . $e->getMessage();
        }
    }

    // Método para procesar archivos Excel y guardarlos en la BD
    public function insertarDatosDesdeExcel($filePath, $archivoID) {
        try {
            $spreadsheet = IOFactory::load($filePath);
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, true, true, true);

            $sql = "INSERT INTO datos_excel (id_archivo, columna1, columna2, columna3) 
                    VALUES (:archivoID, :col1, :col2, :col3)";
            $stmt = $this->conn_db->prepare($sql);

            foreach ($data as $row) {
                $stmt->execute([
                    ':archivoID' => $archivoID,
                    ':col1' => $row['A'],
                    ':col2' => $row['B'],
                    ':col3' => $row['C'],
                ]);
            }
            
            return "Datos insertados correctamente.";

        } catch (Exception $e) {
            return "Error al procesar el archivo: " . $e->getMessage();
        }
    }

    // Método para obtener los archivos subidos por un usuario
    public function obtenerArchivosPorUsuario($usuarioID) {
        try {
            $sql = "SELECT * FROM archivos WHERE id_usuario = :usuarioID ORDER BY fecha_subida DESC";
            $stmt = $this->conn_db->prepare($sql);
            $stmt->bindParam(':usuarioID', $usuarioID, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error al obtener archivos: " . $e->getMessage();
        }
    }
}
?>
