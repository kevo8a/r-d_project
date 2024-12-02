<?php
include 'db_connection.php';
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : null;
    $name = $_POST['name'] ?? '';
    $representative = $_POST['representative'] ?? '';
    $lada = $_POST['lada'] ?? '';
    $tel = $_POST['tel'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($id) {
        // Actualizar registro existente
        $sql = "UPDATE client SET name = ?, representative = ?, lada = ?, tel = ?, email = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssi', $name, $representative, $lada, $tel, $email, $id);
    } else {
        // Crear un nuevo registro
        $sql = "INSERT INTO client (name, representative, lada, tel, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssss', $name, $representative, $lada, $tel, $email);
    }

    if ($stmt && mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success', 'message' => 'Formulario procesado con éxito.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al procesar el formulario.']);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método de solicitud no válido.']);
}
