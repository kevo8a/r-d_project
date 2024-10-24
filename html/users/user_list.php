<?php 
include '../../php/db_connection.php';
include '../../php/auth.php';

// Recuperar todos los usuarios
$result = mysqli_query($conn, "SELECT * FROM users");

if (!$result || mysqli_num_rows($result) == 0) {
    echo "No se encontraron usuarios.";
    exit;
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
    <title>Lista de Usuarios</title>
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
                    <h1 class="h3 mb-4 text-gray-800">Lista de Usuarios</h1>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Site</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <td><?php echo $row['id_user']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['last_name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td>
                                        <?php 
                                        // Mostrar el rol basado en el ID del rol
                                        switch ($row['id_rol']) {
                                            case 1:
                                                echo 'Admin';
                                                break;
                                            case 2:
                                                echo 'Approver';
                                                break;
                                            case 3:
                                                echo 'Basic';
                                                break;
                                            default:
                                                echo 'Desconocido';
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo $row['site']; ?></td>
                                    <td>
                                        <!-- Enlaces para editar y eliminar -->
                                        <a href="form_user.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-primary btn-sm">Editar</a>
                                        <!-- <a href="../../php/delete_user.php?id_user=<?php echo $row['id_user']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este usuario?');">Eliminar</a> -->
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
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

<?php
// Cerrar la conexión
mysqli_close($conn);
?>
