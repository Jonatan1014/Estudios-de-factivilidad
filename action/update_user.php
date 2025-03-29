<?php 
require_once '../includes/class_usuario.php';

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
    $_POST['idUser'], $_POST['name'], $_POST['email'], 
    $_POST['rol'], $_POST['carrera'], $_POST['estado']
])) {    
    // Asignar las variables de entrada
    $idUser = $_POST['idUser'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = isset($_POST['password']) && !empty($_POST['password']) ? $_POST['password'] : null; // Solo asignar si no está vacío
    $rol = $_POST['rol'];
    $carrera = $_POST['carrera'];
    $estado = $_POST['estado'];

    // Instanciar la clase Usuario
    $usuario_class = new Usuario();

    try {
        // Ejecutar la operación de modificar usuario
        $operar = $usuario_class->modificarUsuario(
            $idUser, $name, $email, $password, 
            $rol, $carrera, $estado
        );

        if ($operar) {
            echo "<script>alert('Usuario actualizado correctamente'); window.location.href = '../editar_usuario.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al actualizar el usuario'); window.location.href = '../editar_usuario.php';</script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "'); window.location.href = '../editar_usuario.php';</script>";
        exit();
    }
} else {
    // Manejar el caso en que algún campo obligatorio esté vacío
    echo "<script>alert('Por favor, completa todos los campos.'); window.location.href = '../editar_usuario.php';</script>";
    exit();
}
?>
