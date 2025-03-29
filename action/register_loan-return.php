<?php
require_once '../includes/class_libroqr.php';
require_once '../includes/class_usuario.php';
require_once '../includes/class_prestamo.php'; // Asume que tienes una clase para gestionar los préstamos

// Verificar que los campos requeridos estén presentes en el formulario
if (!empty($_POST['idLibro'])) {
    $idlibro = intval($_POST['idLibro']); // Asegúrate de validar el ID del libro

    $prestamo = new Prestamo(); // Clase para manejar los préstamos
    $libro = new Libroqr(); // Clase para manejar los libros
 
                try {
                    $prestamo_exitoso = $prestamo->eliminarPrestamo($idlibro);

                    if ($prestamo_exitoso) {
                        $libro->actualizarEstadolibro($idlibro, 'Disponible');
                        echo "<script>
                                    alert('Devolución registrada correctamente.');
                                    window.location.href = '../book_loan.php';
                                </script>";
                    } else {
                        echo "
                        
                                <script>
                                    alert('Error al registrar la devolución.');
                                    window.location.href = '../book_loan.php';
                                </script>";

                    }
                } catch (Exception $e) {
                    echo "<script>alert('Error: " . $e->getMessage() . "');
                          window.location.href = '../book_loan.php';
                          </script>";
                }
   
} else {
    // Si algún campo está vacío, mostrar una alerta y redirigir
    echo "<script>
            alert('No se registró ningún libro.');
            window.location.href = '../book_loan.php';
          </>";
    exit();
}
?>