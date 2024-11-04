<?php
session_start();
require '../php/db_connection.php';

$sql = "SELECT * FROM form1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h1>Lista de Archivos Subidos</h1>";
    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Nombre del Archivo</th>
                <th>Ruta del Archivo</th>
                <th>Acciones</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_form1']}</td>
                <td>{$row['file_name']}</td>
                <td>{$row['file_rute']}</td>
                <td>
                    <a href='update.php?id={$row['id_form1']}'>Actualizar</a>
                    <a href='delete.php?id={$row['id_form1']}'>Eliminar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No hay archivos subidos.";
}
?>
