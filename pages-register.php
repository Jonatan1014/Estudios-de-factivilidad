<!DOCTYPE html>
<html lang="es">


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-register-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 16:33:12 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Theme Config Js -->
    <script src="assets/js/hyper-config.js"></script>

    <!-- App css -->
    <link href="assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg pb-0">

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="card-body d-flex flex-column h-100 gap-3">

                <!-- Logo -->
                <div class="auth-brand text-center text-lg-start">
                    <a href="index.html" class="logo-dark">
                        <span><img src="assets/images/logo-dark.png" alt="dark logo" height="22"></span>
                    </a>
                    <a href="index.html" class="logo-light">
                        <span><img src="assets/images/logo.png" alt="logo" height="22"></span>
                    </a>
                </div>

                <div class="my-auto">
                    <!-- title-->
                    <h4 class="mt-3">Crear cuenta</h4>
                    <p class="text-muted mb-4">¿No tienes una cuenta? Crea tu cuenta, te llevará menos de un minuto</p>

                    <!-- form -->
                    <form action="action/register-user.php" method="post">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input class="form-control" type="text" id="fullname" name="fullname"
                                placeholder="Introduzca su nombre completo" required>
                        </div>
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Correo electrónico</label>
                            <input class="form-control" type="email" id="emailaddress" name="emailaddress" required
                                placeholder="Introduzca su correo electrónico">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input class="form-control" type="password" id="password" name="password" required
                                placeholder="Introduzca su contraseña">
                        </div>
                        <div class="mb-3">
                        </div>
                        <div class="mb-0 d-grid text-center">
                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-account-circle"></i>
                                Registrarse </button>
                        </div>
                    </form>
                    <!-- end form -->

                </div>

                <!-- Footer-->
                <footer class="footer footer-alt">
                    <p class="text-muted">¿Ya tienes una cuenta? <a href="pages-login.php"
                            class="text-muted ms-1"><b>Inicia sesion</b></a></p>
                </footer>

            </div> <!-- end .card-body -->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">Ingenieria en equipo</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i> Generando progreso desde 1956
                    . <i class="mdi mdi-format-quote-close"></i>
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->
    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-register-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Mar 2025 16:33:12 GMT -->

</html>