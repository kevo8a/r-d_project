<?php
require 'db_connection.php'; // Asegúrate de que la ruta sea correcta

$sql = "SELECT name FROM client";
$result = $mysqli->query($sql);

if (!$result) {
    echo "Error en la consulta: " . $mysqli->error;
} else {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['name'] . "<br>"; // Muestra los nombres de los clientes
        }
    } else {
        echo "No se encontraron clientes.";
    }
}

$mysqli->close();
?>
