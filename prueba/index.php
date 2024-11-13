<?php
include '../php/db_connection.php';

// Guardar nuevo registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [];

    // Recorrer los datos enviados en el formulario
    for ($i = 1; isset($_POST["MTL$i"]); $i++) {
        $data[] = [
            "MTL" => $_POST["MTL$i"],
            "Material" => $_POST["Material$i"],
            "Calibre" => $_POST["Calibre$i"],
            "Peso" => $_POST["Peso$i"],
            "Solidos" => $_POST["Solidos$i"]
        ];
    }

    // Convertir el arreglo a JSON
    $jsonData = json_encode($data);

    // Insertar en la base de datos
    $sql = "INSERT INTO form2 (table_content) VALUES ('$jsonData')";
    $conn->query($sql);
}

// Leer registros
$sql = "SELECT * FROM form2";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD con JSON en PHP</title>
</head>
<body>
    <h1>Formulario Dinámico</h1>

    <form action="" method="POST" id="dynamicForm">
        <div id="inputFields">
            <div class="row">
                <label>MTL1: <input type="text" name="MTL1" required></label>
                <label>Material1: <input type="text" name="Material1" required></label>
                <label>Calibre1: <input type="text" name="Calibre1" required></label>
                <label>Peso1: <input type="text" name="Peso1" required></label>
                <label>Sólidos1: <input type="text" name="Solidos1" required></label>
            </div>
        </div>
        <button type="button" onclick="addRow()">Agregar Fila</button>
        <button type="submit">Guardar</button>
    </form>

    <h2>Registros Guardados</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Contenido</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['table_content']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <script>
        let counter = 2;
        function addRow() {
            const div = document.createElement('div');
            div.classList.add('row');
            div.innerHTML = `
                <label>MTL${counter}: <input type="text" name="MTL${counter}" required></label>
                <label>Material${counter}: <input type="text" name="Material${counter}" required></label>
                <label>Calibre${counter}: <input type="text" name="Calibre${counter}" required></label>
                <label>Peso${counter}: <input type="text" name="Peso${counter}" required></label>
                <label>Sólidos${counter}: <input type="text" name="Solidos${counter}" required></label>
            `;
            document.getElementById('inputFields').appendChild(div);
            counter++;
        }
    </script>
</body>
</html>
