<?php
include '../php/db_connection.php';

$id = $_GET['id'];
$sql = "SELECT table_content FROM form2 WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $content = json_decode($row['table_content'], true);
} else {
    echo "Registro no encontrado";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Editar registro</title>
</head>
<body>
    <h2>Editar registro</h2>
    <form action="update.php?id=<?php echo $id; ?>" method="post">
        <input type="text" name="name" value="<?php echo htmlspecialchars($content['name']); ?>" required><br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($content['age']); ?>" required><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($content['email']); ?>" required><br>
        <input type="text" name="address" value="<?php echo htmlspecialchars($content['address']); ?>" required><br>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($content['phone']); ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedData = [
        "name" => $_POST['name'],
        "age" => (int)$_POST['age'],
        "email" => $_POST['email'],
        "address" => $_POST['address'],
        "phone" => $_POST['phone']
    ];

    $jsonData = json_encode($updatedData);

    $sql = "UPDATE form2 SET table_content = :table_content WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':table_content', $jsonData);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al actualizar el registro";
    }
}
?>
