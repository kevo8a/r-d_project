<?php
include 'db_connection.php';
include 'auth.php';

// Obtener ID del registro a editar
$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['success' => false, 'message' => 'ID no válido.']);
    exit();
}

// Obtener datos del registro
$sql = "SELECT * FROM form2 WHERE id = ?";
$stmt = $conn->prepare($sql);
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedData = [];

    // Procesar cada fila y guardar los datos actualizados
    $counter = 1;
    while (isset($_POST["MTL$counter"])) {
        $updatedData[] = [
            "MTL"      => $_POST["MTL$counter"],
            "Material" => $_POST["Material$counter"],
            "Calibre"  => $_POST["Calibre$counter"],
            "Peso"     => $_POST["Peso$counter"],
            "Solidos"  => $_POST["Solidos$counter"]
        ];
        $counter++;
    }

    $jsonData = json_encode($updatedData);

    // Recoger valores de los pasos
    $steps = [];
    for ($step = 1; $step <= 6; $step++) {
        $steps["step_$step"] = $_POST["proceso$step"] ?? ''; // Recoger valores de los pasos
    }
    $status = 'En Proceso'; // Establecer el estado como 'En Proceso'

    // Actualizar en la base de datos usando prepared statement
    $sql = "UPDATE form2 SET 
            table_content = , status_form2 =?, step_1 =?, 
            step_2        =?, step_3       =?, step_4 =?, 
            step_5        =?, step_6       =? 
            WHERE id =?";
    $stmt = $conn->prepare($sql);

    // Asegúrate de que la variable $jsonData tiene los datos correctos para la columna `table_content`
    // Asegúrate de que $id tiene el valor correcto para identificar el registro a actualizar
    $stmt->bind_param("ssssssssi", 
    $jsonData, $status, $steps['step_1'], 
    $steps['step_2'], $steps['step_3'], $steps['step_4'], 
    $steps['step_5'], $steps['step_6'], 
    $id);

    // Responder al cliente con JSON
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

    // Devolver la respuesta en formato JSON
    echo json_encode($response);
    exit();
}
?>
