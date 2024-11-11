<?php
include 'db_connection.php';  // Incluye la conexión a la base de datos

// Obtener el contenido JSON de la solicitud AJAX
$data = json_decode(file_get_contents("php://input"));

// Validar los datos recibidos
if (isset($data->opcion) && isset($data->id)) {
    $opcion = $data->opcion;
    $id = $data->id;
    $qualified_by = $name; // Suponiendo que $name contiene el nombre del usuario que califica

    switch ($opcion) {
        case 'Aprobar':
            // Obtener los datos de form1
            $sql = "SELECT id_form1, solicitante, id_user, estatus, cliente, site, nombre_proyecto FROM form1 WHERE id_form1 = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->bind_result($id_form1, $solicitante, $id_user, $estatus, $cliente, $site, $nombre_proyecto);
            $stmt->fetch();

            if ($id_form1) {
                // Actualizar el estado del formulario en form1
                $sql_update = "UPDATE form1 SET estatus='Aprobado', qualified_by=?, created_at=NOW() WHERE id_form1=?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("si", $qualified_by, $id);
                if ($stmt_update->execute()) {
                    // Insertar en form2
                    $stmt_insert = $conn->prepare("INSERT INTO form2 (id_form1, solicitante, id_user, estatus, cliente, site, nombre_proyecto, created_at) 
                                                   VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
                    $stmt_insert->bind_param("issssss", $id_form1, $solicitante, $id_user, $estatus, $cliente, $site, $nombre_proyecto);
                    if ($stmt_insert->execute()) {
                        echo json_encode(['message' => 'Formulario aprobado y datos transferidos a form2.']);
                    } else {
                        echo json_encode(['message' => 'Error al insertar en form2.']);
                    }
                    $stmt_insert->close();
                } else {
                    echo json_encode(['message' => 'Error al actualizar el estado en form1.']);
                }
                $stmt_update->close();
            } else {
                echo json_encode(['message' => 'Formulario no encontrado.']);
            }
            $stmt->close();
            break;
        case 'Corregir':
        case 'Rechazar':
            // Lógica similar para los casos de Corregir y Rechazar
            $status = ($opcion === 'Corregir') ? 'Corregir' : 'Rechazado';
            $sql_update = "UPDATE form1 SET estatus=?, qualified_by=?, created_at=NOW() WHERE id_form1=?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ssi", $status, $qualified_by, $id);
            if ($stmt_update->execute()) {
                echo json_encode(['message' => 'Formulario ' . $status . ' correctamente.']);
            } else {
                echo json_encode(['message' => 'Error al actualizar el estado en form1.']);
            }
            $stmt_update->close();
            break;
        default:
            echo json_encode(['message' => 'Opción no válida']);
            exit();
    }
} else {
    echo json_encode(['message' => 'Datos no válidos']);
}

$conn->close();
?>
