<?php
include '../php/db_connection.php';
include 'auth.php';

$qualified_by = $name; // Nombre del usuario de 'auth.php'
$response = array();

// Verificar si se recibió un ID de formulario para transferir
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Recuperar los datos de form1 usando el ID
    $sql = "SELECT * FROM form1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $form1_data = $result->fetch_assoc();

        // Asignar valores para la inserción en form2
        $id_form2 = $form1_data['id_form1'];
        $id_user = $form1_data['id_user'];
        $table_content = '{}';  // Representación JSON vacía
        $name_user = $form1_data['name_user'];
        $site_user = $form1_data['site_user'];
        $name_client = $form1_data['name_client'];
        $project_name = $form1_data['project_name'];
        $status_form2 = 'Nuevo';  // Estado inicial en form2
        $created_at = date("Y-m-d H:i:s");

        // Insertar en form2
        $sql2 = "INSERT INTO form2 (id_form2, status_form2, id_user, created_at, table_content, name_user, site_user, name_client, project_name) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($conn, $sql2);
        mysqli_stmt_bind_param($stmt2, "ssissssss", $id_form2, $status_form2, $id_user, $created_at, $table_content, $name_user, $site_user, $name_client, $project_name);

        if (mysqli_stmt_execute($stmt2)) {
            $response["status"] = "success";
            $response["message"] = "Nuevo registro creado exitosamente en form2.";
        } else {
            $response = array("status" => "error", "message" => "Error al insertar en form2: " . mysqli_stmt_error($stmt2));
        }
        mysqli_stmt_close($stmt2);

        // Actualizar el estado de form1 a "Complete"
        $sql3 = "UPDATE form1 SET status_form1 = ?, qualified_by = ?, created_at = NOW() WHERE id = ?";
        $stmt3 = mysqli_prepare($conn, $sql3);

        if ($stmt3) {
            $status_form1 = 'Complete';

            mysqli_stmt_bind_param($stmt3, "ssi", $status_form1, $qualified_by, $id);

            if (mysqli_stmt_execute($stmt3)) {
                $response["status"] = "success";
                $response["message"] .= " Formulario de form1 actualizado a 'Complete'.";
            } else {
                $response["status"] = "error";
                $response["message"] = "Error al actualizar form1: " . mysqli_stmt_error($stmt3);
            }
            mysqli_stmt_close($stmt3);
        }
    } else {
        $response = array("status" => "error", "message" => "No se encontró el formulario con el ID: $id");
    }
    mysqli_stmt_close($stmt);
} else {
    $response = array("status" => "error", "message" => "No se recibió el ID del formulario.");
}

// Enviar respuesta en formato JSON
echo json_encode($response);
$conn->close();
?>
