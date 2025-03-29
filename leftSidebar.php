<?php

// Verificar si la sesión no está activa antes de iniciar una nueva
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Iniciar la sesión si no está ya activa
}
require_once('includes/class_usuario.php'); // Asegúrate de incluir la clase correcta
$usuario = new Usuario();
$usuario = $usuario->datosUser_email($_SESSION['usuario_email']);



?>

<div class="leftside-menu">

    <!-- Brand Logo Light -->
    <a href="index.php" class="logo logo-light">
        <span class="logo-lg">
            <img src="assets/images/logo_udi.png" alt="logo">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_udi.png" alt="small logo">
        </span>
    </a>

    <!-- Brand Logo Dark -->
    <a href="index.php" class="logo logo-dark">
        <span class="logo-lg">
            <img src="assets/images/logo_udi.png" alt="dark logo">
        </span>
        <span class="logo-sm">
            <img src="assets/images/logo_udi.png" alt="small logo">
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

            <li class="side-nav-title">Navegacion</li>

            <li class="side-nav-item">
                <a href="index.php" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Home </span>
                </a>
            </li>

        <?php
        if (!($usuario["rol"]!="Admin" && $usuario["rol"]!="Root")) {
  

        
        ?>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false"
                    aria-controls="sidebarEcommerce" class="side-nav-link collapsed">
                    <i class="uil-books"></i>
                    <span> Libros </span>
                    <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarEcommerce" style="">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="book_loan.php">Libros Prestados</a>
                        </li>
                        <li>
                            <a href="form-elements.php">Registrar Libros</a>
                        </li>
                        <li>
                            <a href="tables-datatable-book.php">Lista Libros</a>
                        </li>

                    </ul>
                </div>
            </li>
            <?php
            if($usuario["rol"]=="Root"){

            
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
                            <a href="tables-datatable.php">Lista Usuarios</a>
                        </li>
                        <li>
                            <a href="form-elements-user.php">Registrar Administrador</a>
                        </li>
                        <li>
                            <a href="form-elements-student.php">Registrar Estudiante</a>
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