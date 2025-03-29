<?php
if (isset($_POST['loan'])) {
    $loan = $_POST['loan'];
    $conn = new mysqli('localhost', 'root', '', 'libroqr');

    if ($conn->connect_error) {
        echo 'Error de conexión';
        exit();
    }

    $sql = "SELECT libros.titulo, libros.isbn, usuarios.name, usuarios.carrera, prestamos.fecha_vencimiento, prestamos.idLibro, libros.ubicacion
            FROM prestamos
            INNER JOIN libros ON prestamos.idLibro = libros.idLibro
            INNER JOIN usuarios ON prestamos.idUser = usuarios.idUser
            WHERE libros.titulo LIKE ? 
            OR libros.isbn LIKE ? 
            OR usuarios.name LIKE ?";

    $stmt = $conn->prepare($sql);

    $likeTerm = '%' . $loan . '%';
    $stmt->bind_param('sss', $likeTerm, $likeTerm , $likeTerm);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
<div class="col-md-4">
    <div class="card border-primary border">
        <div class="card-body">
            <h5 class="card-title text-primary" style="text-align: center;">
                <?php echo htmlspecialchars($row["titulo"]); ?>
            </h5>
            <div class="d-flex justify-content-between align-items-center">

                <h7 class="card-title text-body-emphasis">
                    ISBN: <?php echo htmlspecialchars($row["isbn"]); ?>
                </h7>
                <span class="text-muted" > <?php echo htmlspecialchars($row['ubicacion']) ?> </span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p class="card-text mb-0"><?php echo htmlspecialchars($row["name"]); ?></p>
                <p class="card-text mb-0"><?php echo htmlspecialchars($row["carrera"]); ?></p>
            </div>
            <br>
            <div class="d-flex justify-content-between align-items-center">
                <!-- Botón para abrir el toast de confirmación -->
                <button class="btn btn-primary btn-sm"
                    onclick="confirmarDevolucion(<?php echo htmlspecialchars($row['idLibro']); ?>)">
                    Regresar libro
                </button>
                <div style="text-align: right;">
                    <?php echo htmlspecialchars($row["fecha_vencimiento"]); ?>
                </div>
            </div>
        </div> <!-- end card-body-->
    </div> <!-- end card-->
</div> <!-- end col-->

<!-- Toast de confirmación para devolver el libro -->

<div class="toast bg-primary hide p-2" id="toast-<?php echo htmlspecialchars($row['idLibro']); ?>" role="alert"
    aria-live="assertive" aria-atomic="true" style="max-width: 150%; ">
    <div class="toast-body text-white" style="font-size: 0.9rem;">
        ¿Seguro que quieres devolver el libro?
        <div class="mt-1 pt-1 border-top">
            <form action="action/register_loan-return.php" method="post" class="d-inline">
                <input type="hidden" name="idLibro" value="<?php echo htmlspecialchars($row['idLibro']); ?>">
                <button type="submit" class="btn btn-light btn-sm px-2">Confirmar</button>
            </form>
            <button type="button" class="btn btn-secondary btn-sm px-2" data-bs-dismiss="toast">Cancelar</button>
        </div>
    </div>
</div>

<?php
        }
    } else {
        echo '<div class="alert alert-warning">No se encontraron resultados.</div>';
    }

    $stmt->close();
    $conn->close();
}
?>