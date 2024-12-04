<?php
// Incluir el archivo de conexión a la base de datos
include 'db_connection.php';
session_start();

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Escapar las entradas para evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Consulta SQL para buscar el usuario en la tabla 'users'
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Usuario encontrado
        $user = $result->fetch_assoc();
        
        // Verificar si la contraseña coincide con el hash almacenado
        if (password_verify($password, $user['password'])) {
            // Contraseña correcta, iniciar sesión
            $_SESSION['user_id']        = $user['id_user'];
            $_SESSION['user_name']      = $user['name'];
            $_SESSION['user_last_name'] = $user['last_name'];
            $_SESSION['site']           = $user['site'];
            $_SESSION['id_rol']         = $user['id_rol'];

            // Responder con éxito
            echo json_encode(["success" => true]);
        } else {
            // Contraseña incorrecta
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta."]);
        }
    } else {
        // Usuario no encontrado
        echo json_encode(["success" => false, "message" => "Usuario no encontrado."]);
    }
}

$conn->close();
?>
