<?php
include 'db_connection.php';
include 'auth.php';

// Obtener ID del registro a editar
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    echo json_encode(['success' => false, 'message' => 'ID no válido.']);
    exit();
}

// Obtener datos del registro
$sql = "SELECT * FROM form4 WHERE id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta: ' . $conn->error]);
    exit();
}

$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    echo json_encode(['success' => false, 'message' => 'Registro no encontrado.']);
    exit();
}

$data = json_decode($row['table_content'], true); // Decodificar JSON a un array

// Guardar cambios del formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $updatedData = [];

    // Procesar cada fila y guardar los datos actualizados
    $counter = 1;
    while (isset($_POST["feature$counter"])) {
        $updatedData[] = [
            "feature"  => htmlspecialchars($_POST["feature$counter"]),
            "unit"     => htmlspecialchars($_POST["unit$counter"]),
            "value"    => htmlspecialchars($_POST["value$counter"]),
            "tolerance"=> htmlspecialchars($_POST["tolerance$counter"]),
            "notes"    => htmlspecialchars($_POST["notes$counter"])
        ];
        $counter++;
    }
    $status              = 'Corregir';
    $created_at          = date("y-m-d H:i:s");
    $project_name        = isset($_POST['project_name'])        ? $_POST['project_name']        : '';
    $type_project        = isset($_POST['type_project'])        ? $_POST['type_project']        : '';
    $start_plant         = isset($_POST['start_plant'])         ? $_POST['start_plant']         : '';
    $end_plant           = isset($_POST['end_plant'])           ? $_POST['end_plant']           : '';
    $task_ray            = isset($_POST['task_ray'])            ? $_POST['task_ray']            : '';
    $shipping_type       = isset($_POST['shipping_type'])       ? $_POST['shipping_type']       : '';
    $procces_type        = isset($_POST['procces_type'])        ? $_POST['procces_type']        : '';
    $n_task              = isset($_POST['n_task'])              ? $_POST['n_task']              : '';
    $TCH                 = isset($_POST['TCH'])                 ? $_POST['TCH']                 : '';
    $printing_system     = isset($_POST['printing_system'])     ? $_POST['printing_system']     : '';
    $printing_type       = isset($_POST['printing_type'])       ? $_POST['printing_type']       : '';
    $num_colors          = isset($_POST['num_colors'])          ? $_POST['num_colors']          : '';
    $photocell_colors    = isset($_POST['photocell_colors'])    ? $_POST['photocell_colors']    : '';
    $jsonData            = json_encode($updatedData)                                                ;
    $spot_width          = isset($_POST['spot_width'])          ? $_POST['spot_width']          : '';
    $spot_length         = isset($_POST['spot_length'])         ? $_POST['spot_length']         : '';
    $repeat_cm           = isset($_POST['repeat_cm'])           ? $_POST['repeat_cm']           : '';
    $accumulative_repeat = isset($_POST['accumulative_repeat']) ? $_POST['accumulative_repeat'] : '';
    $actual_repeat       = isset($_POST['actual_repeat'])       ? $_POST['actual_repeat']       : '';
    $photographic_rep    = isset($_POST['photographic_rep'])    ? $_POST['photographic_rep']    : '';
    $cylinder_sleeve     = isset($_POST['cylinder_sleeve'])     ? $_POST['cylinder_sleeve']     : '';
    $n_repetitions       = isset($_POST['n_repetitions'])       ? $_POST['n_repetitions']       : '';
    $n_reels             = isset($_POST['n_reels'])             ? $_POST['n_reels']             : '';
    $cut_line            = isset($_POST['cut_line'])            ? $_POST['cut_line']            : '';
    $spot_color          = isset($_POST['spot_color'])          ? $_POST['spot_color']          : '';
    $area                = isset($_POST['area'])                ? $_POST['area']                : '';
    $print_m2            = isset($_POST['print_m2'])            ? $_POST['print_m2']            : '';
    $print_linear        = isset($_POST['print_linear'])        ? $_POST['print_linear']        : '';
    $description         = isset($_POST['description'])         ? $_POST['description']         : '';
    $description_art     = isset($_POST['description_art'])     ? $_POST['description_art']     : '';
    $specs               = isset($_POST['specs'])               ? $_POST['specs']               : '';
    $comments            = isset($_POST['comments'])            ? $_POST['comments']            : '';

    // Actualizar en la base de datos usando prepared statement
    $sql = "UPDATE form4 SET 
            status_form4     =?, created_at          =?, project_name     =?,
            type_project     =?, start_plant         =?, end_plant        =?, 
            task_ray         =?, shipping_type       =?, procces_type     =?, 
            n_task           =?, TCH                 =?, printing_system  =?, 
            printing_type    =?, num_colors          =?, photocell_colors =?, 
            table_content    =?, spot_width          =?, spot_length      =?,
            repeat_cm        =?, accumulative_repeat =?, actual_repeat    =?,
            photographic_rep =?, cylinder_sleeve     =?, n_repetitions    =?, 
            n_reels          =?, cut_line            =?, spot_color       =?,
            area             =?, print_m2            =?, print_linear     =?,
            description      =?, description_art     =?, specs            =?,
            comments         =?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de actualización: ' . $conn->error]);
        exit();
    }

    // Vincular parámetros (ajustar los tipos según las columnas de la base de datos)
    $stmt->bind_param("sssssssssisssissiiiiiiiiiisiiissssi", 
            $status           , $created_at          , $project_name    , 
            $type_project     , $start_plant         , $end_plant       , 
            $task_ray         , $shipping_type       , $procces_type    , 
            $n_task           , $TCH                 , $printing_system ,
            $printing_type    , $num_colors          , $photocell_colors,
            $jsonData         , $spot_width          , $spot_length     , 
            $repeat_cm        , $accumulative_repeat , $actual_repeat   ,
            $photographic_rep , $cylinder_sleeve     , $n_repetitions   , 
            $n_reels          , $cut_line            , $spot_color      ,
            $area             , $print_m2            , $print_linear    ,
            $description      , $description_art     , $specs           ,
            $comments         , 
            $id
    );

    $response = [];
    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Registro actualizado correctamente.';
    } else {
        $response['success'] = false;
        $response['message'] = 'Error al actualizar el registro: ' . $stmt->error;
    }

    // Cerrar el statement
    $stmt->close();

    // Cerrar la conexión
    $conn->close();

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
    exit();
}
?>