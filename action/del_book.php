<?php 
require_once '../includes/class_libroqr.php';
require_once '../includes/class_usuario.php';
require_once '../includes/class_prestamo.php';

// Verificar que los campos requeridos estén presentes y no vacíos
function validarCamposRequeridos($campos) {
    foreach ($campos as $campo) {
        if (empty($campo)) {
            return false;
        }
    }
    return true;
}


if (validarCamposRequeridos([
    $_POST['idLibro']
])) {    
    // Asignar las variables de entrada
    $idLibro = $_POST['idLibro'];
    

   

    // Instanciar la clase Libroqr
    $Libro_class = new Libroqr();
    $usuario_class = new Usuario();
    $prestamo_class = new Prestamo();

    

    try {
        // Ejecutar la operación de modificar libro
        $operar = $Libro_class->modificarLibro(
            $idLibro, $titulo, $autor, $editorial, $ano, $isbn, 
            $edicion, $idioma, $portada, // Puedes enviar null si no hay portada nueva
            $estado, $categoria, $resena, $ubicacion
        );

        if ($operar) {
            echo "<script>alert('Libro actualizado correctamente'); window.location.href = '../editar_book.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al actualizar el libro'); window.location.href = '../editar_book.php';</script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = '../editar_book.php';</script>";
        exit();
    }
} else {
    // Manejar el caso en que algún campo obligatorio esté vacío
    echo "<script>alert('Por favor, completa todos los campos.'); window.location.href = '../editar_book.php'; </script>";
    exit();
}
?>
