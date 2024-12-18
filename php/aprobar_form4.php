<?php
include 'db_connection.php';
include 'auth.php';

$qualified_by = $name . ' ' . $last_name . ' ' . $user_id;
$response = array();

// Verificar si se recibió un ID de formulario para rechazar
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $completed_at = date("y-m-d H:i"); // Fecha y hora actual

    // Actualizar el estado de form1 a "Corregir"
    $sql = "UPDATE form4 SET status_form4 = ?, qualified_by = ?, completed_at = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        $status_form4 = 'Complete';

        // Asignar parámetros a la consulta
        mysqli_stmt_bind_param($stmt, "sssi", $status_form4, $qualified_by, $completed_at, $id);

        // Ejecutar consulta y verificar si fue exitosa
        if (mysqli_stmt_execute($stmt)) {
            $response["status"]  = "success";
            $response["message"] = "Formulario actualizado a 'Complete'.";
        } else {
            $response["status"]  = "error";
            $response["message"] = "Error al actualizar form2: " . mysqli_stmt_error($stmt);
        }

        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        $response["status"] = "error";
        $response["message"] = "Error al preparar la consulta.";
    }
} else {
    $response = array("status" => "error", "message" => "No se recibió el ID del formulario.");
}

// Enviar respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión
$conn->close();
?>
