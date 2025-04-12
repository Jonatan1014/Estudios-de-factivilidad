<?php
// Conectar a la base de datos
$conn = mysqli_connect('localhost', 'root', '', 'libroqr');

if ($conn->connect_error) {
    echo "Error al conectar a la base de datos";
    exit;
}

// Si se recibe el término de búsqueda, usarlo para filtrar, si no, mostrar todos los libros
$fruta = isset($_POST['fruta']) ? mysqli_real_escape_string($conn, $_POST['fruta']) : '';

// Consulta SQL dinámica basada en si se ingresa un término de búsqueda
$query = "SELECT * FROM libros";

if (!empty($fruta)) {
    $query .= " WHERE titulo LIKE '%$fruta%' OR autor LIKE '%$fruta%' OR isbn LIKE '%$fruta%'";
}

$result = $conn->query($query);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    while ($book = $result->fetch_assoc()) {
        if ($book['estado'] == 'Disponible') {
            echo '<div class="col-12 col-sm-6 col-md-6 col-lg-3 mb-4">';
            echo '    <div class="card h-100 d-flex flex-column">';
            
            // Parte superior de la tarjeta (título y autor con ubicación)
            echo '        <div class="card-body">';
            echo '            <h5 class="card-title">' . htmlspecialchars($book['titulo']) . '</h5>';
            echo '            <div class="d-flex justify-content-between align-items-center">';
            echo '                <h6 class="card-subtitle text-muted mb-0">' . htmlspecialchars($book['autor']) . '</h6>';
            echo '                <span class="text-muted">' . htmlspecialchars($book['ubicacion']) . '</span>'; // Asegúrate de que la ubicación está disponible en $book
            echo '            </div>';
            echo '        </div>';
            
            // Imagen QR centrada
            echo '        <div class="d-flex justify-content-center">';
            echo '            <img class="img-fluid" src="data:image/jpeg;base64,' . base64_encode($book["qr_code"]) . '" alt="Código QR de ' . htmlspecialchars($book['titulo']) . '" style="width: 150px; height: 150px;">';
            echo '        </div>';
            
            // Parte inferior con resumen y botón
            echo '        <div class="card-body mt-auto">';
            echo '            <form action="details-book.php" method="POST">';
            echo '                <input type="hidden" name="idLibro" value="' . htmlspecialchars($book['idLibro']) . '">';
            echo '                <button type="submit" class="btn btn-primary w-100">Más Información</button>';
            echo '            </form>';
            echo '        </div>';  // Fin del cuerpo de la tarjeta
            
            echo '    </div>';  // Fin de la tarjeta
            echo '</div>';  // Fin de la columna
            
        }
    }
} else {
    echo '<div class="col-12">';
    echo '    <div class="alert alert-warning">No se encontraron resultados.</div>';
    echo '</div>';
}

// Cerrar la conexión
$conn->close();
?>