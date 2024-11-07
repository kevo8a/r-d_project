<?php
include '../../php/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $solicitadoPor = $_POST['solicitadoPor'];
    $cliente = $_POST['cliente'];
    $nombreProyecto = $_POST['nombreProyecto'];

    $materialData = json_encode($_POST['material']);  // Los datos del material se envían como JSON
    $procesoData = json_encode($_POST['proceso']);  // Los pasos se envían como JSON

    $sql = "INSERT INTO form2 (solicitado_por, cliente, nombre_proyecto, material_data, proceso_data) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $solicitadoPor, $cliente, $nombreProyecto, $materialData, $procesoData);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al guardar los datos.";
    }
}
?>
