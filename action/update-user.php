<?php
session_start();
require_once '../includes/Class-user.php';

if (isset($_POST['idUser'], $_POST['nombre'], $_POST['email'], $_POST['rol']) &&
    !empty(trim($_POST['idUser'])) &&
    !empty(trim($_POST['nombre'])) &&
    !empty(trim($_POST['email'])) &&
    !empty(trim($_POST['rol']))) {

    // Limpiar y asignar variables
    $idUser = intval($_POST['idUser']);
    $name = htmlspecialchars(trim($_POST['nombre']));
    $email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
    $rol = trim($_POST['rol']);
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Instanciar la clase Usuario
    $usuario = new Usuario();

    // Verificar si el email ya existe en otro usuario
    $usuarioExistente = $usuario->buscarPorEmail($email);
    if ($usuarioExistente && $usuarioExistente['id'] != $idUser) {
        echo "<script>
                alert('Error: El correo ya está en uso por otro usuario.');
                window.location.href = '../form-register-user.php';
              </script>";
        exit();
    }

    try {
        // Llamar a la función de actualización
        $operacionExitosa = $usuario->modificarUsuario($idUser, $name, $email, $password, $rol);

        if ($operacionExitosa) {
            echo "<script>
                    alert('Usuario actualizado correctamente.');
                    window.location.href = '../form-register-user.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('No se realizaron cambios en el usuario.');
                    window.location.href = '../form-register-user.php';
                  </script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Error en la actualización: " . $e->getMessage() . "');
                window.location.href = '../form-register-user.php';
              </script>";
        exit();
    }
} else {
    echo "<script>
            alert('Por favor, completa todos los campos obligatorios.');
            window.location.href = '../form-register-user.php';
          </script>";
    exit();
}
?>
