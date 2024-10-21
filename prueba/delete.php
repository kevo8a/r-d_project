<?php
// Incluir la conexión a la base de datos
include '../php/db_connection.php';
include '../php/auth.php';

// Verificar si se proporcionó un ID
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Eliminar el cliente de la base de datos
    $sql = "DELETE FROM client WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Cliente eliminado exitosamente.";
    } else {
        echo "Error al eliminar el cliente: " . mysqli_error($conn);
    }
} else {
    echo "ID no proporcionado.";
}

// Cerrar la conexión
mysqli_close($conn);
?>
