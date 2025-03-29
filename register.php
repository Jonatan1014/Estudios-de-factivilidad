<?php

session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario_email'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: index.php');
    exit();
}

// Definir las carreras disponibles
$carrerasDisponibles = [
    'Admi. Empresas',
    'Ing. Sistemas',
    'Diseño gráfico',
    'Ing. Industrial',
    'Psicología',
];
?>

<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:11 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Register | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/logo-dark-.png">

    <!-- Theme Config Js -->
    <script src="assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">

    <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
        <img src="assets/images/sede-udi.jpg" alt="logo"
            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
        <!-- Ajusta el valor de opacity aquí -->
    </div>

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container"  style="opacity: 0.9;">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">
                        <!-- Logo-->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="https://web.udi.edu.co/">
                                <span><img src="assets/images/logo_dark.png" alt="logo" height="30"></span>
                            </a>
                        </div>

                        <div class="card-body p-3">

                            <div class="text-center w-75 m-auto">
                                <p class="text-muted mb-4">¿No tienes una cuenta? Crea tu cuenta, toma menos de un
                                    minuto.</p>
                            </div>

                            <form action="action/register_user.php" method="post">

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="studentCode" class="form-label">Código de Estudiante</label>
                                        <input class="form-control" name="code_student" type="text" id="studentCode"
                                            placeholder="Ingrese su código" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="fullname" class="form-label">Nombre Completo</label>
                                        <input class="form-control" name="name" type="text" id="fullname"
                                            placeholder="Ingrese su nombre" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Dirección de Correo Electrónico</label>
                                    <input class="form-control" name="email" type="email" id="emailaddress" required
                                        placeholder="Ingrese su correo">
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Contraseña</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Ingrese su contraseña">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-select" class="form-label">Carrera</label>
                                        <select class="form-select"  id="example-select" name="carrera">
                                            <option value="">Seleccione una carrera</option>
                                            <!-- Opción predeterminada -->
                                            <?php foreach ($carrerasDisponibles as $carrera): ?>
                                            <option value="<?php echo htmlspecialchars($carrera); ?>">
                                                <?php echo htmlspecialchars($carrera); ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 text-center">
                                    <button class="btn btn-primary" type="submit"> Registrarse </button>
                                </div>

                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="form-label">¿Ya tienes una cuenta? <a href="login.php"
                                    class="form-label ms-1"><b>Iniciar Sesión</b></a></p>
                        </div> <!-- end col-->
                    </div>
                    <!-- end row -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt">
        <script>
        document.write(new Date().getFullYear())
        </script> © Jcantillo
    </footer>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>



<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:11 GMT -->

</html>