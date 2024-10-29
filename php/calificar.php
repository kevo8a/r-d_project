<?php
include 'db_connection.php';
include 'auth.php';

// Obtener el contenido JSON de la solicitud
$data = json_decode(file_get_contents("php://input"));

// Validar los datos recibidos
if (isset($data->opcion) && isset($data->id)) {
    $opcion = $data->opcion;
    $id = $data->id;
    $qualified_by = $name; // Suponiendo que $name contiene el nombre del usuario que califica

    // Dependiendo de la opción seleccionada, actualiza el estado del formulario y almacena la fecha actual
    switch ($opcion) {
        case 'Aprobar':
            $sql = "UPDATE form1 SET status_form1='Complete', qualified_by=?, created_at=NOW() WHERE id=?";
            break;
        case 'Corregir':
            $sql = "UPDATE form1 SET status_form1='Corregir', qualified_by=?, created_at=NOW() WHERE id=?";
            break;
        case 'Rechazar':
            $sql = "UPDATE form1 SET status_form1='Rechazado', qualified_by=?, created_at=NOW() WHERE id=?";
            break;
        default:
            echo json_encode(['message' => 'Opción no válida']);
            exit();
    }

    // Preparar y ejecutar la consulta
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("si", $qualified_by, $id);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'Calificación registrada correctamente']);
        } else {
            echo json_encode(['message' => 'Error al actualizar el estado']);
        }
        $stmt->close();
    } else {
        echo json_encode(['message' => 'Error en la preparación de la consulta']);
    }
} else {
    echo json_encode(['message' => 'Datos no válidos']);
}

$conn->close();
?>
