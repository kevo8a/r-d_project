<?php 
include '../../php/db_connection.php';
include '../../php/auth.php';

// Verificar si hay un ID de usuario en la URL para la edición
$id_user = $_GET['id_user'] ?? null;
$user_data = null;

// Si se está editando un usuario, recuperar sus datos
if ($id_user) {
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = '$id_user'");
    if ($result && mysqli_num_rows($result) > 0) {
        $user_data = mysqli_fetch_assoc($result);
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $id_user ? 'Editar Usuario' : 'Crear Usuario'; ?></title>
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
                    <h1 class="h3 mb-4 text-gray-800"><?php echo $id_user ? 'Editar Usuario' : 'Crear Usuario'; ?></h1>
                    <form action="../../php/create_edit_user.php" method="POST">
                        <div class="row">
                            <!-- ID User -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="id_user" class="form-label">ID del Usuario</label>
                                    <input type="text" class="form-control" id="id_user" name="id_user" value="<?php echo $user_data['id_user'] ?? ''; ?>" required>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user_data['name'] ?? ''; ?>" required>
                                </div>
                            </div>

                            <!-- Apellido -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $user_data['last_name'] ?? ''; ?>" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email'] ?? ''; ?>" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" id="password" name="password" <?php echo !$id_user ? 'required' : ''; ?>>
                                    <small class="form-text text-muted">Dejar en blanco si no desea cambiar la contraseña.</small>
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="rol" class="form-label">Rol</label>
                                    <select class="form-control" id="rol" name="rol" required>
                                        <option value="">Seleccione un rol</option>
                                        <option value="1" <?php echo isset($user_data) && $user_data['rol'] == 1 ? 'selected' : ''; ?>>Admin</option>
                                        <option value="2" <?php echo isset($user_data) && $user_data['rol'] == 2 ? 'selected' : ''; ?>>Approver</option>
                                        <option value="3" <?php echo isset($user_data) && $user_data['rol'] == 3 ? 'selected' : ''; ?>>Basic</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Site -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="site" class="form-label">Site</label>
                                    <select class="form-control" id="site" name="site" required>
                                        <option value="">Seleccione un sitio</option>
                                        <option value="tlaquepaque" <?php echo isset($user_data) && $user_data['site'] == 'tlaquepaque' ? 'selected' : ''; ?>>Tlaquepaque</option>
                                        <option value="zacapu" <?php echo isset($user_data) && $user_data['site'] == 'zacapu' ? 'selected' : ''; ?>>Zacapu</option>
                                        <option value="tultitlan" <?php echo isset($user_data) && $user_data['site'] == 'tultitlan' ? 'selected' : ''; ?>>Tultitlán</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary"><?php echo $id_user ? 'Actualizar Usuario' : 'Crear Usuario'; ?></button>
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
</body>

</html>
