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
    $project_name = 
    $jsonData     = json_encode($updatedData);
    // Recoger valores de los pasos
    $status       = 'En Proceso'; // Establecer el estado como 'En Proceso'
    $created_at   = date("y-m-d H:i:s");
    $project_name = 

    // Actualizar en la base de datos usando prepared statement
    $sql = "UPDATE form4 SET 
            table_content = ?
            WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Error al preparar la consulta de actualización: ' . $conn->error]);
        exit();
    }

    // Vincular parámetros (ajustar los tipos según las columnas de la base de datos)
    $stmt->bind_param(
        "si", 
        $jsonData    ,
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