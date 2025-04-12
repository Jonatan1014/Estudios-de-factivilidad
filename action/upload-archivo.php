<?php
session_start();
require_once '../includes/Class-data.php'; // Clase con la lógica de BD

if (!isset($_FILES['files']['name']) || !is_array($_FILES['files']['name']) || empty($_FILES['files']['name'][0])) {
    die("Error: No has seleccionado ningún archivo.");
}
$data = new Data(); // Instancia de la clase Data

// Verificar si se han subido archivos
if (!empty($_FILES['files']['name'][0])) {
    $usuarioID = $_SESSION['idUser']; // Obtener el ID del usuario de la sesión
    $rutaDestino = '../uploads/'; // Carpeta donde se guardarán los archivos

    if (!is_dir($rutaDestino)) {
        mkdir($rutaDestino, 0777, true); // Crear la carpeta si no existe
    }

    $archivosProcesados = 0;
    $errores = [];

    foreach ($_FILES['files']['tmp_name'] as $key => $tmpName) {
        $nombreArchivo = $_FILES['files']['name'][$key];
        $rutaArchivo = $rutaDestino . basename($nombreArchivo);

        // Mover el archivo al servidor
        if (move_uploaded_file($tmpName, $rutaArchivo)) {
            // Guardar metadatos en la BD
            $archivoID = $data->guardarArchivo($nombreArchivo, $rutaArchivo, $usuarioID);

            if (is_numeric($archivoID)) {
                // Procesar el archivo Excel e insertar datos
                $resultado = $data->insertarDatosDesdeExcel($rutaArchivo, $archivoID);
                if (strpos($resultado, "Error") === false) {
                    $archivosProcesados++;
                } else {
                    $errores[] = "Error en $nombreArchivo: $resultado";
                }
            } else {
                $errores[] = "Error al guardar metadatos de $nombreArchivo";
            }
        } else {
            $errores[] = "Error al subir el archivo $nombreArchivo";
        }
    }

    if ($archivosProcesados > 0) {
        echo "<script>
                alert('$archivosProcesados archivo(s) subido(s) y procesado(s) correctamente.');
                window.location.href = '../form-fileuploads.php';
              </script>";
    } else {
        echo "<script>
                alert('No se pudo procesar ningún archivo. " . implode(" | ", $errores) . "');
                window.location.href = '../form-fileuploads.php';
              </script>";
    }
} else {
    echo "<script>
            alert('No se ha seleccionado ningún archivo.');
            window.location.href = '../form-fileuploads.php';
          </script>";
}
?>
