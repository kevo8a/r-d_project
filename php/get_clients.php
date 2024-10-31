<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'db_connection.php';

header('Content-Type: application/json');

$sql = "SELECT name FROM client";
$result = $mysqli->query($sql);

$clients = [];

if (!$result) {
    echo json_encode(['error' => 'Error en la consulta: ' . $mysqli->error]);
    exit;
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row['name'];
    }
}

echo json_encode($clients);

$mysqli->close();
?>
