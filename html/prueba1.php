<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Seleccionar Cliente</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="cliente" class="form-label">Cliente</label>
                    <select class="form-control" id="cliente" name="cliente" required>
                        <option value="" disabled selected>Selecciona un cliente</option>

                        <?php
                        // Habilitar la visualización de errores
                        error_reporting(E_ALL);
                        ini_set('display_errors', 1);

                        // Incluir el archivo de conexión a la base de datos
                        require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

                        // Intentar obtener los clientes
                        $sql = "SELECT name FROM client";
                        $result = mysqli_query($conn, $sql); // Cambié $mysqli a $conn

                        // Verificar si la consulta fue exitosa
                        if (!$result) {
                            echo '<option value="" disabled>Error en la consulta: ' . mysqli_error($conn) . '</option>'; // Cambié $mysqli a $conn
                        } else {
                            // Comprobar si hay resultados
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>No se encontraron clientes</option>';
                            }
                        }

                        // Cerrar la conexión
                        mysqli_close($conn); // Cambié $mysqli a $conn
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
