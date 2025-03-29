<?php

// Verificar si la sesión no está activa antes de iniciar una nueva
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión si no está ya activa
}
require_once('includes/class_usuario.php'); // Asegúrate de incluir la clase correcta
$usuario = new Usuario();
$usuario = $usuario->datosUser_email($_SESSION['usuario_email']);

?>
<div class="navbar-custom">
    <div class="topbar container-fluid">
        <div class="d-flex align-items-center gap-lg-2 gap-1">

            <!-- Topbar Brand Logo -->
            <div class="logo-topbar">
                <!-- Logo light -->
                <a href="index.php" class="logo-light">
                    <span class="logo-lg">
                        <img src="assets/images/logo_udi.png" alt="logo">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo_udi.png" alt="small logo">
                    </span>
                </a>

                <!-- Logo Dark -->
                <a href="index.php" class="logo-dark">
                    <span class="logo-lg">
                        <img src="assets/images/logo_udi.png" alt="dark logo">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo_udi.png" alt="small logo">
                    </span>
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>

            <!-- Horizontal Menu Toggle Button -->
            <button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <div class="lines">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </button>

            <!-- Topbar Search Form -->

        </div>

        <ul class="topbar-menu d-flex align-items-center gap-3">


            <li class="dropdown notification-list">


                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>

            </li>







            <!-- <li class="d-none d-sm-inline-block">
                <div class="nav-link" id="light-dark-mode" data-bs-toggle="tooltip" data-bs-placement="left"
                    title="Theme Mode">
                    <i class="ri-moon-line font-22"></i>
                </div>
            </li> -->




            <li class="dropdown">
                <a class="nav-link dropdown-toggle arrow-none nav-user px-2" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="avatar-md d-flex justify-content-center align-items-center" style="height: 100%;">
                        <span
                            class="avatar-title bg-primary rounded-circle d-flex justify-content-center align-items-center"
                            style="width: 80%; height: 80%;">
                            <?php echo substr($usuario["name"], 0, 3); ?>

                        </span>
                    </span>

                    <!-- Avatar Medium -->
                    <span class="d-lg-flex flex-column gap-1 d-none">
                        <h5 class="my-0"><?php echo $usuario["name"] ?></h5>
                        <h6 class="my-0 fw-normal"><?php echo $usuario["rol"] ?></h6>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated profile-dropdown">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenido!</h6>
                    </div>


                    <!-- item-->
                    <a href="pages-profile-2.php" class="dropdown-item">
                        <i class="mdi mdi-account-circle me-1"></i>
                        <span>Mi Perfil</span>
                    </a>

                    <!-- item-->
                    <a href="action/destroy_session.php" class="dropdown-item">
                        <i class="mdi mdi-logout me-1"></i>
                        <span>Cerrar Sesion</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>