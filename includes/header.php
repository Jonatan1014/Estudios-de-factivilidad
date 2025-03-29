<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="stylesheet" href="assets/css/header.css">

</head>

<body>
    <?php
        // Detectar el archivo actual
        $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <header class="header">
        <div class="top-bar">
            <img src="assets/image/logo_udi.png" alt="UDI Logo" class="logo">
            <span class="title">Biblioteca UDI</span>
        </div>
        <nav class="nav-bar">
            <div class="nav-links">
                <!-- Aplicar la clase "active" dependiendo de la página -->
                <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Buscar Libro</a>
                <a href="libro_prestado.php" class="<?= $current_page == 'libro_prestado.php' ? 'active' : '' ?>">Libros
                    Prestados</a>
            </div>
            <div class="user-links">
                <a href="account.php" class="<?= $current_page == 'account.php' ? 'active' : '' ?>">
                    <span class="user-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="M12 4a4 4 0 0 1 4 4a4 4 0 0 1-4 4a4 4 0 0 1-4-4a4 4 0 0 1 4-4m0 10c4.42 0 8 1.79 8 4v2H4v-2c0-2.21 3.58-4 8-4" />
                        </svg>
                    </span>
                    Mi Perfil</a>
            </div>
        </nav>
    </header>
</body>

</html>