<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['email'])) {
    // Si no ha iniciado sesión, redirigir a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

require('includes/Class-user.php'); // Asegúrate de incluir la clase correcta
$usuario = new Usuario();
$usuario = $usuario->datosUser_email($_SESSION['email']); // Obtener los datos de los libros
if ($usuario["rol"]!="admin" && $usuario["rol"]!="root") {
    header('Location: index.php');
    exit();

}

if (empty($_POST['id_estudio'])){
    header('Location: index.php');
    exit();
} 
require('includes/Class-data.php');
$libro = new Data();
$datos = $libro->listarEF_ID($_POST['id_estudio']); // Obtener los datos de un libro específico


?>

<!DOCTYPE html>
<html lang="es">


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:15 GMT -->

<head>
    <meta charset="utf-8" />
    <title>Details Books</title>
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

<body>
    <!-- Begin page -->
    <div class="wrapper">


        <!-- ========== Topbar Start ========== -->
        <?php include("includes/navbar.php")        ?>
        <!-- ========== Topbar End ========== -->


        <!-- ========== Left Sidebar Start ========== -->
        <?php include("includes/sidebar.php")        ?>
        <!-- ========== Left Sidebar End ========== -->

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                        <li class="breadcrumb-item active">Detalles Estudio de Factivilidad</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Detalles Estudio de Factivilidad</h4>
                            </div>
                            <ul class="nav nav-tabs mb-3">
                                <li class="nav-item">
                                    <a href="#profile" data-bs-toggle="tab" aria-expanded="true"
                                        class="nav-link active">
                                        <i class="mdi mdi-information-variant d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Informacion</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#settings" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                        <i class="mdi mdi-playlist-edit d-md-none d-block"></i>
                                        <span class="d-none d-md-block">Exportar Estudio de Factivilidad</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane" id="home">
                                    <p>



                                    </p>
                                </div>
                                <div class="tab-pane show active" id="profile">
                                    <p>

                                    <div class="col-xl-4 col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- First Column -->
                                                    <div class="col-md-6">
                                                        <h5 class="mt-1 mb-1">Cliente:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['cliente']?></h7>


                                                        <h5 class="mb-1">Alcance:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['alcance']?></h7>


                                                        <h5 class="mb-1">Dimensiones:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['dimensiones']?>
                                                        </h7>

                                                        <h5 class="mb-1">Cantidad:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['cantidad']?>
                                                        </h7>
                                                    </div>

                                                    <!-- Second Column -->
                                                    <div class="col-md-6">
                                                        <h5 class="mt-1 mb-1">Fecha:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['fecha_estudio']?></h7>

                                                        <h5 class="mb-1">Cotizacion:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['cotizacion']?></h7>


                                                        <h5 class="mb-1">Tipo:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['tipo']?></h7>

                                                        <h5 class="mb-1">Cod. Fabricacion:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['cod_fabricacion']?>
                                                        </h7>

                                                        <h5 class="mb-1">Doc. Referencia:</h5>
                                                        <h7 class="text-muted"><?php echo $datos['doc_referencia']?>
                                                        </h7>


                                                    </div>
                                                </div> <!-- end row -->
                                            </div> <!-- end card-body -->

                                        </div> <!-- end card -->
                                    </div> <!-- end col -->
                                    <div class="mb-3">
                                        <input type="text" placeholder="1. Materiales" name="cedula" id="simpleinput"
                                            class="form-control" readonly style="text-align: center;">

                                    </div>
                                    </p>
                                </div>
                                <div class="tab-pane" id="settings">
                                    <p>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="action/register_loan.php" method="post">
                                                <div class="row">
                                                    <div class="mb-3">

                                                        <input type="text" name="cedula" id="simpleinput"
                                                            class="form-control" readonly>
                                                    </div>
                                                    <!-- Primera columna -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Código
                                                                estudiante</label>
                                                            <input type="text" name="cedula" id="simpleinput"
                                                                class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="example-date" class="form-label">Fecha de
                                                                entrega</label>
                                                            <input class="form-control" id="fecha-entrega" type="date"
                                                                name="date" value="<?php echo date('Y-m-d'); ?>"
                                                                readonly>
                                                        </div>
                                                    </div>

                                                    <!-- Segunda columna -->
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="example-date" class="form-label">Fecha de
                                                                devolución</label>
                                                            <input class="form-control" name="fecha_entrega"
                                                                id="fecha-devolucion" type="date" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="simpleinput" class="form-label">Título del
                                                                libro</label>
                                                            <input type="text" id="simpleinput" class="form-control"
                                                                value="<?php echo $datos['titulo']?>" readonly>
                                                        </div>

                                                        <div class="mb-3">
                                                            <input type="hidden" name="idLibro"
                                                                value="<?php echo $datos['idLibro']?>" id="simpleinput"
                                                                class="form-control">
                                                        </div>
                                                    </div>

                                                    <!-- Botón de envío -->
                                                    <div class="mb-3 text-center">
                                                        <br><br><br>
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <script>
                                    // Obtenemos las fechas de entrega y devolución
                                    const fechaEntregaInput = document.getElementById('fecha-entrega');
                                    const fechaDevolucionInput = document.getElementById('fecha-devolucion');

                                    // Convertir la fecha actual a un formato válido de input (YYYY-MM-DD)
                                    const fechaEntrega = new Date(fechaEntregaInput.value);

                                    // Calcular fecha mínima y máxima para la devolución
                                    const fechaMinimaDevolucion = new Date(fechaEntrega);
                                    fechaMinimaDevolucion.setDate(fechaMinimaDevolucion.getDate() +
                                        1); // Al menos 1 día después

                                    const fechaMaximaDevolucion = new Date(fechaEntrega);
                                    fechaMaximaDevolucion.setDate(fechaMaximaDevolucion.getDate() +
                                        3); // Máximo 3 días después

                                    // Convertir las fechas a formato de input (YYYY-MM-DD)
                                    const formatoFecha = (fecha) => fecha.toISOString().split('T')[0];

                                    // Establecer los valores de mínimo y máximo en el campo de fecha de devolución
                                    fechaDevolucionInput.min = formatoFecha(fechaMinimaDevolucion);
                                    fechaDevolucionInput.max = formatoFecha(fechaMaximaDevolucion);
                                    </script>


                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer -->
            <?php include("includes/footer.php"); ?>
            <!-- end Footer -->

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Theme Settings -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
        <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
            <h5 class="text-white m-0">Theme Settings</h5>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div data-simplebar class="h-100">
                <div class="card mb-0 p-3">
                    <h5 class="mt-0 font-16 fw-bold mb-3">Choose Layout</h5>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout01" name="data-layout" type="radio" value="vertical"
                                    class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout01">
                                    <span class="d-flex h-100">
                                        <span class="flex-shrink-0">
                                            <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                            </span>
                                        </span>
                                        <span class="flex-grow-1">
                                            <span class="d-flex h-100 flex-column">
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Vertical</h5>
                        </div>
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal"
                                    class="form-check-input">
                                <label class="form-check-label p-0 avatar-md w-100" for="customizer-layout02">
                                    <span class="d-flex h-100 flex-column">
                                        <span
                                            class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                            <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            <span
                                                class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                        </span>
                                        <span class="bg-light d-block p-1"></span>
                                    </span>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Horizontal</h5>
                        </div>
                    </div>

                    <h5 class="my-3 font-16 fw-bold">Color Scheme</h5>

                    <div class="colorscheme-cardradio">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-color-light">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column bg-white rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color" class="bg-white rounded-2 h-100">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="d-flex h-100 flex-column bg-white rounded-2">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-bs-theme"
                                        id="layout-color-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100 bg-black"
                                        for="layout-color-dark">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary border-opacity-25 border-3 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light-lighten d-flex p-1 align-items-center border-bottom border-opacity-25 border-primary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light-lighten d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-width">
                        <h5 class="my-3 font-16 fw-bold">Layout Mode</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="layout-mode-fluid" value="fluid">
                                    <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-fluid">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Fluid</h5>
                            </div>
                            <div class="col-4" id="layout-boxed">
                                <div class="form-check card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="layout-mode-boxed" value="boxed">
                                    <label class="form-check-label p-0 avatar-md w-100 px-2" for="layout-mode-boxed">
                                        <div id="sidebar-size" class="border-start border-end">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 border-end flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column rounded-2">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color" class="border-start border-end h-100">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Boxed</h5>
                            </div>

                            <div class="col-4" id="layout-detached">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-layout-mode"
                                        id="data-layout-detached" value="detached">
                                    <label class="form-check-label p-0 avatar-md w-100" for="data-layout-detached">
                                        <span class="d-flex h-100 flex-column">
                                            <span class="bg-light d-flex p-1 align-items-center border-bottom ">
                                                <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="d-flex h-100 p-1 px-2">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-light d-flex h-100 flex-column p-1 px-2">
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100"></span>
                                                    </span>
                                                </span>
                                            </span>
                                            <span class="bg-light d-block p-1 mt-auto px-2"></span>
                                        </span>

                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Detached</h5>
                            </div>
                        </div>
                    </div>

                    <h5 class="my-3 font-16 fw-bold">Topbar Color</h5>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-light" value="light">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                        </div>

                        <div class="col-4" style="--ct-dark-rgb: 64,73,84;">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-dark" value="dark">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-primary-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-dark d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-dark d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-primary-lighten rounded me-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-primary border-opacity-25 border-3 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                        </div>

                        <div class="col-4">
                            <div class="form-check card-radio">
                                <input class="form-check-input" type="radio" name="data-topbar-color"
                                    id="topbar-color-brand" value="brand">
                                <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-brand">
                                    <div id="sidebar-size">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-primary bg-gradient d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </div>

                                    <div id="topnav-color">
                                        <span class="d-flex h-100 flex-column">
                                            <span
                                                class="bg-primary bg-gradient d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                <span class="d-block p-1 bg-light opacity-25 rounded me-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-auto"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                                <span
                                                    class="d-block border border-3 border opacity-25 rounded ms-1"></span>
                                            </span>
                                            <span class="bg-light d-block p-1"></span>
                                        </span>
                                    </div>
                                </label>
                            </div>
                            <h5 class="font-14 text-center text-muted mt-2">Brand</h5>
                        </div>
                    </div>

                    <div>
                        <h5 class="my-3 font-16 fw-bold">Menu Color</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-light" value="light">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-light">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-opacity-25">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-light d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Light</h5>
                            </div>

                            <div class="col-4" style="--ct-dark-rgb: 64,73,84;">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-dark" value="dark">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-dark">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span class="bg-dark d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border border-secondary rounded border-opacity-25 border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary border-primary border-opacity-25">
                                                    <span class="d-block p-1 bg-primary-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-auto"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                    <span
                                                        class="d-block border border-secondary rounded border-opacity-25 border-3 ms-1"></span>
                                                </span>
                                                <span class="bg-dark d-block p-1"></span>
                                            </span>
                                        </div>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Dark</h5>
                            </div>
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-menu-color"
                                        id="leftbar-color-brand" value="brand">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-color-brand">
                                        <div id="sidebar-size">
                                            <span class="d-flex h-100">
                                                <span class="flex-shrink-0">
                                                    <span
                                                        class="bg-primary bg-gradient d-flex h-100 flex-column p-1 px-2">
                                                        <span class="d-block p-1 bg-light-lighten rounded mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                        <span
                                                            class="d-block border opacity-25 rounded border-3 w-100 mb-1"></span>
                                                    </span>
                                                </span>
                                                <span class="flex-grow-1">
                                                    <span class="d-flex h-100 flex-column">
                                                        <span class="bg-light d-block p-1"></span>
                                                    </span>
                                                </span>
                                            </span>
                                        </div>

                                        <div id="topnav-color">
                                            <span class="d-flex h-100 flex-column">
                                                <span
                                                    class="bg-light d-flex p-1 align-items-center border-bottom border-secondary">
                                                    <span class="d-block p-1 bg-dark-lighten rounded me-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-auto"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded ms-1"></span>
                                                </span>
                                                <span class="bg-primary bg-gradient d-block p-1"></span>
                                            </span>
                                        </div>

                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Brand</h5>
                            </div>
                        </div>
                    </div>

                    <div id="sidebar-size">
                        <h5 class="my-3 font-16 fw-bold">Sidebar Size</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-default" value="default">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-default">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1 px-2">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Default</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-compact" value="compact">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-compact">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end  flex-column p-1">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Compact</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-small" value="condensed">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-small">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end flex-column"
                                                    style="padding: 2px;">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Condensed</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-small-hover" value="sm-hover">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-small-hover">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="bg-light d-flex h-100 border-end flex-column"
                                                    style="padding: 2px;">
                                                    <span class="d-block p-1 bg-dark-lighten rounded mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                    <span
                                                        class="d-block border border-3 border-secondary border-opacity-25 rounded w-100 mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Hover View</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-full" value="full">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-full">
                                        <span class="d-flex h-100">
                                            <span class="flex-shrink-0">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="d-block p-1 bg-dark-lighten mb-1"></span>
                                                </span>
                                            </span>
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Full Layout</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-check sidebar-setting card-radio">
                                    <input class="form-check-input" type="radio" name="data-sidenav-size"
                                        id="leftbar-size-fullscreen" value="fullscreen">
                                    <label class="form-check-label p-0 avatar-md w-100" for="leftbar-size-fullscreen">
                                        <span class="d-flex h-100">
                                            <span class="flex-grow-1">
                                                <span class="d-flex h-100 flex-column">
                                                    <span class="bg-light d-block p-1"></span>
                                                </span>
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <h5 class="font-14 text-center text-muted mt-2">Fullscreen Layout</h5>
                            </div>
                        </div>
                    </div>

                    <div id="layout-position">
                        <h5 class="my-3 font-16 fw-bold">Layout Position</h5>

                        <div class="btn-group radio" role="group">
                            <input type="radio" class="btn-check" name="data-layout-position" id="layout-position-fixed"
                                value="fixed">
                            <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                            <input type="radio" class="btn-check" name="data-layout-position"
                                id="layout-position-scrollable" value="scrollable">
                            <label class="btn btn-soft-primary w-sm ms-0"
                                for="layout-position-scrollable">Scrollable</label>
                        </div>
                    </div>

                    <div id="sidebar-user">
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <label class="font-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" name="sidebar-user"
                                    id="sidebaruser-check">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="offcanvas-footer border-top p-3 text-center">
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
                </div>
                <div class="col-6">
                    <a href="https://themes.getbootstrap.com/product/hyper-responsive-admin-dashboard-template/"
                        target="_blank" role="button" class="btn btn-primary w-100">Buy Now</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>

</body>


<!-- Mirrored from coderthemes.com/hyper_2/saas/pages-starter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 03 Oct 2024 17:04:15 GMT -->

</html>