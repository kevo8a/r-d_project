<?php
include '../php/db_connection.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Incluye tus encabezados y estilos aquí -->
</head>
<body>
    <h2>Crear nuevo registro</h2>
    <form action="create.php" method="post">
        <div>
            <label for="solicitadoPor">Solicitado por:</label>
            <input type="text" name="solicitadoPor" id="solicitadoPor" required>
        </div>
        <div>
            <label for="cliente">Cliente:</label>
            <input type="text" name="cliente" id="cliente" required>
        </div>
        <div>
            <label for="nombreProyecto">Nombre del proyecto:</label>
            <input type="text" name="nombreProyecto" id="nombreProyecto" required>
        </div>

        <h3>Materiales</h3>
        <table id="materialTable">
            <tr>
                <td><input type="text" name="material[mtl][]" required></td>
                <td><input type="text" name="material[material][]" required></td>
                <td><input type="number" name="material[calibre][]" required></td>
                <td><input type="number" name="material[peso][]" required></td>
                <td><input type="number" name="material[solidos][]" required></td>
            </tr>
        </table>

        <h3>Procesos</h3>
        <div>
            <label for="proceso1">Paso 1:</label>
            <input type="text" name="proceso[proceso1]" required>
        </div>
        <div>
            <label for="proceso2">Paso 2:</label>
            <input type="text" name="proceso[proceso2]" required>
        </div>
        <!-- Agrega más pasos si es necesario -->

        <button type="submit">Guardar</button>
    </form>
</body>
</html>
