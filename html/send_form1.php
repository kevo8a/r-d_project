<?php   
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_form1 = uniqid('form1_');
    $solicitante = $_POST['solicitante'] ?? '';
    $id_user = $_POST['id_user'] ?? '';
    $estatus = $_POST['estatus'] ?? '';
    $cliente = $_POST['cliente'] ?? '';
    $nombre_proyecto = $_POST['nombre_proyecto'] ?? '';
    $numero_rfq = $_POST['numero_rfq'] ?? '';
    $formato_entrega = $_POST['formato_entrega'] ?? '';

    // Validar datos obligatorios
    if (empty($id_user)) {
        echo "El campo id_user es obligatorio.";
        exit;
    }

    // Verificar que el id_user existe en la tabla users
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user'");
    if (!$result || mysqli_num_rows($result) == 0) {
        echo "El id_user no existe en la tabla users.";
        exit;
    }

    // Preparar la declaración SQL
    $stmt = mysqli_prepare($conn, "
        INSERT INTO form1 (
            id_form1, status_form1,
            id_user, name_user,
            name_client, project_name,
            rfq_number, delivery_format
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    "); 

    // Vincular parámetros
    mysqli_stmt_bind_param(
        $stmt, 
        "ssisssis", 
        $id_form1, $estatus,
        $id_user, $solicitante,
        $cliente, $nombre_proyecto,
        $numero_rfq, $formato_entrega
    );

    // Ejecutar la declaración
    if (mysqli_stmt_execute($stmt)) {
        echo "Datos guardados correctamente.";
    } else {
        echo "Error al guardar los datos: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
