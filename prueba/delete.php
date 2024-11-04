<?php
session_start();
require '../php/db_connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener la ruta del archivo antes de eliminarlo de la base de datos
    $sql = "SELECT * FROM form1 WHERE id_form1 = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $file = $result->fetch_assoc();

    // Eliminar el archivo del sistema de archivos
    if ($file) {
        unlink($file['file_rute']); // Eliminar el archivo
        $sql = "DELETE FROM form1 WHERE id_form1 = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        
        echo "Archivo eliminado con éxito.";
    } else {
        echo "Archivo no encontrado.";
    }
} else {
    echo "ID no especificado.";
}
?>
