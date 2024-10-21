<?php
session_start(); // Iniciar la sesión
session_destroy(); // Destruir todas las sesiones

// Redirigir al usuario a la página de inicio de sesión
header("Location:/r&d/html/login.php"); // Cambia 'login.php' por la ruta correcta a tu página de login
exit();
?>
