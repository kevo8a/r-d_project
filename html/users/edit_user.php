<?php 
include '../../php/db_connection.php';
include '../../php/auth.php';

// Asegúrate de que se pase el ID de usuario a editar
if (!isset($_GET['id_user'])) {
    die('ID de usuario no proporcionado.');
}

$id_user = $_GET['id_user'];

// Obtener los detalles del usuario
$query = "SELECT * FROM users WHERE id_user = '$id_user'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    die('Usuario no encontrado.');
}

$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Editar Usuario</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include '../structure/navbar.php'; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Editar Usuario</h1>

                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                    <form id="form-edit" action="../../php/update_user.php" method="POST">
                        <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                        <div class="row">
                            <!-- Nombre -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                                </div>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user['last_name']; ?>" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" name="email" value="<?php echo substr($user['email'], 0, strpos($user['email'], '@')); ?>" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Password (opcional) -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña (dejar en blanco para no cambiar)</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="id_rol" class="form-label">Rol</label>
                                    <select class="form-control" id="id_rol" name="id_rol" required>
                                        <option value="1" <?php echo $user['id_rol'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?php echo $user['id_rol'] == 2 ? 'selected' : ''; ?>>Approver</option>
                                        <option value="3" <?php echo $user['id_rol'] == 3 ? 'selected' : ''; ?>>Basic</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Site -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="site" class="form-label">Site</label>
                                    <select class="form-control" id="site" name="site" required>
                                        <option value="tlaquepaque" <?php echo $user['site'] == 'tlaquepaque' ? 'selected' : ''; ?>>Tlaquepaque</option>
                                        <option value="zacapu" <?php echo $user['site'] == 'zacapu' ? 'selected' : ''; ?>>Zacapu</option>
                                        <option value="tultitlan" <?php echo $user['site'] == 'tultitlan' ? 'selected' : ''; ?>>Tultitlán</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button id="submit-btn" type="submit" class="btn btn-primary">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>
    <script>
$(document).ready(function() {
    $('#form-edit').on('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario
        $('#error-message').hide(); // Oculta el mensaje anterior

        // Obtener el valor del correo electrónico
        var username = $('#email').val().trim(); // Quita espacios al inicio y al final

        // Verifica si el correo ya tiene el dominio
        if (username && !username.endsWith('@amcor.com')) {
            username += '@amcor.com'; // Solo agregar el dominio si no está presente
        }

        $('#email').val(username); // Actualiza el campo de correo con el valor completo

        $.ajax({
            url: $(this).attr('action'), // Acción del formulario
            type: $(this).attr('method'), // Método del formulario
            data: $(this).serialize(), // Serializa los datos del formulario
            dataType: 'json', // Espera un JSON como respuesta
            success: function(response) {
                console.log(response); // Log para depuración
                if (response.success) {
                    console.log('Usuario actualizado exitosamente.'); // Log para confirmar éxito
                    $('#error-message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                    setTimeout(function() {
                        window.location.href = response.redirect; // Redirige
                    }, 2000); // Tiempo de espera antes de redirigir
                } else {
                    console.log('Error al actualizar usuario:', response.message); // Log para errores
                    $('#error-message').removeClass('alert-success').addClass('alert-danger').text(response.message).show();
                }
            },
            error: function() {
                $('#error-message').removeClass('alert-success').addClass('alert-danger').text('Ocurrió un error en la comunicación con el servidor.').show();
            }
        });
    });
});

    </script>
</body>
</html>
