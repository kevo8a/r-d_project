<?php
include 'db_connection.php';

$query = "SELECT * FROM form1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>
            <tr>
                <th>Ficha Técnica</th>
                <th>Muestra Física</th>
                <th>Plano Mecánico</th>
                <th>PDF Arte</th>
                <th>Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . ($row['technical_sheet'] ? 'Sí' : 'No') . "</td>
                <td>" . ($row['physical_sample'] ? 'Sí' : 'No') . "</td>
                <td>" . ($row['mechanical_plan'] ? 'Sí' : 'No') . "</td>
                <td>" . ($row['pdf_art'] ? 'Sí' : 'No') . "</td>
                <td>
                    <a href='update.php?id=" . $row['id'] . "'><button>Actualizar</button></a> <!-- Botón Update -->
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "No hay datos.";
}

mysqli_close($conn);
?>
