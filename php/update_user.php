<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user   = $_POST['id_user'];
    $name      = $_POST['name'];
    $last_name = $_POST['last_name'];
    $email     = $_POST['email'] ; // Asumiendo que siempre se concatena el dominio
    $password  = $_POST['password'];
    $id_rol    = $_POST['id_rol'];
    $site      = $_POST['site'];

    // Validación de campos obligatorios
    if (empty($id_user) || empty($name) || empty($last_name) || empty($id_rol) || empty($site)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos obligatorios.']);
        exit;
    }

    // Comprobar si el correo ya existe y no pertenece al mismo usuario
    $query = "SELECT * FROM users WHERE email = '$email' AND id_user != '$id_user'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Correo ya existente.']);
        exit;
    }

    // Si se proporciona una nueva contraseña, actualizarla
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET
                name     ='$name'           , last_name ='$last_name', email='$email', 
                password ='$hashed_password', id_rol    ='$id_rol'   , site ='$site' 
        WHERE   id_user  ='$id_user'"       ;
    } else {
        // No se actualiza la contraseña
        $query = "UPDATE users SET 
                name='$name'    , last_name='$last_name', email='$email', 
                id_rol='$id_rol', site='$site' 
        WHERE id_user='$id_user'";
    }

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true, 'message' => 'Usuario actualizado exitosamente.', 'redirect' => '/r&d/html/users/user_list.php']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el usuario.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
}
?>
