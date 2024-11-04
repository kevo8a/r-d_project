<?php
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_form1 = $_POST['id_form1'] ?? uniqid('FC'); // Usar el ID existente para actualización o generar uno nuevo
    $rutaArchivo = null;
    $nombreArchivo = null;

    // Manejo de archivo subido
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Configurar la ruta del archivo
        $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $nombreArchivo = $id_form1 . '.' . $extension; // Cambiar el nombre del archivo
        $rutaArchivo = 'r&d/files/' . $nombreArchivo;

        // Verificar si la carpeta existe, si no, crearla
        if (!file_exists('r&d/files')) {
            mkdir('r&d/files', 0777, true);
        }

        // Si se está actualizando, eliminar el archivo anterior
        if (isset($_POST['old_file']) && file_exists($_POST['old_file'])) {
            unlink($_POST['old_file']);
        }

        // Mover el archivo subido a la ruta especificada
        if (!move_uploaded_file($_FILES['file']['tmp_name'], $rutaArchivo)) {
            echo "Error al subir el archivo.";
            exit;
        }
    } else {
        // Captura el error específico
        switch ($_FILES['file']['error']) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                echo "El archivo es demasiado grande.";
                break;
            case UPLOAD_ERR_PARTIAL:
                echo "El archivo fue subido parcialmente.";
                break;
            case UPLOAD_ERR_NO_FILE:
                echo "No se seleccionó ningún archivo.";
                break;
            default:
                echo "Error al subir el archivo.";
                break;
        }
        exit;
    }

    // Preparar la declaración SQL para insertar el registro
    $stmt = mysqli_prepare($conn, "
        INSERT INTO form1 (id_form1, file_rute, file_name) VALUES (?, ?, ?)
    ");

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt,
        "sss", // Tipo de los parámetros
        $id_form1, $rutaArchivo, $nombreArchivo
    );

    // Ejecutar la declaración
    if (mysqli_stmt_execute($stmt)) {
        echo "success"; // Mensaje de éxito
    } else {
        echo "Error al guardar los datos: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Archivo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Cargar Archivo</h2>
        <form action="create.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_form1" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>"> <!-- Para edición -->
            <input type="hidden" name="old_file" value="<?php echo isset($_GET['file']) ? $_GET['file'] : ''; ?>"> <!-- Ruta del archivo anterior -->
            
            <div class="form-group">
                <label for="file">Seleccionar Archivo</label>
                <input type="file" class="form-control" name="file" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
