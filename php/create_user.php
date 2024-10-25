<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id_user'];
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $id_rol = $_POST['id_rol'];
    $site = $_POST['site'];

    // Validación de campos obligatorios
    if (empty($id_user) || empty($name) || empty($last_name) || empty($id_rol) || empty($site)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos obligatorios.']);
        exit;
    }

    // Verificar si el ID de usuario o el correo ya existen
    $query = "SELECT * FROM users WHERE id_user = '$id_user' OR email = '$email'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $existing_users = [];
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['id_user'] === $id_user) {
                $existing_users[] = 'ID de usuario ya existente.';
            }
            if ($row['email'] === $email) {
                $existing_users[] = 'Correo ya existente.';
            }
        }
        echo json_encode(['success' => false, 'message' => implode(' ', $existing_users)]);
        exit;
    }

    // Inserción en la base de datos
    $query = "INSERT INTO users (id_user, name, last_name, email, password, id_rol, site)
              VALUES ('$id_user', '$name', '$last_name', '$email', '$password', '$id_rol', '$site')";
    if (mysqli_query($conn, $query)) {
        // URL de redirección al crear el usuario
        $redirect_url = '/r&d/html/users/user_list.php'; // Cambia esto a la URL deseada
        echo json_encode(['success' => true, 'message' => 'Usuario creado exitosamente.', 'redirect' => $redirect_url]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . mysqli_error($conn)]);
    }
    mysqli_close($conn);
}
?>
