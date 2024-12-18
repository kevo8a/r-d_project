<?php
include 'db_connection.php';
include 'auth.php';

// Verificar conexión a la base de datos
if (!$conn) {
    die(json_encode(array("status" => "error", "message" => "Error en la conexión a la base de datos.")));
}

// Datos del usuario calificador
$qualified_by = $name . ' ' . $last_name . ' ' . $user_id;
$response = array();

// Verificar si se recibió un ID y una calificación
if (isset($_POST['id']) && isset($_POST['calificacion'])) {
    $id           = intval($_POST['id']); // Asegurar que el ID sea un entero
    $calificacion = $_POST['calificacion'];
    $completed_at = date("y-m-d H:i"); // Fecha y hora actual

    // Verificar que la calificación sea "Aprobar"
    if ($calificacion === 'Aprobar') {
        // Recuperar los datos de form2 usando el ID
        $sql_form2 = "SELECT * FROM form2 WHERE id = ?";
        $stmt_form2 = mysqli_prepare($conn, $sql_form2);
        mysqli_stmt_bind_param($stmt_form2, "i", $id);
        mysqli_stmt_execute($stmt_form2);
        $result_form2 = mysqli_stmt_get_result($stmt_form2);

        if ($result_form2->num_rows > 0) {
            $form2_data = $result_form2->fetch_assoc();

            // Recuperar datos de form1 usando el id_form1
            $id_form1 = $form2_data['id_form2']; // Asumiendo que form2 tiene una referencia a form1
            $sql_form1 = "SELECT * FROM form1 WHERE id_form1 = ?";
            $stmt_form1 = mysqli_prepare($conn, $sql_form1);
            mysqli_stmt_bind_param($stmt_form1, "i", $id_form1);
            mysqli_stmt_execute($stmt_form1);
            $result_form1 = mysqli_stmt_get_result($stmt_form1);

            if ($result_form1->num_rows > 0) {
                $form1_data = $result_form1->fetch_assoc();
                
        
                // Asignar valores para la inserción en form3
                $id_form3          = $form2_data['id_form2']; // Asegúrate de que el ID en form3 sea correcto
                $status_form3      = 'Nuevo';  // Estado inicial en form3
                $id_user           = $form2_data['id_user'];
                $name_user         = $form2_data['name_user'];
                $created_at        = date("y-m-d H:i");
                $site_user         = $form2_data['site_user'];
                $name_client       = $form2_data['name_client'];
                $project_name      = $form2_data['project_name'];
                $volumen_pedido    = $form1_data['volume_per_order'];
                $sales_unit        = $form1_data['sales_unit'];
                $sistema_impresion = $form1_data['printing_system'];
                
    
                // Insertar en form3
                $sql2 = "INSERT INTO form3 (
                        id_form3       , status_form3   , id_user      , 
                        name_user      , created_at     , site_user    , 
                        name_client    , project_name   , requested_qty, 
                        requested_units, printing_system

                        ) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt2 = mysqli_prepare($conn, $sql2);
                mysqli_stmt_bind_param($stmt2, "ssisssssiss", 
                        $id_form3      , $status_form3     , $id_user       , 
                        $name_user     , $created_at       , $site_user     , 
                        $name_client   , $project_name     , $volumen_pedido, 
                        $sales_unit    , $sistema_impresion
                    );
    
                // Ejecución de la inserción en form3
                if (mysqli_stmt_execute($stmt2)) {
                    $response["status"]  = "success";
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
                    mysqli_stmt_bind_param($stmt_update, "sssi", 
                            $status_form2, $qualified_by, $completed_at, 
                            $id
                        );
    
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
            mysqli_stmt_close($stmt_form1);
        } else {
            $response = array("status" => "error", "message" => "No se encontró el formulario con el ID: $id");
        }
        mysqli_stmt_close($stmt_form2);
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