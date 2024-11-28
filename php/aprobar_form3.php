<?php
include '../php/db_connection.php';
include 'auth.php';

$qualified_by = $name . ' ' . $last_name. ' ' . $user_id;
$response = array();

// Verificar si se recibió un ID de formulario para transferir
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Recuperar los datos de form3 usando el ID
    $sql = "SELECT * FROM form3 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result->num_rows > 0) {
        $form3_data = $result->fetch_assoc();

        // Asignar valores para la inserción en form4
        $id_form4          = $form3_data['id_form3'];
        $id_user           = $form3_data['id_user'];
        $table_content     = 
        '[{"feature":"Gramaje"                               ,"unit":"g/m2"                  ,"value":"","tolerance":"","notes":""},
          {"feature":"Calibre"                               ,"unit":"micras"                ,"value":"","tolerance":"","notes":""},
          {"feature":"COF ext/ext"                           ,"unit":"-"                     ,"value":"","tolerance":"","notes":""},
          {"feature":"COF int/int"                           ,"unit":"-"                     ,"value":"","tolerance":"","notes":""},
          {"feature":"FUERZA DE SELLADO "                    ,"unit":"g/25 mm"               ,"value":"","tolerance":"","notes":""},
          {"feature":"FUERZA DE ADHERENCIA 1ra lam"          ,"unit":"g/25 mm"               ,"value":"","tolerance":"","notes":""},
          {"feature":"FUERZA DE ADHERENCIA 2da Lam"          ,"unit":"g/25 mm"               ,"value":"","tolerance":"","notes":""},
          {"feature":"SOLVENTES  RETENIDOS"                  ,"unit":"mg/m2"                 ,"value":"","tolerance":"","notes":""},
          {"feature":"DUREZA"                                ,"unit":"kN"                    ,"value":"","tolerance":"","notes":""},
          {"feature":"RESISTENCIA TERMICA(180°C-1 SEG-40PSI)","unit":"-"                     ,"value":"","tolerance":"","notes":""},
          {"feature":"CHOQUE TÉRMICO"                        ,"unit":"-"                     ,"value":"","tolerance":"","notes":""},
          {"feature":"TRANSMISION DE VAPOR DE AGUA"          ,"unit":"g / m2 día"            ,"value":"","tolerance":"","notes":""},
          {"feature":"TRANSMISION DE OXIGENO"                ,"unit":"cc / m2 día"           ,"value":"","tolerance":"","notes":""},
          {"feature":"Resistencia al ROCE-tinta "            ,"unit":"Ciclos, peso, probetas","value":"","tolerance":"","notes":""}]';  // Representación JSON 
        $name_user         = $form3_data['name_user'];
        $site_user         = $form3_data['site_user'];
        $name_client       = $form3_data['name_client'];
        $project_name      = $form3_data['project_name'];
        $status_form4      = 'Nuevo';  // Estado inicial en form4
        $created_at        = date("y-m-d H:i");
        $sistema_impresion = $form3_data['printing_system'];

        // Insertar en form4
        $sql4 = "INSERT INTO form4 (
                id_form4       , status_form4 , id_user      , 
                created_at     , table_content, name_user    , 
                site_user      , name_client  , project_name ,
                printing_system
                ) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt4 = mysqli_prepare($conn, $sql4);
        mysqli_stmt_bind_param($stmt4, "ssisssssss",
                $id_form4         , $status_form4 , $id_user     , 
                $created_at       , $table_content, $name_user   , 
                $site_user        , $name_client  , $project_name,
                $sistema_impresion
            );

        if (mysqli_stmt_execute($stmt4)) {
            $response["status"] = "success";
            $response["message"] = "Nuevo registro creado exitosamente en form4.";
        } else {
            $response = array("status" => "error", "message" => "Error al insertar en form4: " . mysqli_stmt_error($stmt4));
        }
        mysqli_stmt_close($stmt4);

        // Actualizar el estado de form3 a "Complete"
        $sql3 = "UPDATE form3 SET status_form3 = ?, qualified_by = ?, completed_at = ? WHERE id = ?";
        $stmt3 = mysqli_prepare($conn, $sql3);

        if ($stmt3) {
            $status_form3 = 'Complete';

            mysqli_stmt_bind_param($stmt3, "sssi", $status_form3, $qualified_by, $created_at, $id);

            if (mysqli_stmt_execute($stmt3)) {
                $response["status"]   = "success";
                $response["message"] .= " Formulario de form3 actualizado a 'Complete'.";
            } else {
                $response["status"]   = "error";
                $response["message"]  = "Error al actualizar form3: " . mysqli_stmt_error($stmt3);
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