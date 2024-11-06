<?php
include '../php/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        "name" => $_POST['name'],
        "age" => (int)$_POST['age'],
        "email" => $_POST['email'],
        "address" => $_POST['address'],
        "phone" => $_POST['phone']
    ];

    $jsonData = json_encode($data);

    // Preparar la consulta con un marcador de posición ?
    $sql = "INSERT INTO form2 (table_content) VALUES (?)";
    $stmt = $conn->prepare($sql);

    // Vincular el parámetro con el marcador de posición
    $stmt->bind_param("s", $jsonData);

    // Ejecutar la consulta y redirigir si es exitosa
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error al crear el registro";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$conn->close();
?>
