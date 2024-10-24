<?php
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

// Procesar los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos desde el formulario
    $id_user = $_POST['id_user'] ?? '';
    $name = $_POST['name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['id_rol'] ?? '';
    $site = $_POST['site'] ?? '';

    // Validar datos obligatorios
    $errors = [];

    if (empty($id_user)) {
        $errors[] = "El campo 'ID Usuario' es obligatorio.";
    }
    if (empty($name)) {
        $errors[] = "El campo 'Nombre' es obligatorio.";
    }
    if (empty($last_name)) {
        $errors[] = "El campo 'Apellido' es obligatorio.";
    }
    if (empty($email)) {
        $errors[] = "El campo 'Email' es obligatorio.";
    }
    if (empty($rol)) {
        $errors[] = "El campo 'Rol' es obligatorio.";
    }
    if (empty($site)) {
        $errors[] = "El campo 'Sitio' es obligatorio.";
    }

    // Si hay errores, mostrar el mensaje de error y salir
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        exit;
    }

    // Verificar si se está editando un usuario existente
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user'");
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Se está editando
        $user_data = mysqli_fetch_assoc($result);
        
        // Si la contraseña está vacía, no se actualiza
        if (!empty($password)) {
            // Encriptar la nueva contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // Preparar la declaración SQL para la actualización
            $stmt = mysqli_prepare($conn, "
                UPDATE users 
                SET name = ?, last_name = ?, email = ?, password = ?, id_rol = ?, site = ?
                WHERE id_user = ?
            ");
            mysqli_stmt_bind_param($stmt, "ssssisi", $name, $last_name, $email, $hashed_password, $rol, $site, $id_user);
        } else {
            // Preparar la declaración SQL para la actualización sin cambiar la contraseña
            $stmt = mysqli_prepare($conn, "
                UPDATE users 
                SET name = ?, last_name = ?, email = ?, id_rol = ?, site = ?
                WHERE id_user = ?
            ");
            // Corregir el tipo de datos, eliminando un parámetro de contraseña
            mysqli_stmt_bind_param($stmt, "sssisi", $name, $last_name, $email, $rol, $site, $id_user);
        }
    } else {
        // Se está creando un nuevo usuario
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($conn, "
            INSERT INTO users (id_user, name, last_name, email, password, id_rol, site)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        mysqli_stmt_bind_param($stmt, "issssis", $id_user, $name, $last_name, $email, $hashed_password, $rol, $site);
    }

    // Ejecutar la declaración
    if (mysqli_stmt_execute($stmt)) {
        // Redirigir a una ruta después de guardar correctamente
        header("Location: ../html/users/user_list.php");  // Cambia 'ruta_deseada.php' a la ruta que prefieras
        exit(); // Asegúrate de terminar el script después de redirigir
    } else {
        echo "Error al guardar los datos: " . mysqli_stmt_error($stmt);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
