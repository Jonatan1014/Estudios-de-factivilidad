<?php
$conn = mysqli_connect('localhost', 'root', '', 't4ll3r3s');

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Recibir y sanitizar filtros
$filtros = [
    'fecha_inicio' => isset($_POST['fecha_inicio']) ? mysqli_real_escape_string($conn, $_POST['fecha_inicio']) : '',
    'fecha_fin' => isset($_POST['fecha_fin']) ? mysqli_real_escape_string($conn, $_POST['fecha_fin']) : '',
    'codigo_proyecto' => isset($_POST['codigo_proyecto']) ? mysqli_real_escape_string($conn, $_POST['codigo_proyecto']) : '',
    'cliente' => isset($_POST['cliente']) ? mysqli_real_escape_string($conn, $_POST['cliente']) : '',
    'alcance' => isset($_POST['alcance']) ? mysqli_real_escape_string($conn, $_POST['alcance']) : '',
    'dimensiones' => isset($_POST['dimensiones']) ? mysqli_real_escape_string($conn, $_POST['dimensiones']) : '',
    'tipo' => isset($_POST['tipo']) ? mysqli_real_escape_string($conn, $_POST['tipo']) : ''
];

// Construir consulta SQL
$query = "SELECT * FROM estudios_factibilidad WHERE 1=1";

// Aplicar filtros
if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
    $query .= " AND fecha_estudio BETWEEN '{$filtros['fecha_inicio']}' AND '{$filtros['fecha_fin']}'";
}

if (!empty($filtros['codigo_proyecto'])) {
    $query .= " AND codigo_estudio LIKE '%{$filtros['codigo_proyecto']}%'";
}

if (!empty($filtros['cliente'])) {
    $query .= " AND cliente LIKE '%{$filtros['cliente']}%'";
}

if (!empty($filtros['alcance'])) {
    $query .= " AND alcance LIKE '%{$filtros['alcance']}%'";
}

if (!empty($filtros['dimensiones'])) {
    $query .= " AND dimensiones LIKE '%{$filtros['dimensiones']}%'";
}

if (!empty($filtros['tipo'])) {
    $query .= " AND tipo LIKE '%{$filtros['tipo']}%'";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4">';
        echo '    <div class="card h-100">';
        echo '        <div class="card-body">';
        echo '            <h5 class="card-title">' . htmlspecialchars($row['cliente']) . '</h5>';
        echo '            <div class="d-flex justify-content-between align-items-center">';
        echo '                <h6 class="card-subtitle text-muted mb-0">' . htmlspecialchars($row['fecha_estudio']) . '</h6>';
        echo '                <span class="text-muted">' . htmlspecialchars($row['codigo_estudio']) . '</span>';
        echo '            </div>';
        echo '        </div>';
        
        echo '        <div class="card-footer">';
        echo '            <form action="details-book.php" method="POST">';
        echo '                <input type="hidden" name="id_estudio" value="' . $row['id_estudio'] . '">';
        echo '                <button type="submit" class="btn btn-primary w-100">Ver Detalles</button>';
        echo '            </form>';
        echo '        </div>';
        echo '    </div>';
        echo '</div>';
    }
} else {
    echo '<div class="col-12"><div class="alert alert-warning">No se encontraron resultados</div></div>';
}

$conn->close();
?>