<?php
// Iniciar la sesión
session_start();
date_default_timezone_set('America/Mexico_City');

// Definir tiempo máximo de inactividad (en segundos)
$inactive = 1800; // 30 minutos

// Comprobar si la sesión ha estado inactiva
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactive) {
    // Si el tiempo de inactividad ha superado el límite, cerrar la sesión
    session_unset();     // Elimina todas las variables de sesión
    session_destroy();   // Destruye la sesión
    header("Location: /r&d/html/login.php"); // Redirigir al login
    exit();
}

// Actualizar el tiempo de actividad
$_SESSION['last_activity'] = time();

// Verificar si el usuario está logueado
if (!isset($_SESSION['user_id'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está logueado
    header("Location: /r&d/html/login.php");
    exit();
}

// Regenerar la ID de la sesión para evitar ataques de fijación de sesión
session_regenerate_id(true);

// Obtener los datos del usuario de la sesión
$user_id   = $_SESSION['user_id'];
$name      = htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8');
$last_name = htmlspecialchars($_SESSION['user_last_name'], ENT_QUOTES, 'UTF-8');
$site      = htmlspecialchars($_SESSION['site'], ENT_QUOTES, 'UTF-8');
$role      = $_SESSION['id_rol'] ?? null; // Si no está definido, será null

// Validar el rol del usuario (si lo necesitas para accesos específicos)
if ($role === null) {
//     // Si el rol no está definido, redirigir o manejar de alguna forma
     header("Location: /r&d/html/access_denied.php");
     exit();
}

?>