<?php 
include '../../php/db_connection.php';
include '../../php/auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Crear Usuario</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include '../structure/sidebar.php'; ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include '../structure/navbar.php'; ?>

                <!-- Contenido -->
                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Crear Usuario</h1>

                    <!-- Contenedor para mensajes de error -->
                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>

                    <form id="form-cotizacion" action="../../php/create_user.php" method="POST">
                        <div class="row">
                            <!-- ID User -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario</label>
                                    <input type="number" class="form-control" id="id_user" name="id_user" required>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="email" name="email" placeholder="usuario" required>
                                        <span class="input-group-text">@amcor.com</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <!-- Verificar Contraseña -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="confirm_password" class="form-label">Verificar Contraseña</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                            </div>


                            <!-- Rol -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="id_rol" class="form-label">Rol</label>
                                    <select class="form-control" id="id_rol" name="id_rol" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="1">Admin</option>
                                        <option value="2">Approver</option>
                                        <option value="3">Basic</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Site -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="site" class="form-label">Site</label>
                                    <select class="form-control" id="site" name="site" required>
                                        <option value="">Seleccione un sitio</option>
                                        <option value="tlaquepaque">Tlaquepaque</option>
                                        <option value="zacapu">Zacapu</option>
                                        <option value="tultitlan">Tultitlán</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button id="submit-btn" type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
                <!-- End of Content -->
            </div>
            <!-- End of Main Content -->
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../js/sb-admin-2.min.js"></script>

    <script>
$(document).ready(function() {
    $('#form-cotizacion').on('submit', function(event) {
        event.preventDefault(); // Evita el envío normal del formulario
        $('#error-message').hide(); // Oculta el mensaje anterior

        // Obtener el nombre de usuario y concatenar con el dominio
        var username = $('#email').val();
        var email = username + '@amcor.com';
        $('#email').val(email); // Actualiza el campo de correo con el valor completo

        // Verificación de contraseñas
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();
        if (password !== confirmPassword) {
            $('#error-message').removeClass('alert-success').addClass('alert-danger').text('Las contraseñas no coinciden.').show();
            return; // Detiene el envío del formulario
        }

        $.ajax({
            url: $(this).attr('action'), // Acción del formulario
            type: $(this).attr('method'), // Método del formulario
            data: $(this).serialize(), // Serializa los datos del formulario
            dataType: 'json', // Espera un JSON como respuesta
            success: function(response) {
                console.log(response); // Log para depuración
                if (response.success) {
                    console.log('Usuario creado exitosamente.'); // Log para confirmar éxito
                    $('#error-message').removeClass('alert-danger').addClass('alert-success').text(response.message).show();
                    setTimeout(function() {
                        window.location.href = response.redirect; // Redirige
                    }, 2000); // Tiempo de espera antes de redirigir
                } else {
                    console.log('Error al crear usuario:', response.message); // Log para errores
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
