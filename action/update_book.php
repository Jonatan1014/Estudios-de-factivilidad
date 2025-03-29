<?php 
require_once '../includes/class_libroqr.php';

// Verificar que los campos requeridos estén presentes y no vacíos
function validarCamposRequeridos($campos) {
    foreach ($campos as $campo) {
        if (empty($campo)) {
            return false;
        }
    }
    return true;
}

// Función para redimensionar la imagen
function redimensionarImagen($archivo, $maxWidth, $maxHeight) {
    list($width, $height) = getimagesize($archivo);
    $ratio = $width / $height;

    if ($width > $maxWidth || $height > $maxHeight) {
        if ($ratio > 1) {
            $width = $maxWidth;
            $height = $maxWidth / $ratio;
        } else {
            $height = $maxHeight;
            $width = $maxHeight * $ratio;
        }
    } else {
        // Si la imagen ya está dentro de los límites, no redimensionar
        return file_get_contents($archivo);
    }

    // Crear una nueva imagen redimensionada
    $src = imagecreatefromstring(file_get_contents($archivo));
    $dst = imagecreatetruecolor($width, $height);
    imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, imagesx($src), imagesy($src));

    // Guardar la imagen redimensionada en un buffer
    ob_start();
    imagejpeg($dst);
    $imagenRedimensionada = ob_get_contents();
    ob_end_clean();

    // Liberar memoria
    imagedestroy($src);
    imagedestroy($dst);

    return $imagenRedimensionada;
}

if (validarCamposRequeridos([
    $_POST['idLibro'], $_POST['titulo'], $_POST['autor'], $_POST['editorial'], 
    $_POST['categoria'], $_POST['ano'], $_POST['idioma'], 
    $_POST['isbn'], $_POST['edicion'], $_POST['estado'], $_POST['descripcion'],$_POST['estanteria'],$_POST['fila']
])) {    
    // Asignar las variables de entrada
    $idLibro = $_POST['idLibro'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editorial = $_POST['editorial'];
    $categoria = $_POST['categoria'];
    $ano = $_POST['ano'];
    $idioma = $_POST['idioma'];
    $isbn = $_POST['isbn'];
    $edicion = $_POST['edicion'];
    $resena = $_POST['descripcion'];
    $estado = $_POST['estado']; // O el estado que desees
    $ubicacion = $_POST['estanteria'].'-'.$_POST['fila']; // O el estado que desees

    $portada = null; // Inicializar la portada como null

    // Manejar la subida de la portada como binario
    if (is_uploaded_file($_FILES['portada']['tmp_name'])) {
        // Comprobar si hubo algún error en la carga
        if ($_FILES['portada']['error'] !== UPLOAD_ERR_OK) {
            echo "Error al subir la imagen: " . $_FILES['portada']['error'];
            exit();
        }

        // Redimensionar la imagen antes de guardarla
        $portada = redimensionarImagen($_FILES['portada']['tmp_name'], 800, 800); // Cambia 800, 800 por el tamaño máximo que desees
    } else {
        $portada = null; // Si no se subió una imagen, puedes establecerla como null o como quieras manejarlo
    }

    // Instanciar la clase Libroqr
    $Libro_class = new Libroqr();

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
