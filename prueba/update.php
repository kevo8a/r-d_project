<?php
session_start();
require '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    // Obtener la ruta del archivo anterior antes de eliminarlo
    $sql = "SELECT * FROM form1 WHERE id_form1 = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();

    // Verificar si el archivo anterior existe y eliminarlo
    if ($file) {
        $rutaAnterior = $file['file_rute'];
        if (file_exists($rutaAnterior)) {
            unlink($rutaAnterior); // Eliminar el archivo anterior
        }

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $nombreArchivo = uniqid() . '-' . basename($_FILES['file']['name']);
            $rutaArchivo = 'r&d/files/' . $nombreArchivo;

            // Mover el nuevo archivo
            if (move_uploaded_file($_FILES['file']['tmp_name'], $rutaArchivo)) {
                $sql = "UPDATE form1 SET file_rute = ?, file_name = ? WHERE id_form1 = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('ssi', $rutaArchivo, $nombreArchivo, $id);
                $stmt->execute();

                echo "Archivo actualizado con éxito.";
            } else {
                echo "Error al mover el nuevo archivo.";
            }
        } else {
            echo "Error al subir el nuevo archivo.";
        }
    } else {
        echo "Archivo no encontrado para la actualización.";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM form1 WHERE id_form1 = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Archivo</title>
</head>
<body>
    <h1>Actualizar Archivo</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $file['id_form1']; ?>">
        <input type="file" name="file" required>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
