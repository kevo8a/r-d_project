<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: login.php");
    exit();
}

// Obtener los datos del usuario de la sesión
$user_id = $_SESSION['user_id'];
$name = $_SESSION['user_name'];
$last_name = $_SESSION['user_last_name'];
?>
