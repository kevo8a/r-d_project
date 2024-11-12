<?php
include 'db_connection.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibe y decodifica el contenido de la tabla desde el POST
    $table_content = isset($_POST['table_content']) ? json_decode($_POST['table_content'], true) : [];

    // Codificar la tabla en formato JSON
    $table_content_json = json_encode($table_content);

    // Preparar la consulta SQL solo para la actualización de 'table_content'
    $sql = "UPDATE form2 SET table_content = ? WHERE id = ?";

    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Vincula los parámetros (solo table_content y id_formulario)
        mysqli_stmt_bind_param($stmt, 'si', $table_content_json, $_POST['id_formulario']);

        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(['status' => 'success', 'message' => 'Tabla actualizada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la tabla']);
        }

        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta']);
    }

    // Cierra la conexión
    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido']);
}
?>
