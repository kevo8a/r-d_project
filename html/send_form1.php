<?php   
session_start();
require '../php/db_connection.php';

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_form1 = uniqid('form1_');
    $solicitante = $_POST['solicitante'] ?? '';
    $id_user = $_POST['id_user'] ?? '';
    $estatus = $_POST['estatus'] ?? '';
    
    // Validar datos obligatorios
    if (empty($id_user)) {
        echo "El campo id_user es obligatorio.";
        exit;
    }

    if (empty($estatus)) {
        echo "El campo estatus es obligatorio.";
        exit;
    }

    // Verificar que el id_user existe en la tabla users
    $result = $conn->query("SELECT * FROM users WHERE id_user = '$id_user'");
    if ($result->num_rows == 0) {
        echo "El id_user no existe en la tabla users.";
        exit;
    }

    // Preparar y vincular la declaración SQL
    $stmt = $conn->prepare("
        INSERT INTO form1 (
            id_form1, status_form1,
            id_user, name_user
        ) VALUES (?, ?, ?, ?)
    "); 

    $stmt->bind_param(
        "ssis", 
        $id_form1, $estatus,
        $id_user, $solicitante
    );

    // Ejecutar la declaración
    if ($stmt->execute()) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $conn->close();
}
?>
