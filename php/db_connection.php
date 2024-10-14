<?php
$host = "localhost";  // Servidor de la base de datos
$user = "root";       // Usuario de la base de datos (por defecto en XAMPP es root)
$password = "";       // Contraseña del usuario root (por defecto está vacía en XAMPP)
$database = "rnd_project";  // Nombre de la base de datos

// Crear la conexión
$conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>
