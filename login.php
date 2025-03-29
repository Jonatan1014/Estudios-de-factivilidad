<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (isset($_SESSION['usuario_email'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: index.php');
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:11 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
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

<body class="authentication-bg position-relative">
    <div class="position-absolute start-0 end-0 bottom-0 w-100 h-100">
        <img src="assets/images/sede-udi.jpg" alt="logo"
            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
        <!-- Ajusta el valor de opacity aquí -->
    </div>
    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative">
        <div class="container" style="opacity: 0.9;">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        <!-- Logo -->
                        <div class="card-header py-4 text-center bg-primary">
                            <a href="https://web.udi.edu.co/">
                                <span><img src="assets/images/logo_dark.png" alt="logo" height="30"></span>
                            </a>
                        </div>

                        <div class="card-body p-4">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Iniciar Sesión</h4>
                                <p class="text-muted mb-4">Ingrese su dirección de correo electrónico y contraseña para
                                    acceder al panel de administración.</p>
                            </div>

                            <form action="action/login_user.php" method="POST">

                                <div class="mb-3">
                                    <label for="emailaddress" class="form-label">Dirección de correo electrónico</label>
                                    <input class="form-control" type="email" name="email" id="emailaddress" required=""
                                        placeholder="Ingrese su correo">
                                </div>

                                <div class="mb-3">
                                   
                                    <label for="password" class="form-label">Contraseña</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" name="password" class="form-control"
                                            placeholder="Ingrese su contraseña">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Iniciar Sesión </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="form-label">¿No tienes una cuenta? <a href="register.php"
                                    class="form-label ms-1"><b>Regístrate</b></a></p>
                        </div> <!-- end col -->
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



<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:11 GMT -->

</html>