<?php
include 'db_connection.php';
include 'auth.php';

$qualified_by = $name . ' ' . $last_name . ' ' . $user_id;
$response = array();

// Verificar si se recibió un ID y una calificación
if (isset($_POST['id']) && isset($_POST['calificacion'])) {
    $id = $_POST['id'];
    $calificacion = $_POST['calificacion'];
    $completed_at = date("Y-m-d H:i"); // Fecha y hora actual

    // Verificar que la calificación sea "Aprobar"
    if ($calificacion === 'Aprobar') {
        // Recuperar los datos de form2 usando el ID
        $sql = "SELECT * FROM form2 WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result->num_rows > 0) {
            $form2_data = $result->fetch_assoc();

            // Asignar valores para la inserción en form3
            $id_form3 = $form2_data['id_form2']; // Asegúrate de que el ID en form3 sea correcto
            $status_form3 = 'Nuevo';  // Estado inicial en form3
            $id_user = $form2_data['id_user'];
            $name_user = $form2_data['name_user'];
            $site_user = $form2_data['site_user'];
            $name_client = $form2_data['name_client'];
            $project_name = $form2_data['project_name'];
            $photocell_colors = json_encode([]);  // Si no tienes colores, puedes enviarlos como un array vacío JSON
            $created_at = date("Y-m-d H:i"); 
            // Insertar en form3
            $sql2 = "INSERT INTO form3 (id_form3, status_form3, id_user, name_user, created_at, site_user, name_client, project_name, photocell_colors) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $sql2);
            mysqli_stmt_bind_param($stmt2, "ssissssss", $id_form3, $status_form3, $id_user, $name_user,$created_at, $site_user, $name_client, $project_name, $photocell_colors);

            // Ejecución de la inserción en form3
            if (mysqli_stmt_execute($stmt2)) {
                $response["status"] = "success";
                $response["message"] = "Nuevo registro creado exitosamente en form3.";
            } else {
                $response = array("status" => "error", "message" => "Error al insertar en form3: " . mysqli_stmt_error($stmt2));
            }
            mysqli_stmt_close($stmt2);

            // Actualizar el estado de form2 a "Complete"
            $sql_update = "UPDATE form2 SET status_form2 = ?, qualified_by = ?, completed_at = ? WHERE id = ?";
            $stmt_update = mysqli_prepare($conn, $sql_update);

            if ($stmt_update) {
                $status_form2 = 'Complete';

                // Actualizar los datos en form2
                mysqli_stmt_bind_param($stmt_update, "sssi", $status_form2, $qualified_by, $completed_at, $id);

                if (mysqli_stmt_execute($stmt_update)) {
                    $response["status"] = "success";
                    $response["message"] .= " Formulario de form2 actualizado a 'Complete'.";
                } else {
                    $response["status"] = "error";
                    $response["message"] = "Error al actualizar form2: " . mysqli_stmt_error($stmt_update);
                }
                mysqli_stmt_close($stmt_update);
            }
        } else {
            $response = array("status" => "error", "message" => "No se encontró el formulario con el ID: $id");
        }
        mysqli_stmt_close($stmt);
    } else {
        $response = array("status" => "error", "message" => "Calificación no válida.");
    }
} else {
    $response = array("status" => "error", "message" => "No se recibió el ID o calificación.");
}

// Enviar respuesta en formato JSON
echo json_encode($response);

// Cerrar la conexión
$conn->close();
?>
