<?php
session_start();
require_once '../includes/Class-user.php';

// Verificar que los campos obligatorios estén presentes y no vacíos
if (isset($_POST['email'], $_POST['password']) && 
    !empty(trim($_POST['email'])) && 
    !empty(trim($_POST['password']))) {

    // Limpiar y asignar las variables de entrada
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Instanciar la clase Usuario
    $usuario = new Usuario();

    try {
        // Validar credenciales
        if ($usuario->validarCredenciales($email, $password)) {
            $_SESSION['email'] = $email;
            header('Location: ../index.php');
            exit();
        } else {
            echo "<script>
                    alert('Usuario no registrado y/o credenciales incorrectas');
                    window.location.href = '../pages-login.php';
                  </script>";
            exit();
        }
    } catch (Exception $e) {
        // Manejar cualquier error durante la operación
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = '../pages-login.php';
              </script>";
        exit();
    }
} else {
    // Manejar el caso en que algún campo obligatorio esté vacío
    echo "<script>
            alert('Campos vacíos o nulos.');
            window.location.href = '../pages-login.php';
          </script>";
    exit();
}
?>
