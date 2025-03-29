<?php
require_once '../includes/class_libroqr.php';
require_once '../includes/class_usuario.php';
require_once '../includes/class_prestamo.php'; // Asume que tienes una clase para gestionar los préstamos

// Verificar que los campos requeridos estén presentes en el formulario
if (
    !empty($_POST['cedula']) &&
    !empty($_POST['fecha_entrega']) &&
    !empty($_POST['idLibro'])
) {
    // Asignar las variables de entrada
    $cedula = $_POST['cedula'];
    $fecha_prestamo = date('Y-m-d'); // Fecha actual
    $fecha_entrega = $_POST['fecha_entrega'];
    $idlibro = intval($_POST['idLibro']); // Asegúrate de validar el ID del libro
    
    $libro = new Libroqr();
    $usuario = new Usuario();
    $prestamo = new Prestamo(); // Clase para manejar los préstamos

    try {
        // Verificar si el libro está disponible
        $estadoLibro = $prestamo->verificarDisponibilidad($idlibro);
        if (!$estadoLibro) {
            echo "<script>
                    alert('El libro seleccionado no está disponible.');
                    window.location.href = '../details-book.php';
                  </script>";
            exit();
        }

        // Verificar si el usuario existe en la base de datos
        $usuario_existente = $usuario->datosUser_code($cedula);
        if (!$usuario_existente) {
            // Si el usuario no existe, redirigir con un mensaje de error
            echo "<script>
                    alert('El usuario no está registrado.');
                    window.location.href = '../details-book.php';
                  </script>";
            exit();
        }

        // Registrar el préstamo del libro
        $prestamo_exitoso = $prestamo->registrarPrestamo($idlibro, $usuario_existente["idUser"], $fecha_prestamo, $fecha_entrega);

        // Actualizar el estado del libro a "Prestado"
        if ($prestamo_exitoso) {
            $libro->actualizarEstadolibro($idlibro, 'Prestado');
            echo "<script>
                    alert('Préstamo registrado correctamente.');
                    window.location.href = '../index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error al registrar el préstamo.');
                    window.location.href = '../details-book.php';
                  </script>";
            exit();
        }
    } catch (Exception $e) {

        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = '../details-book.php';
              </script>";
        exit();
    }
} else {
    // Si algún campo está vacío, mostrar una alerta y redirigir
    
    
    echo "<script>
            alert('Por favor, completa todos los campos.');
            window.location.href = '../details-book.php';
          </script>";
    exit();
}
?>
