<?php 
require_once '../includes/Class-user.php';  

if (!empty($_POST['fullname']) && !empty($_POST['emailaddress']) && !empty($_POST['password'])) {    
    $fullname = $_POST['fullname'];
    $emailaddress = $_POST['emailaddress'];
    $password = $_POST['password'];
    $rol = 'user';
   
    $Usuario_class = new Usuario();
    
    try {
        // Verificar si el correo ya está registrado
        if ($Usuario_class->verificarEmail($emailaddress)) {
            echo "<script>
                    alert('El correo ya está registrado. Intenta con otro.');
                    window.location.href = '../pages-register.php';
                  </script>";
            exit();
        }

        // Registrar el usuario
        $operar = $Usuario_class->agregarUsuario($fullname, $emailaddress, $password, $rol);

        if ($operar) {
            echo "<script>
                    window.location.href = '../pages-register-successful.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Error al registrar el usuario.');
                    window.location.href = '../pages-register.php';
                  </script>";
            exit();
        }
    } catch (Exception $e) {
        echo "<script>
                alert('Error: " . $e->getMessage() . "');
                window.location.href = '../pages-register.php';
              </script>";
        exit();
    }
} else {
    var_dump($fullname,
    $emailaddress,
    $password,
    $rol);
    echo "<script>
            alert('Por favor, completa todos los campos.');
            window.location.href = '../pages-register.php';
          </script>";
    exit();
}
