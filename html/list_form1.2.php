<?php
// Conectar a la base de datos
include '../php/db_connection.php';

// Consulta para obtener las cotizaciones
$sql = "SELECT id, id_user, id_client, status_form1, project_name FROM form1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Formularios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Formularios de Cotización</h1>
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Proyecto</th>
                    <th>Cliente</th>
                    <th>Usuario</th>
                    <th>Estatus</th>
                    <th>Acciones</th> <!-- Columna para el botón -->
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Mostrar datos de cada fila
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['project_name'] . "</td>";
                        echo "<td>" . $row['id_client'] . "</td>";
                        echo "<td>" . $row['id_user'] . "</td>";
                        echo "<td>" . $row['status_form1'] . "</td>";
                        echo "<td><a href='ver_formulario_completo.php?id=" . $row['id'] . "' class='btn btn-primary'>Ver completo</a></td>"; // Botón para ver el formulario completo
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No hay formularios creados</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
