<?php
session_start();
require '../php/db_connection.php'; // Asegúrate de que la ruta sea correcta

header('Content-Type: application/json'); // Indica que la respuesta es JSON

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
    if (empty($id_user)) { $errors[] = "El campo 'ID Usuario' es obligatorio."; }
    if (empty($name)) { $errors[] = "El campo 'Nombre' es obligatorio."; }
    if (empty($last_name)) { $errors[] = "El campo 'Apellido' es obligatorio."; }
    if (empty($email)) { $errors[] = "El campo 'Email' es obligatorio."; }
    if (empty($rol)) { $errors[] = "El campo 'Rol' es obligatorio."; }
    if (empty($site)) { $errors[] = "El campo 'Sitio' es obligatorio."; }

    // Si hay errores, retornar error en JSON
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'message' => implode(", ", $errors)]);
        exit;
    }

    // Verificar si se está editando un usuario existente
    $existing_user_query = "SELECT * FROM users WHERE id_user = '$id_user' LIMIT 1";
    $result = mysqli_query($conn, $existing_user_query);
    $is_editing = ($result && mysqli_num_rows($result) > 0);

    // Verificar ID de usuario
    if ($is_editing) {
        // Para la edición, verificar si el correo electrónico está en uso por otro usuario
        $email_check_query = "SELECT * FROM users WHERE email = '$email' AND id_user != '$id_user' LIMIT 1";
        $email_result = mysqli_query($conn, $email_check_query);
        if ($email_result && mysqli_num_rows($email_result) > 0) {
            echo json_encode(['success' => false, 'message' => "El correo electrónico ya está en uso."]);
            exit;
        }
    } else {
        // Para la creación, verificar si el ID de usuario ya existe
        $id_check_query = "SELECT * FROM users WHERE id_user = '$id_user' LIMIT 1";
        $result = mysqli_query($conn, $id_check_query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo json_encode(['success' => false, 'message' => "El ID de usuario ya está en uso."]);
            exit;
        }

        // Verificar si el correo electrónico ya existe
        $email_check_query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $result = mysqli_query($conn, $email_check_query);
        if ($result && mysqli_num_rows($result) > 0) {
            echo json_encode(['success' => false, 'message' => "El correo electrónico ya está en uso."]);
            exit;
        }
    }

    // Preparar la declaración SQL para crear o editar el usuario
    if ($is_editing) {
        // Se está editando
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, "
                UPDATE users 
                SET name = ?, last_name = ?, email = ?, password = ?, id_rol = ?, site = ?
                WHERE id_user = ?
            ");
            mysqli_stmt_bind_param($stmt, "ssssisi", $name, $last_name, $email, $hashed_password, $rol, $site, $id_user);
        } else {
            $stmt = mysqli_prepare($conn, "
                UPDATE users 
                SET name = ?, last_name = ?, email = ?, id_rol = ?, site = ?
                WHERE id_user = ?
            ");
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
        echo json_encode(['success' => true]); // Respuesta de éxito
    } else {
        echo json_encode(['success' => false, 'message' => "Error al guardar los datos: " . mysqli_stmt_error($stmt)]);
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
