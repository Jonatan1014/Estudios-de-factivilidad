<?php    
require ('conn.php');

class Libroqr extends conectarDB {        

    public function __construct() {                
        parent::__construct();
    }

	 // Método para verificar si el código de estudiante o correo ya existen
	 public function verificarDuplicados($isbn) {
        $sql = "SELECT * FROM libros WHERE isbn = :isbn";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_INT);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }

	public function obtenerImagenPorId($idLibro) {
		// Implementa aquí la lógica para conectarte a la base de datos y recuperar la imagen
		// Por ejemplo:
		$sql = "SELECT qr_code FROM libros WHERE idLibro = ?";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([$idLibro]);
		return $stmt->fetchColumn(); // Asumiendo que "portada" es el campo de la imagen
	}
	

    // Método para listar todos los registros de la tabla 'libros'
    public function listarLibros() {
        $sql = "SELECT *, 
                   (SELECT COUNT(*) FROM libros WHERE estado = 'Disponible') AS disponibles 
            FROM libros";              
        $stmt = $this->conn_db->prepare($sql);                        
        $stmt->execute();            
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
        $stmt->closeCursor();
        return $resultados;
    }    
    // Método para listar todos los registros de la tabla 'libros'
    public function listarLibros_todos() {
        $sql = "SELECT * FROM libros";              
        $stmt = $this->conn_db->prepare($sql);                        
        $stmt->execute();            
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
        $stmt->closeCursor();
        return $resultados;
    }    

    // Método para obtener detalles de un libro por ID
    public function detallarLibro($idLibro) {
        $sql = "SELECT * FROM libros WHERE idLibro = :idLibro";
        $stmt = $this->conn_db->prepare($sql);            
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);        
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }
    
    // Método para buscar libros por título o autor
    public function buscarLibroPorTituloOAutor($terminoBusqueda) {
        $sql = "SELECT * 
                FROM libros 
                WHERE LOWER(titulo) LIKE :terminoBusqueda 
                OR LOWER(autor) LIKE :terminoBusqueda";
        
        $stmt = $this->conn_db->prepare($sql);
        
        // Agregar comodines para permitir búsqueda parcial
        $terminoBusqueda = '%' . strtolower($terminoBusqueda) . '%';
        
        // Enlazar el parámetro
        $stmt->bindParam(':terminoBusqueda', $terminoBusqueda, PDO::PARAM_STR);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Obtener todos los resultados
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Cerrar el cursor
        $stmt->closeCursor();
        
        return $resultado;
    }

    

     // Método para obtener detalles de un libro por SBN
     public function detallarLibro_ISBN($isbn) {
        $sql = "SELECT * FROM libros WHERE isbn = :isbn";
        $stmt = $this->conn_db->prepare($sql);            
        $stmt->bindParam(':isbn', $isbn, PDO::PARAM_STR);        
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultado;
    }
   

    // Método para agregar un nuevo libro
    public function agregarLibro($titulo, $autor, $editorial, $ano, $isbn, $edicion, $idioma, $portada, $qr_code, $estado, $categoria, $resena, $ubicacion) {
        $sql = "INSERT INTO libros (titulo, autor, editorial, año_publicacion, isbn, edicion, idioma, portada, qr_code, estado, categoria, resena, ubicacion)
                VALUES (:titulo, :autor, :editorial, :anio_publicacion, :isbn, :edicion, :idioma, :portada, :qr_code, :estado, :categoria, :resena, :ubicacion)";
        
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':editorial', $editorial);
        $stmt->bindParam(':anio_publicacion', $ano, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':edicion', $edicion, PDO::PARAM_INT);
        $stmt->bindParam(':idioma', $idioma);
        $stmt->bindParam(':portada', $portada, PDO::PARAM_LOB);
        $stmt->bindParam(':qr_code', $qr_code, PDO::PARAM_LOB);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':resena', $resena);
        $stmt->bindParam(':ubicacion', $ubicacion);
    
        $stmt->execute();
        $lastInsertId = $this->conn_db->lastInsertId();
        $stmt->closeCursor();
        
        return $lastInsertId;
    }
    

    public function modificarLibro($idLibro, $titulo, $autor, $editorial, $anio_publicacion, $isbn, $edicion, $idioma, $portada = null, $estado, $categoria,$resena,$ubicacion) {
        $sql = "UPDATE libros 
                SET titulo = :titulo, autor = :autor, editorial = :editorial, año_publicacion = :anio_publicacion, 
                    isbn = :isbn, edicion = :edicion, idioma = :idioma, estado = :estado, categoria = :categoria, resena = :resena, ubicacion = :ubicacion" . 
                    ($portada !== null ? ", portada = :portada" : "") . 
                " WHERE idLibro = :idLibro";
    
        $stmt = $this->conn_db->prepare($sql);    
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':editorial', $editorial);
        $stmt->bindParam(':anio_publicacion', $anio_publicacion, PDO::PARAM_INT);
        $stmt->bindParam(':isbn', $isbn);
        $stmt->bindParam(':edicion', $edicion, PDO::PARAM_INT);
        $stmt->bindParam(':idioma', $idioma);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':resena', $resena);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
    
        if ($portada !== null) {
            $stmt->bindParam(':portada', $portada, PDO::PARAM_LOB); // Enlaza el campo de la portada
        }
    
        return $stmt->execute();
    }
    
    // Método para actualizar detalles de un libro por ID
    public function actualizarEstadolibro($idLibro, $estado) {
        $sql = "UPDATE libros 
                SET  estado = :estado 
                WHERE idLibro = :idLibro";
        $stmt = $this->conn_db->prepare($sql);    
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }
    // Método para actualizar detalles de un libro por ID
    public function obtenerEstado($idLibro) {
        $sql = "SELECT estado 
                FROM  libros 
                WHERE idLibro = :idLibro";
        $stmt = $this->conn_db->prepare($sql);    
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }

    // Método para eliminar un libro por ID
    public function eliminarLibro($idLibro) {
        $sql = "DELETE FROM libros WHERE idLibro = :idLibro";
        $stmt = $this->conn_db->prepare($sql);
        $stmt->bindParam(':idLibro', $idLibro, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    }
}
?>