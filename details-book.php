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
$datos = $libro->listarEF_IDFull($_POST['id_estudio']); // Obtener los datos de un libro específico


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
                                        <i class="mdi mdi-file-download-outline d-md-none d-block"></i>
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

                                        <!-- Contenedor principal -->
                                    <div class="row">
                                        <!-- Agrega esta fila -->
                                        <!-- Card original -->
                                        <div class="col-xl-4 col-lg-6 mb-4">
                                            <!-- Modificado col-lg-6 -->
                                            <div class="card h-100">
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
                                                            <h7 class="text-muted"><?php echo $datos['fecha_estudio']?>
                                                            </h7>

                                                            <h5 class="mb-1">Cotizacion:</h5>
                                                            <h7 class="text-muted"><?php echo $datos['cotizacion']?>
                                                            </h7>


                                                            <h5 class="mb-1">Tipo:</h5>
                                                            <h7 class="text-muted"><?php echo $datos['tipo']?></h7>

                                                            <h5 class="mb-1">Cod. Fabricacion:</h5>
                                                            <h7 class="text-muted">
                                                                <?php echo $datos['cod_fabricacion']?>
                                                            </h7>

                                                            <h5 class="mb-1">Doc. Referencia:</h5>
                                                            <h7 class="text-muted"><?php echo $datos['doc_referencia']?>
                                                            </h7>


                                                        </div>
                                                    </div> <!-- end row -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Nueva card al lado -->
                                        <!-- Nueva card al lado -->
                                        <div class="col-xl-4 col-lg-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="badge badge-warning-lighten p-1"
                                                            style="text-align: center;">
                                                            <code class="link-warning">EPÍTOME</code>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h5 class="mt-1 mb-1">1. MATERIALES:</h5>
                                                            <h7 class="text-muted" id="total-materiales">0.00</h7>

                                                            <h5 class="mb-1">2. INGENIERIA:</h5>
                                                            <h7 class="text-muted" id="total-ingenieria">0.00</h7>

                                                            <h5 class="mt-1 mb-1">3. PRUEBAS NO DESTRUCTIVAS:</h5>
                                                            <h7 class="text-muted" id="total-pruebas">0.00</h7>

                                                            <h5 class="mb-1">4. CONSUMIBLES:</h5>
                                                            <h7 class="text-muted" id="total-consumibles">0.00</h7>
                                                            <h5 class="mb-1">5. TRANSPORTE:</h5>
                                                            <h7 class="text-muted" id="total-transporte">0.00</h7>

                                                            <h5 class="mb-1">6. MANO DE OBRA:</h5>
                                                            <h7 class="text-muted" id="total-mano-obra">0.00</h7>
                                                        </div>

                                                        <div class="col-md-6">

                                                            <h5 class="mb-1">7. PRUEBA HIDROSTATICA:</h5>
                                                            <h7 class="text-muted" id="total-hidrostatica">0.00</h7>

                                                            <h5 class="mb-1">8. PINTURA:</h5>
                                                            <h7 class="text-muted" id="total-pintura">0.00</h7>

                                                            <h5 class="mb-1">TOTAL COSTOS DIRECTOS:</h5>
                                                            <h7 class="text-muted" id="total-directos">0.00</h7>

                                                            <h5 class="mb-1">AIU (30%):</h5>
                                                            <h7 class="text-muted" id="aiu">0.00</h7>

                                                            <h5 class="mb-1">COSTO TOTAL:</h5>
                                                            <h7 class="text-muted" id="total-final">0.00</h7>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- Cierre del row -->
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">1. MATERIALES</code></div>
                                        <div class="mb-3">
                                            <table id="tabla-materiales"
                                                class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Descripción</th>
                                                        <th>Unidad</th>
                                                        <th>Cantidad</th>
                                                        <th>Piezas</th>
                                                        <th>Tarifa</th>
                                                        <th>Subtotal</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '1. MATERIALES';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                    <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                        data-piezas="<?= $item['no_piezas'] ?>"
                                                        data-tarifa="<?= $item['tarifa'] ?>">
                                                        <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                        <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                        <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                        <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                        <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                        <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                        <td class="subtotal"></td>

                                                    </tr>
                                                    <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">2. INGENIERIA</code></div>
                                        <div class="mb-3">
                                            <table id="tabla-ingenieria"
                                                class="table table-striped dt-responsive nowrap w-100">
                                                <thead>
                                                    <tr>
                                                        <th>Código</th>
                                                        <th>Descripción</th>
                                                        <th>Unidad</th>
                                                        <th>Cantidad</th>
                                                        <th>Piezas</th>
                                                        <th>Tarifa</th>
                                                        <th>Subtotal</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '2. INGENIERIA';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                    <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                        data-piezas="<?= $item['no_piezas'] ?>"
                                                        data-tarifa="<?= $item['tarifa'] ?>">
                                                        <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                        <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                        <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                        <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                        <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                        <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                        <td class="subtotal"></td>

                                                    </tr>
                                                    <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">3. PRUEBAS NO DESTRUCTIVAS</code></div>
                                        <table id="tabla-pruebas"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '3. PRUEBAS NO DESTRUCTIVAS';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">4. CONSUMIBLES</code></div>
                                        <table id="tabla-consumibles"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '4. CONSUMIBLES';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">5. TRANSPORTE</code></div>
                                        <table id="tabla-transporte"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '5. TRANSPORTE';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">6. MANO DE OBRA</code></div>
                                        <table id="tabla-mano-obra"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '6. MANO DE OBRA';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">7. PRUEBA HIDROSTATICA</code></div>
                                        <table id="tabla-hidrostatica"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '7. PRUEBA HIDROSTATICA';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="mb-3">
                                        <div class="bg-primary-subtle p-2 " style="text-align: center;"><code
                                                class="link-primary">8. PINTURA MANO DE OBRA</code></div>
                                        <table id="tabla-pintura"
                                            class="table table-striped dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>Código</th>
                                                    <th>Descripción</th>
                                                    <th>Unidad</th>
                                                    <th>Cantidad</th>
                                                    <th>Piezas</th>
                                                    <th>Tarifa</th>
                                                    <th>Subtotal</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
            $seccionMateriales = array_filter($datos['secciones'], function($seccion) {
                return strtoupper($seccion['nombre']) === '8. PINTURA MANO DE OBRA';
            });
            
            if (!empty($seccionMateriales)) {
                $materiales = reset($seccionMateriales)['items'];
                foreach ($materiales as $item) {
            ?>
                                                <tr data-cantidad="<?= $item['cantidad'] ?>"
                                                    data-piezas="<?= $item['no_piezas'] ?>"
                                                    data-tarifa="<?= $item['tarifa'] ?>">
                                                    <td><?= htmlspecialchars($item['codigo_item']) ?></td>
                                                    <td><?= htmlspecialchars($item['descripcion']) ?></td>
                                                    <td><?= htmlspecialchars($item['unidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['cantidad']) ?></td>
                                                    <td><?= htmlspecialchars($item['no_piezas']) ?></td>
                                                    <td><?= htmlspecialchars($item['tarifa']) ?></td>
                                                    <td class="subtotal"></td>

                                                </tr>
                                                <?php 
                }
            } else {
                echo '<tr><td colspan="8" class="text-center">No hay materiales registrados</td></tr>';
            }
            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                    </p>
                                </div>



                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const secciones = {
                                        'materiales': '1. MATERIALES',
                                        'ingenieria': '2. INGENIERIA',
                                        'pruebas': '3. PRUEBAS NO DESTRUCTIVAS',
                                        'consumibles': '4. CONSUMIBLES',
                                        'transporte': '5. TRANSPORTE',
                                        'mano-obra': '6. MANO DE OBRA',
                                        'hidrostatica': '7. PRUEBA HIDROSTATICA',
                                        'pintura': '8. PINTURA MANO DE OBRA'
                                    };

                                    function calcularTotales() {
                                        let totalGeneral = 0;

                                        // Calcular por cada sección
                                        Object.entries(secciones).forEach(([key, nombreSeccion]) => {
                                            let totalSeccion = 0;

                                            document.querySelectorAll(`#tabla-${key} tbody tr`).forEach(
                                                row => {
                                                    const cantidad = parseFloat(row.dataset
                                                        .cantidad) || 0;
                                                    const piezas = parseFloat(row.dataset.piezas) ||
                                                        0;
                                                    const tarifa = parseFloat(row.dataset.tarifa) ||
                                                        0;
                                                    const subtotal = cantidad * piezas * tarifa;

                                                    row.querySelector('.subtotal').textContent =
                                                        subtotal.toFixed(2);
                                                    totalSeccion += subtotal;
                                                });

                                            // Actualizar total de sección
                                            document.querySelector(`#total-${key}`).textContent =
                                                totalSeccion.toFixed(2);
                                            totalGeneral += totalSeccion;
                                        });

                                        // Calcular totales finales
                                        const aiu = totalGeneral * 0.3;
                                        const totalFinal = totalGeneral + aiu;

                                        document.querySelector('#total-directos').textContent = totalGeneral
                                            .toFixed(2);
                                        document.querySelector('#aiu').textContent = aiu.toFixed(2);
                                        document.querySelector('#total-final').textContent = totalFinal.toFixed(
                                            2);
                                    }

                                    // Actualizar IDs de tablas en PHP
                                    <?php 
    $seccionesIds = [
        'materiales' => '1. MATERIALES',
        'ingenieria' => '2. INGENIERIA',
        'pruebas' => '3. PRUEBAS NO DESTRUCTIVAS',
        'consumibles' => '4. CONSUMIBLES',
        'transporte' => '5. TRANSPORTE',
        'mano-obra' => '6. MANO DE OBRA',
        'hidrostatica' => '7. PRUEBA HIDROSTATICA',
        'pintura' => '8. PINTURA MANO DE OBRA'
    ];
    ?>

                                    // Inicializar cálculos
                                    calcularTotales();
                                });
                                </script>

                                <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Función de formato numérico personalizado
                                    const formatoNumerico = (valor) => {
                                        return new Intl.NumberFormat('es-ES', {
                                                style: 'decimal',
                                                minimumFractionDigits: 2,
                                                maximumFractionDigits: 2
                                            }).format(valor)
                                            .replace(/\./g, '|')
                                            .replace(/,/g, '.')
                                            .replace(/\|/g, ".");
                                    };

                                    // Función para formatear todos los números
                                    const aplicarFormato = (elementos) => {
                                        elementos.forEach(elemento => {
                                            const valor = parseFloat(elemento.textContent.replace(
                                                /[^\d.]/g, ''));
                                            if (!isNaN(valor)) {
                                                elemento.textContent = formatoNumerico(valor);
                                            }
                                        });
                                    };

                                    // Calcular y formatear subtotales
                                    document.querySelectorAll('.subtotal').forEach(celda => {
                                        const cantidad = parseFloat(celda.closest('tr').dataset
                                            .cantidad) || 0;
                                        const piezas = parseFloat(celda.closest('tr').dataset.piezas) ||
                                            0;
                                        const tarifa = parseFloat(celda.closest('tr').dataset.tarifa) ||
                                            0;
                                        const subtotal = cantidad * piezas * tarifa;

                                        celda.textContent = formatoNumerico(subtotal);
                                    });

                                    // Formatear números en tablas
                                    document.querySelectorAll('td:not(.subtotal)').forEach(celda => {
                                        if (/^\d+\.?\d*$/.test(celda.textContent.trim())) {
                                            const valor = parseFloat(celda.textContent);
                                            celda.textContent = formatoNumerico(valor);
                                        }
                                    });

                                    // Formatear totales en la card
                                    const elementosTotal = document.querySelectorAll(
                                        '[id^="total-"], #aiu, #total-final');
                                    aplicarFormato(elementosTotal);
                                });
                                </script>





                                <div class="tab-pane" id="settings">
                                    <p>


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form action="action/export-ef.php" method="post">
                                                <div class="row">
                                                    <div class="mb-3">
                                                        <div class="bg-primary-subtle p-2 " style="text-align: center;">
                                                            <code class="link-primary">Descargar Estudio de Factivilidad: <?php echo $datos['codigo_estudio']?>.xlsx</code>
                                                        </div>

                                                        
                                                    </div>
                                                    <!-- Primera columna -->



                                                </div>

                                                <!-- Segunda columna -->
                                                <div class="col-lg-6">

                                                    <div class="mb-3">

                                                        <input type="hidden" name="id_estudio"
                                                            value="<?php echo $datos['id_estudio']?>" id="simpleinput"
                                                            class="form-control" style="text-align: center;">
                                                    </div>
                                                </div>

                                                <!-- Botón de envío -->
                                                <div class="mb-3 text-center">
                                                    <br><br><br>
                                                    <button type="submit" class="btn btn-soft-primary">Descargar</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>




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