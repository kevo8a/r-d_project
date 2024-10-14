<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir el archivo de conexión a la base de datos
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Obtener los clientes
$sql = "SELECT name FROM client";
$result = $mysqli->query($sql);

$clients = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row['name'];
    }
}

// Devolver los clientes como JSON
header('Content-Type: application/json');
echo json_encode($clients);

$mysqli->close();
?>
