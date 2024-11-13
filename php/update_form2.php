<?php
include 'db_connection.php';
include 'auth.php';

// Get ID from the URL
$id = $_GET['id'];

// Get the data for the form
$sql = "SELECT * FROM form2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$data = json_decode($row['table_content'], true); // Decode the JSON into an array

// Save changes from the form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedData = [];

    // Process each row and save updated data
    $counter = 1;
    while (isset($_POST["MTL$counter"])) {
        $updatedData[] = [
            "MTL" => $_POST["MTL$counter"],
            "Material" => $_POST["Material$counter"],
            "Calibre" => $_POST["Calibre$counter"],
            "Peso" => $_POST["Peso$counter"],
            "Solidos" => $_POST["Solidos$counter"]
        ];
        $counter++;
    }

    $jsonData = json_encode($updatedData);

    // Collect the process values
    $steps = [];
    for ($step = 1; $step <= 6; $step++) {
        $steps["step_$step"] = $_POST["proceso$step"] ?? ''; // Collect process values
    }
    $status = 'En Proceso';

    // Update in the database using prepared statement
    $sql = "UPDATE form2 SET table_content = ?, status_form2 = ?, step_1 = ?, step_2 = ?, step_3 = ?, step_4 = ?, step_5 = ?, step_6 = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $jsonData, $status, $steps['step_1'], $steps['step_2'], $steps['step_3'], $steps['step_4'], $steps['step_5'], $steps['step_6'], $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Registro actualizado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el registro: ' . $stmt->error]);
    }

    $stmt->close();
    exit();
}
?>
