<?php
$conn = mysqli_connect('localhost', 'root', 'Balon100.', 't4ll3r3s');

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}



// Configuración de paginación
$registros_por_pagina = 30;
$pagina_actual = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
$pagina_actual = max(1, $pagina_actual); // Asegurar que sea al menos 1
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Recibir y sanitizar filtros
$filtros = [
    'fecha_inicio' => isset($_POST['fecha_inicio']) ? mysqli_real_escape_string($conn, $_POST['fecha_inicio']) : (isset($_GET['fecha_inicio']) ? mysqli_real_escape_string($conn, $_GET['fecha_inicio']) : ''),
    'fecha_fin' => isset($_POST['fecha_fin']) ? mysqli_real_escape_string($conn, $_POST['fecha_fin']) : (isset($_GET['fecha_fin']) ? mysqli_real_escape_string($conn, $_GET['fecha_fin']) : ''),
    'codigo_proyecto' => isset($_POST['codigo_proyecto']) ? mysqli_real_escape_string($conn, $_POST['codigo_proyecto']) : (isset($_GET['codigo_proyecto']) ? mysqli_real_escape_string($conn, $_GET['codigo_proyecto']) : ''),
    'cliente' => isset($_POST['cliente']) ? mysqli_real_escape_string($conn, $_POST['cliente']) : (isset($_GET['cliente']) ? mysqli_real_escape_string($conn, $_GET['cliente']) : ''),
    'alcance' => isset($_POST['alcance']) ? mysqli_real_escape_string($conn, $_POST['alcance']) : (isset($_GET['alcance']) ? mysqli_real_escape_string($conn, $_GET['alcance']) : ''),
    'dimensiones' => isset($_POST['dimensiones']) ? mysqli_real_escape_string($conn, $_POST['dimensiones']) : (isset($_GET['dimensiones']) ? mysqli_real_escape_string($conn, $_GET['dimensiones']) : ''),
    'tipo' => isset($_POST['tipo']) ? mysqli_real_escape_string($conn, $_POST['tipo']) : (isset($_GET['tipo']) ? mysqli_real_escape_string($conn, $_GET['tipo']) : ''),
    'anio' => isset($_POST['anio']) ? mysqli_real_escape_string($conn, $_POST['anio']) : (isset($_GET['anio']) ? mysqli_real_escape_string($conn, $_GET['anio']) : '')
];

// Construir consulta SQL base
$whereClause = "WHERE 1=1";

// Aplicar filtros
if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
    $whereClause .= " AND fecha_estudio BETWEEN '{$filtros['fecha_inicio']}' AND '{$filtros['fecha_fin']}'";
}

if (!empty($filtros['codigo_proyecto'])) {
    $whereClause .= " AND codigo_estudio LIKE '%{$filtros['codigo_proyecto']}%'";
}

if (!empty($filtros['cliente'])) {
    $whereClause .= " AND cliente LIKE '%{$filtros['cliente']}%'";
}

if (!empty($filtros['alcance'])) {
    $whereClause .= " AND alcance LIKE '%{$filtros['alcance']}%'";
}


// Nuevo filtro por año
if (!empty($filtros['anio'])) {
    $whereClause .= " AND YEAR(fecha_estudio) = '{$filtros['anio']}'";
}


// Para AJAX - Primero contar total de registros
$countQuery = "SELECT COUNT(*) as total FROM estudios_factibilidad " . $whereClause;
$countResult = $conn->query($countQuery);
$totalCount = 0;

if ($countResult) {
    $countRow = $countResult->fetch_assoc();
    $totalCount = $countRow['total'];
}

// Calcular número total de páginas
$total_paginas = ceil($totalCount / $registros_por_pagina);

// Consulta principal con LIMIT para paginación
$query = "SELECT * FROM estudios_factibilidad " . $whereClause . " ORDER BY fecha_estudio DESC LIMIT $offset, $registros_por_pagina";
$result = $conn->query($query);

// Crear array de respuesta
$response = array(
    'count' => $totalCount,
    'html' => '',
    'filters' => $filtros,
    'pagina_actual' => $pagina_actual,
    'total_paginas' => $total_paginas,
    'registros_por_pagina' => $registros_por_pagina
);

if ($result->num_rows > 0) {
    $html = '<div class="col-12">';
    $html .= '<div class="table-responsive">';
    $html .= '<table class="table table-hover table-centered mb-0">';
    $html .= '<thead class="table-light">';
    $html .= '<tr>';
    $html .= '<th>#</th>';
    $html .= '<th>Fecha</th>';
    $html .= '<th>Código</th>';
    $html .= '<th>Cliente</th>';
    $html .= '<th>Alcance</th>';
    $html .= '<th class="text-center">Acciones</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    
    $contador = $offset + 1;
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td>' . $contador++ . '</td>';
        $html .= '<td>' . date('d/m/Y', strtotime($row['fecha_estudio'])) . '</td>';
        $html .= '<td><span class="badge bg-secondary fs-6">' . htmlspecialchars($row['codigo_estudio']) . '</span></td>';
        $html .= '<td>' . htmlspecialchars($row['cliente']) . '</td>';
        $html .= '<td>' . htmlspecialchars(substr($row['alcance'], 0, 60)) . (strlen($row['alcance']) > 60 ? '...' : '') . '</td>';
        $html .= '<td class="text-center">';
        $html .= '<div class="btn-group" role="group">';
        
        // Botón Ver Detalles
        // $html .= '<form action="details-book.php" method="POST" style="display: inline;">';
        // $html .= '<input type="hidden" name="id_estudio" value="' . $row['id_estudio'] . '">';
        // $html .= '<button type="submit" class="btn btn-sm btn-primary" title="Ver Detalles">';
        // $html .= '<i class="mdi mdi-eye"></i>';
        // $html .= '</button>';
        // $html .= '</form>';
        
        // Botón Previsualizar
        $html .= '<button type="button" class="btn btn-sm btn-info ms-1" onclick="previsualizar(' . $row['id_estudio'] . ')" title="Previsualizar">';
        $html .= '<i class="mdi mdi-eye"></i>';
        $html .= '</button>';
        
        $html .= '</div>';
        $html .= '</td>';
        $html .= '</tr>';
        
        // Datos para el modal (ocultos)
        $html .= '<script type="text/template" id="data-' . $row['id_estudio'] . '">';
        $html .= json_encode([
            'codigo' => $row['codigo_estudio'],
            'cliente' => $row['cliente'],
            'fecha' => date('d/m/Y', strtotime($row['fecha_estudio'])),
            'alcance' => $row['alcance'],
            'dimensiones' => $row['dimensiones'],
            'tipo' => $row['tipo']
        ]);
        $html .= '</script>';
    }
    
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    
    // Agregar controles de paginación
    if ($total_paginas > 1) {
        $html .= '<div class="row mt-3">';
        $html .= '<div class="col-sm-12 col-md-5">';
        $html .= '<div class="dataTables_info">';
        $inicio = $offset + 1;
        $fin = min($offset + $registros_por_pagina, $totalCount);
        $html .= "Mostrando $inicio a $fin de $totalCount registros";
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="col-sm-12 col-md-7">';
        $html .= '<nav aria-label="Paginación de resultados">';
        $html .= '<ul class="pagination justify-content-end mb-0">';
        
        // Botón Primera página
        $html .= '<li class="page-item ' . ($pagina_actual == 1 ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="#" onclick="cambiarPagina(1); return false;" aria-label="Primera">';
        $html .= '<i class="mdi mdi-chevron-double-left"></i>';
        $html .= '</a>';
        $html .= '</li>';
        
        // Botón Anterior
        $html .= '<li class="page-item ' . ($pagina_actual == 1 ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="#" onclick="cambiarPagina(' . ($pagina_actual - 1) . '); return false;" aria-label="Anterior">';
        $html .= '<i class="mdi mdi-chevron-left"></i>';
        $html .= '</a>';
        $html .= '</li>';
        
        // Números de página
        $rango = 2; // Páginas a mostrar a cada lado de la actual
        $inicio_pag = max(1, $pagina_actual - $rango);
        $fin_pag = min($total_paginas, $pagina_actual + $rango);
        
        if ($inicio_pag > 1) {
            $html .= '<li class="page-item"><a class="page-link" href="#" onclick="cambiarPagina(1); return false;">1</a></li>';
            if ($inicio_pag > 2) {
                $html .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
        }
        
        for ($i = $inicio_pag; $i <= $fin_pag; $i++) {
            $html .= '<li class="page-item ' . ($i == $pagina_actual ? 'active' : '') . '">';
            $html .= '<a class="page-link" href="#" onclick="cambiarPagina(' . $i . '); return false;">' . $i . '</a>';
            $html .= '</li>';
        }
        
        if ($fin_pag < $total_paginas) {
            if ($fin_pag < $total_paginas - 1) {
                $html .= '<li class="page-item disabled"><a class="page-link">...</a></li>';
            }
            $html .= '<li class="page-item"><a class="page-link" href="#" onclick="cambiarPagina(' . $total_paginas . '); return false;">' . $total_paginas . '</a></li>';
        }
        
        // Botón Siguiente
        $html .= '<li class="page-item ' . ($pagina_actual == $total_paginas ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="#" onclick="cambiarPagina(' . ($pagina_actual + 1) . '); return false;" aria-label="Siguiente">';
        $html .= '<i class="mdi mdi-chevron-right"></i>';
        $html .= '</a>';
        $html .= '</li>';
        
        // Botón Última página
        $html .= '<li class="page-item ' . ($pagina_actual == $total_paginas ? 'disabled' : '') . '">';
        $html .= '<a class="page-link" href="#" onclick="cambiarPagina(' . $total_paginas . '); return false;" aria-label="Última">';
        $html .= '<i class="mdi mdi-chevron-double-right"></i>';
        $html .= '</a>';
        $html .= '</li>';
        
        $html .= '</ul>';
        $html .= '</nav>';
        $html .= '</div>';
        $html .= '</div>';
    }
    
    $html .= '</div>';
    
    $response['html'] = $html;
} else {
    $response['html'] = '<div class="col-12"><div class="alert alert-warning">No se encontraron resultados</div></div>';
}

// Enviar respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>