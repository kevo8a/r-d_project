<?php
include '../php/db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD con JSON en PHP</title>
</head>
<body>
    <h2>Crear nuevo registro</h2>
    <form action="create.php" method="post">
        <input type="text" name="name" placeholder="Nombre" required><br>
        <input type="number" name="age" placeholder="Edad" required><br>
        <input type="email" name="email" placeholder="Correo electrónico" required><br>
        <input type="text" name="address" placeholder="Dirección" required><br>
        <input type="text" name="phone" placeholder="Teléfono" required><br>
        <button type="submit">Crear</button>
    </form>

    <h2>Lista de registros</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Edad</th>
            <th>Email</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Acciones</th>
        </tr>
        <?php
        $sql = "SELECT id, table_content FROM form2";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $content = json_decode($row['table_content'], true);
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . htmlspecialchars($content['name']) . "</td>";
            echo "<td>" . htmlspecialchars($content['age']) . "</td>";
            echo "<td>" . htmlspecialchars($content['email']) . "</td>";
            echo "<td>" . htmlspecialchars($content['address']) . "</td>";
            echo "<td>" . htmlspecialchars($content['phone']) . "</td>";
            echo "<td>
                    <a href='update.php?id=" . $row['id'] . "'>Editar</a> | 
                    <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"¿Estás seguro?\");'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
