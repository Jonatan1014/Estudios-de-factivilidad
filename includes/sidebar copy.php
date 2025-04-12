<?php

// Verificar si la sesión no está activa antes de iniciar una nueva
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión si no está ya activa
}
require_once('includes/Class-user.php'); // Asegúrate de incluir la clase correcta
$usuario = new Usuario();
$usuario = $usuario->datosUser_email($_SESSION['email']);



?>




<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.php" class="logo logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.php" class="logo logo-dark">
        <span class="logo-lg">
            <img src="assets/images/logo-dark.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo-dark-sm.png" alt="small logo">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <div class="button-sm-hover" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </div>

    <!-- Full Sidebar Menu Close Button -->
    <div class="button-close-fullsidebar">
        <i class="ri-close-fill align-middle"></i>
    </div>

    <!-- Sidebar -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <!-- Leftbar User -->
        <div class="leftbar-user">
            <a href="pages-profile.html">
                <img src="assets/images/users/avatar-1.jpg" alt="user-image" height="42"
                    class="rounded-circle shadow-sm">
                <span class="leftbar-user-name mt-2">Dominic Keller</span>
            </a>
        </div>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title">Navigation</li>








            <?php
        if (!($usuario["rol"]!="admin" && $usuario["rol"]!="root")) {
  

        
        ?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link collapsed">
                    <i class="uil-folder-plus"></i>
                    <span> Archivos</span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce" style="">
                    <ul class="side-nav-second-level">

                        <li>
                            <a href="form-fileuploads.php">Subir Estudio F.</a>
                        </li>
                        <li>
                            <a href="table-data.php">Listar Estudios F.</a>
                        </li>

                    </ul>
                </div>
            </li>
            <?php
            if($usuario["rol"]=="root"){

            
            ?>
            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEmail" aria-expanded="false" aria-controls="sidebarEmail"
                    class="side-nav-link collapsed">
                    <i class="uil-user"></i>
                    <span> Usuarios </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEmail" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="table-user.php">Listar Usuarios</a>
                        </li>
                        <li>
                            <a href="form-register-user.php">Registrar Usuario</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks"
                    class="side-nav-link">
                    <i class="uil-clipboard-alt"></i>
                    <span> Proveedores </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarTasks">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="pages-proveedores.php">Lista de Proveedores</a>
                        </li>
                    </ul>
                </div>
            </li>


            <?php
            }
        }
?>




        </ul>
        <!--- End Sidemenu -->

        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->