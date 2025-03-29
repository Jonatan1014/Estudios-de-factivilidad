<?php 
require_once '../includes/class_usuario.php';  

// Verificar que los campos requeridos estén presentes y no vacíos
if (
    !empty($_POST['code_student']) &&
    !empty($_POST['name']) &&
    !empty($_POST['email']) &&
    !empty($_POST['password']) &&
    !empty($_POST['carrera'])
) {    
    // Asignar las variables de entrada
    $code_student = $_POST['code_student'] ?? null;
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $pass = $_POST['password'] ?? null;
    $rol = 'Estudiante';
    $carrera = $_POST['carrera'] ?? null;
    $estado = 'Activo';

    // Instanciar la clase Usuario
    $Usuario_class = new Usuario();
    
    try {
        // Verificar si el código de estudiante o el correo ya están registrados
        $usuario_existente = $Usuario_class->verificarDuplicados($code_student, $email);

        if ($usuario_existente) {
            // Si ya existe un usuario con el mismo código o correo, mostrar alerta
            echo "<script>
                    alert('El código de estudiante o el correo ya están registrados. Intenta con otros.');
                    window.location.href = '../register.php';
                  </script>";
            exit(); // Detener la ejecución
        }

        // Ejecutar la operación de agregar estudiante
        $operar = $Usuario_class->agregarUsuario($code_student, $name, $email, $pass, $rol, $carrera, $estado);

        // Redireccionar si la operación es exitosa
        if ($operar) {
            echo "<script>
                    window.location.href = '../pages-logout.php';
                  </script>";
            exit(); // Asegurarse de detener la ejecución después de la redirección
        } else {
            echo "<script>
                    alert('Error al registrar un usuario');
                    window.location.href = '../register.php';
                  </script>";
            exit(); // Asegurarse de detener la ejecución después de la redirección
        }
    } catch (Exception $e) {
        // Manejar cualquier error que ocurra durante la operación
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = '../register.php';
              </script>";
        exit(); // Asegurarse de detener la ejecución después de la redirección
    }
} else {
    // Manejar el caso en que algún campo obligatorio esté vacío
    echo "<script>
            alert('Por favor, completa todos los campos.');
            window.location.href = '../register.php';
          </script>";
    exit(); // Asegurarse de detener la ejecución después de la redirección
}
?>
